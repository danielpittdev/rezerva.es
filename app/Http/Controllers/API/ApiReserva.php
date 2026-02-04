<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Empleado;
use App\Models\Negocios;
use App\Models\Registros;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ApiReserva extends Controller
{
    public function show(Request $request, $id = null): JsonResponse
    {
        // Si recibe parámetros de negocio y fecha, buscar reservas filtradas
        if ($request->has('negocio') && $request->has('fecha')) {
            $negocioIdentificador = $request->input('negocio');
            $fecha = $request->input('fecha');

            // Buscar el negocio por UUID o nombre
            $negocio = Negocios::where('uuid', $negocioIdentificador)
                ->orWhere('nombre', $negocioIdentificador)
                ->first();

            if (!$negocio) {
                return response()->json(['error' => 'Negocio no encontrado'], 404);
            }

            // Obtener IDs de servicios del negocio
            $serviciosIds = Servicios::where('negocio_id', $negocio->id)->pluck('id');

            // Buscar reservas por servicios del negocio y fecha
            $reservas = Reserva::whereIn('servicio_id', $serviciosIds)
                ->whereDate('fecha', $fecha)
                ->orderBy('fecha', 'ASC')
                ->with(['servicio', 'cliente', 'empleado'])
                ->get();

            # Ordenar vistas
            $validacion = $request->validate([
                'lista' => 'required|string'
            ]);

            $tipo_lista = $validacion['lista'];

            $listas = [
                'lista_grande' => view('components.listas.reservas.lista_grande', compact('reservas'))->render(),
                'franjas' => view('components.listas.reservas.franjas', compact('reservas'))->render(),
                'vertical' => view('components.listas.reservas.vertical', compact('reservas'))->render(),
                'horizontal' => view('components.listas.reservas.horizontal', compact('reservas', 'negocio', 'fecha'))->render(),
            ];

            $lista = $listas[$validacion['lista']];

            # Respuesta

            return response()->json([
                'mensaje' => 'Reservas obtenidas con éxito',
                'negocio' => [
                    'id' => $negocio->id,
                    'uuid' => $negocio->uuid,
                    'nombre' => $negocio->nombre
                ],
                'fecha' => $fecha,
                'total' => $reservas->count(),
                'reservas' => $reservas,
                'html' => $lista
            ], 200);
        }

        // Si no hay parámetros, buscar por UUID individual
        if (!$id) {
            return response()->json(['error' => 'ID de reserva no proporcionado'], 400);
        }

        $reserva = Reserva::whereUuid($id)->first();

        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        return response()->json([
            'mensaje' => 'Recibido con éxito',
            'reserva' => $reserva
        ], 200);
    }

    # Helper
    public function comprobarReserva($cliente, $servicio, $fecha)
    {
        // Busca reserva del mismo cliente, mismo servicio, mismo día
        $reserva = Reserva::where('cliente_id', $cliente->id)
            ->where('servicio_id', $servicio->id)
            ->whereDate('fecha', $fecha)
            ->first();

        $negocio = $reserva->negocio ?? null;
        $fecha_antigua = $reserva->fecha ?? null;

        if ($reserva) {
            $reserva->update(['fecha' => $fecha]);

            # Envío de MAIL
            $datos = [
                'usuario' => $cliente,
                'reserva' => $reserva,
                'negocio' => $negocio->nombre,
                'fecha_antigua' => $fecha_antigua
            ];

            Mail::send('components.email.reserva_actualizar', [
                'datos' => $datos,
            ], function ($message) use ($datos) {
                $message->to($datos['usuario']['email'], $datos['usuario']['nombre'] . ' ' . $datos['usuario']['apellido'])
                    ->subject('Reserva actualizada');
            });

            return $reserva;
        }

        return null;
    }

    public function store(Request $request)
    {
        $datos_cliente = session()->get('cliente');

        $validacion = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
        ]);

        // Obtener el servicio para obtener el negocio_id
        $servicio = Servicios::whereUuid($datos_cliente['servicio'])->first();
        if ($request->empleado_id) {
            $empleado = Empleado::whereUuid($datos_cliente['empleado'])->first();
        }

        $negocio = $servicio->negocio;
        $fecha = $validacion['fecha'] . ' ' . $validacion['hora'];

        // Cliente
        $cliente = Clientes::where('email', $datos_cliente['email'])->where('nombre', $datos_cliente['nombre'])->where('apellido', $datos_cliente['apellido'])->first();

        if (!$cliente) {
            $cliente = Clientes::create([
                'nombre' => $datos_cliente['nombre'],
                'apellido' => $datos_cliente['apellido'],
                'email' => $datos_cliente['email'],
                'negocio_id' => $negocio->id
            ]);
        }

        $yahayreserva = $this->comprobarReserva($cliente, $servicio, $fecha);

        if (!$yahayreserva) {
            $reserva = Reserva::create([
                'servicio_id' => $servicio->id,
                'cliente_id' => $cliente->id,
                'negocio_id' => $negocio->id,
                'empleado_id' => $empleado->id ?? null,
                'fecha' => $validacion['fecha'] . ' ' . $validacion['hora'],
                'estado' => 'pendiente',
            ]);

            # Envío de MAIL
            $datos = [
                'usuario' => $datos_cliente,
                'reserva' => $reserva,
                'negocio' => $negocio->nombre
            ];

            Mail::send('components.email.reserva_actualizar', [
                'datos' => $datos,
            ], function ($message) use ($datos) {
                $message->to($datos['usuario']['email'], $datos['usuario']['nombre'] . ' ' . $datos['usuario']['apellido'])
                    ->subject('Reserva solicitada');
            });
        }

        // Verificar si el servicio requiere pago online
        if ($servicio->pago_online && $servicio->stripe_id) {
            // Guardar datos de la reserva en sesión para después del pago
            session()->put('reserva_pendiente', [
                'servicio_id' => $servicio->id,
                'negocio_id' => $negocio->id,
                'empleado_id' => $empleado->id ?? null,
                'fecha' => $fecha,
                'datos_cliente' => $datos_cliente,
            ]);

            return response()->json([
                'mensaje' => 'Redirigiendo al pago',
                'requiere_pago' => true,
                'redirect' => route('stripe.pre_checkout', ['servicio' => $servicio->uuid])
            ], 200);
        }

        // Crea el registro
        $reserva = Registros::create([
            'negocio' => $servicio,
            'cliente' => $cliente,
            'empleado' => $empleado ?? null,
            'stripe' => null
        ]);

        // Limpiar sesión anterior y guardar nueva
        session()->forget('cliente');

        return response()->json([
            'mensaje' => 'Reserva creada con éxito',
            'redirect' => '/'
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $reserva = Reserva::whereUuid($id)->first();

        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        $validated = $request->validate([
            'estado' => 'required|in:pendiente,confirmado,cancelado,completado',
            'fecha' => 'required|date',
        ]);

        $reserva->update($validated);

        return response()->json([
            'mensaje' => 'Actualizado con éxito',
            'reserva' => $reserva
        ], 200);
    }
}

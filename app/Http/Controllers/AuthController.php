<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use Carbon\Carbon;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    # Login de usuario
    public function login(Request $request): JsonResponse
    {
        $validacion = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $usuario = Usuarios::where('email', $validacion['email'])->first();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $request->session()->regenerate();
        $token = $usuario->createToken('auth_token')->plainTextToken;
        setcookie('jwt', $token, time() + 3600, '/'); // 1 hora

        return response()->json([
            'mensaje' => 'Inicio correcto',
            'token' => $token,
            'redirect' => route('panel'),
        ]);
    }

    # Registro de usuario
    public function registro(Request $request): JsonResponse
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:40',
            'apellido' => 'required|string|max:50',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|email|max:50|unique:usuarios',
            'terminos_condiciones' => 'required',
            // Negocio
            'empresa_nombre' => 'required|string|min:3',
            'descripcion' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'postal_direccion' => 'required|string|max:255',
            'postal_codigo' => 'required|string|max:10',
            'postal_ciudad' => 'required|string|max:100',
            'postal_pais' => 'required|string|max:100',
        ]);

        # Mayusculas
        $validacion['nombre'] = ucfirst($validacion['nombre']);
        $validacion['apellido'] = ucfirst($validacion['apellido']);
        $validacion['empresa_nombre'] = ucfirst($validacion['empresa_nombre']);
        $validacion['slug'] = Str::slug($validacion['empresa_nombre']);

        # Registro
        $usuario = Usuarios::create([
            'nombre' => $validacion['nombre'],
            'apellido' => $validacion['apellido'],
            'password' => Hash::make($validacion['password']),
            'email' => $validacion['email'],
        ]);

        $negocio = Negocios::create([
            'nombre' => $validacion['empresa_nombre'] ?? 'Tu negocio',
            'slug' => Str::slug($validacion['empresa_nombre']),
            'descripcion' => $validacion['descripcion'] ?? 'Descripción corta',
            'tipo' => $validacion['tipo'] ?? 'otros',
            'postal_direccion' => $validacion['postal_direccion'] ?? 'Calle',
            'postal_codigo' => $validacion['postal_codigo'] ?? '00000',
            'postal_ciudad' => $validacion['postal_ciudad'] ?? 'Ciudad',
            'postal_pais' => $validacion['postal_pais'] ?? 'País',
            'usuario_id' => $usuario->id,
        ]);

        # Respuesta
        return response()->json([
            'mensaje' => 'Registro completo',
            'redirect' => route('login'),
        ]);
    }

    # Recuperación de contraseña
    public function recuperar(Request $request): JsonResponse
    {
        $validacion = $request->validate([
            'email' => 'required|email'
        ]);

        // Generar token único
        $token = Str::random(60);

        // Guardar token en la base de datos
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );

        // Obtener el usuario
        $usuario = Usuarios::where('email', $request->email)->first();

        // Enviar correo con el enlace de recuperación
        Mail::send('components.email.auth.recuperar', [
            'usuario' => $usuario,
            'token' => $token,
            'url' => route('resetear', $token)
        ], function ($message) use ($usuario) {
            $message->to($usuario->email, $usuario->nombre . ' ' . $usuario->apellido)
                ->subject('Recuperación de Contraseña');
        });


        # Respuesta
        return response()->json([
            'mensaje' => 'Envío de recuperación enviado',
        ]);
    }

    # Resetear contraseña
    public function restablecer(Request $request)
    {
        $validator = $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'token.required' => 'Token de recuperación requerido',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.exists' => 'No encontramos un usuario con este correo electrónico',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        // Buscar el token en la base de datos
        $passwordReset = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$passwordReset) {
            if ($request->expectsJson()) {
                return response()->json([
                    'mensaje' => 'Token de recuperación inválido'
                ], 400);
            }
            return back()->with('error', 'Token de recuperación inválido.');
        }

        // Verificar que el token coincida
        if (!Hash::check($request->token, $passwordReset->token)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'mensaje' => 'Token de recuperación inválido'
                ], 400);
            }
            return back()->with('error', 'Token de recuperación inválido.');
        }

        // Verificar que el token no haya expirado (1 hora)
        $tokenAge = Carbon::parse($passwordReset->created_at);
        if ($tokenAge->addHour()->isPast()) {
            // Eliminar token expirado
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'mensaje' => 'El token de recuperación ha expirado'
                ], 400);
            }
            return back()->with('error', 'El token de recuperación ha expirado.');
        }

        // Actualizar la contraseña del usuario
        $usuario = Usuarios::where('email', $request->email)->first();
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // Eliminar el token usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        Mail::send('components.email.auth.restablecer', [
            'usuario' => $usuario,
            'url' => route('login')
        ], function ($message) use ($usuario) {
            $message->to($usuario->email, $usuario->nombre . ' ' . $usuario->apellido)
                ->subject('Contraseña restablecida');
        });

        if ($request->expectsJson()) {
            return response()->json([
                'mensaje' => 'Contraseña restablecida exitosamente',
                'redirect' => route('login')
            ]);
        }

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida exitosamente.');
    }
}

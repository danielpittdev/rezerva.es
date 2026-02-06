<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago completado - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="h-full bg-base-200">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-base-100 py-8 px-4 shadow-xl rounded-lg sm:px-10">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-base-content mb-2">Pago completado</h2>
                    <p class="text-base-content/70 mb-6">
                        Tu pago para <strong>{{ $reserva->servicio->nombre }}</strong> ha sido procesado correctamente.
                    </p>
                    <div class="bg-base-200 rounded-md p-4 text-left space-y-2 mb-6">
                        <p class="text-sm"><span class="font-medium">Servicio:</span> {{ $reserva->servicio->nombre }}</p>
                        <p class="text-sm"><span class="font-medium">Fecha:</span> {{ $reserva->fecha->format('d/m/Y H:i') }}</p>
                        <p class="text-sm"><span class="font-medium">Importe:</span> {{ number_format($reserva->servicio->precio, 2) }} {{ $reserva->servicio->negocio->moneda ?? 'EUR' }}</p>
                    </div>
                    <p class="text-sm text-base-content/60">
                        Puedes cerrar esta ventana.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="light" class="h-full bg-base-100">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Panel - {{ env('APP_NAME') }}</title>

      @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/request-manager.js', 'resources/js/calendario.js'])
   </head>

   <body class="h-full">

      @include('components.fragments.sidebar')
      <main class="lg:pl-63 p-2 lg:pt-2 pt-18 h-full">
         <div class="p-2 h-full bg-base-200 rounded-xl border border-base-content/10 relative overflow-y-auto h-full">


            <div class="rounded-md bg-yellow-50 border border-yellow-300 p-4">
               <div class="flex">
                  <div class="shrink-0">
                     <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-yellow-400">
                        <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                           clip-rule="evenodd" fill-rule="evenodd" />
                     </svg>
                  </div>
                  <div class="ml-3">
                     <h3 class="text-sm font-medium text-yellow-800">Aviso general</h3>
                     <div class="mt-2 text-sm text-yellow-700">
                        <p>
                           Aviso importante (tarifa de servicio)
                           Desde el 5 de marzo de 2026 se añadirá una tarifa de servicio de <strong>0,99€</strong> por entrada en el checkout, aplicable a todas las entradas (independientemente del método de pago). Esta tarifa cubre la emisión/validación y el soporte de la plataforma. Se mostrará
                           desglosada al comprador junto al precio de la entrada. También se eliminará la comisión por entrada actual de <strong>0,35€</strong>.
                        </p>
                     </div>
                  </div>
               </div>
            </div>

            @yield('contenido')
         </div>
      </main>

      @yield('drawers')
      @yield('modales')
      @yield('scripts')
   </body>

</html>

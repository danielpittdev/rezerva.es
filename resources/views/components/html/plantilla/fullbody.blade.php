<!DOCTYPE html>
<html lang="en" data-theme="light" class="h-full bg-base-100">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Panel - {{ env('APP_NAME') }}</title>

      @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/request-manager.js', 'resources/js/calendario.js'])
   </head>

   <body class="h-full">
      @include('components.fragments.sidebar')
      <main class="lg:pl-63 p-2 lg:pt-2 pt-16 h-full">
         <div class="p-2 h-full bg-base-200 rounded-xl border border-base-content/10">
            @yield('contenido')
         </div>
      </main>

      @yield('drawers')
      @yield('drawers')
      @yield('modales')
      @yield('scripts')
   </body>

</html>

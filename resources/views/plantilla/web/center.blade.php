<!DOCTYPE html>
<html lang="en" data-theme="light" class="h-full">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
      <title>Rezerva.es - @yield('tituloSEO', 'Gestiona reservas y citas para tu negocio')</title>
      @vite(['resources/js/app.js', 'resources/css/app.css'])

      <meta name="description" content="@yield('descripcionSEO', 'Automatiza todas tus reservas online')">
      <meta name="robots" content="index,follow">
      <meta name="googlebot" content="index,follow">
      <link rel="canonical" href="{{ asset('/') }}>

      <link rel="manifest" href="{{ asset('/') }}manifest.json">
      <link rel="apple-touch-icon" href="{{ asset('/') }}media/logo/brand.png">
      <link rel="icon" type="image/png" href="icono.ico">
      <link rel="apple-touch-icon" href="{{ asset('/') }}media/logo/brand.png">

      <meta name="theme-color" content="#0f172a">

      <meta property="og:type" content="website">
      <meta property="og:site_name" content="Rezerva.es">
      <meta property="og:title" content="Rezerva.es | Software de reservas online">
      <meta property="og:description" content="@yield('descripcionSEO', 'Automatiza todas tus reservas online')">
      <meta property="og:url" content="{{ asset('/') }}>
      <meta property="og:image" content="{{ asset('/') }}media/og/rezerva-cover.png">
      <meta property="og:image:alt" content="Rezerva.es - Software de reservas online">

      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="Rezerva.es | Reservas online 24/7">
      <meta name="twitter:description" content="@yield('descripcionSEO', 'Automatiza todas tus reservas online')">
      <meta name="twitter:image" content="{{ asset('/') }}media/og/rezerva-cover.png">

      <link rel="preconnect" href="https://www.googletagmanager.com">
      <link rel="preconnect" href="https://www.google-analytics.com">
   </head>

   <body class="bg-base-100 h-full">
      @include('fragmento.nav')
      <div class="pt-20">
         @yield('contenido')
      </div>
   </body>

</html>

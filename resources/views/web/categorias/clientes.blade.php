@extends('plantilla.web.full')

@section('tituloSEO', 'CRM gestor de clientes para tu negocio')
@section('descripcionSEO', 'Crea clientes internos, registra clientes mientras creas reservas, accede al historial y últimas reservas. Gestión de clientes y citas online para negocios con Rezerva.es.')

@section('contenido')

   {{-- AOS (si no lo tienes ya en tu layout global) --}}
   <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

   <section class="bg-gray-100 text-gray-900">

      {{-- =========================================================
      HERO
   ========================================================= --}}
      <div class="relative isolate overflow-hidden">
         <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:px-8 lg:py-40">

            <div class="mx-auto max-w-3xl text-center">
               <p class="text-sm font-semibold text-gray-500"
                  data-aos="fade-up" data-aos-duration="900">
                  Rezerva.es · Clientes internos
               </p>

               <h1 class="mt-6 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Crea clientes internos y reserva en segundos
               </h1>

               <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  Rezerva.es te permite <strong>crear clientes internos</strong> en tu negocio y al mismo tiempo
                  <strong>crear reservas</strong> mientras lo registras.
                  Todo queda guardado con historial, últimas reservas, notas y datos del cliente para una atención profesional.
               </p>

               <div class="mt-10 flex items-center justify-center gap-x-6"
                  data-aos="fade-up" data-aos-delay="350" data-aos-duration="900">
                  <a href="{{ route('registro') }}"
                     class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                     Empezar ahora
                  </a>
                  <a href="#seo"
                     class="text-sm/6 font-semibold text-gray-900">
                     Leer más <span aria-hidden="true">→</span>
                  </a>
               </div>
            </div>

            {{-- Imagen mínima (opcional) --}}
            <div class="mx-auto mt-16 max-w-5xl sm:mt-24"
               data-aos="fade-up" data-aos-delay="450" data-aos-duration="900">
               <img
                  src="/media/img/imac1.png"
                  alt="Gestión de clientes internos y reservas Rezerva.es"
                  class="w-full object-contain">
            </div>

         </div>
      </div>


      {{-- =========================================================
      BENEFICIOS (minimalista)
   ========================================================= --}}
      <div class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Gestión de clientes diseñada para negocios reales
               </h2>
               <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Si gestionas citas, turnos o reservas, necesitas un sistema que permita crear clientes rápido,
                  sin formularios largos y sin perder tiempo al atender.
               </p>
            </div>

            <div class="mt-16 grid gap-14 lg:grid-cols-3">

               <div data-aos="fade-up" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Crear cliente en 10 segundos
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     Registra <strong>clientes internos</strong> con los datos mínimos: nombre, teléfono y observaciones.
                     Perfecto para negocios que trabajan con agenda diaria y atención rápida.
                  </p>
               </div>

               <div data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Reserva mientras lo registras
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     Crea una <strong>reserva</strong> aunque el cliente no exista todavía.
                     Rezerva.es lo registra automáticamente y lo asocia a la cita en el mismo flujo.
                  </p>
               </div>

               <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Últimas reservas y relación con el negocio
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     Consulta rápidamente el <strong>historial de reservas</strong>, últimas visitas,
                     servicios realizados y comportamiento del cliente con tu negocio.
                  </p>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
      HOW IT WORKS (minimal, 3 pasos)
   ========================================================= --}}
      <div class="bg-gray-100">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-4xl">

               <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Cómo funciona el registro interno de clientes
               </h2>

               <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Un flujo rápido pensado para recepciones, mostradores, atención telefónica o WhatsApp.
               </p>

               <div class="mt-16 grid gap-12 lg:grid-cols-3">

                  <div data-aos="fade-up" data-aos-duration="900">
                     <p class="text-sm font-semibold text-gray-500">PASO 1</p>
                     <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        Buscar cliente
                     </h3>
                     <p class="mt-4 text-base text-gray-600 leading-relaxed">
                        Escribes nombre o teléfono. Si no existe, lo creas en el momento.
                        Control total desde el panel de negocio.
                     </p>
                  </div>

                  <div data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     <p class="text-sm font-semibold text-gray-500">PASO 2</p>
                     <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        Crear reserva al instante
                     </h3>
                     <p class="mt-4 text-base text-gray-600 leading-relaxed">
                        Seleccionas servicio, empleado y hora.
                        La reserva queda vinculada al cliente automáticamente incluso si se registró en ese mismo instante.
                     </p>
                  </div>

                  <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                     <p class="text-sm font-semibold text-gray-500">PASO 3</p>
                     <h3 class="mt-2 text-lg font-semibold text-gray-900">
                        Ver historial y últimas reservas
                     </h3>
                     <p class="mt-4 text-base text-gray-600 leading-relaxed">
                        Accedes al historial del cliente, notas internas, últimas reservas con tu negocio y estado de pagos.
                     </p>
                  </div>

               </div>

            </div>
         </div>
      </div>


      {{-- =========================================================
      SEO CONTENT
   ========================================================= --}}
      <div id="seo" class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-4xl">

               <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Software de gestión de clientes internos con historial de reservas
               </h2>

               <div class="mt-10 space-y-8 text-base text-gray-700 leading-relaxed">

                  <p data-aos="fade-up" data-aos-delay="120">
                     Rezerva.es incorpora un sistema de <strong>gestión de clientes internos</strong> pensado para negocios que trabajan
                     con <strong>agenda online</strong> y necesitan registrar clientes rápidamente sin fricciones.
                     Esto permite mejorar la atención, mantener orden en la agenda y controlar la relación del cliente con el negocio.
                  </p>

                  <p data-aos="fade-up" data-aos-delay="200">
                     La función de <strong>crear reservas mientras registras el cliente</strong> es clave para negocios con mostrador,
                     gestión telefónica o atención rápida. Con esta automatización se evita el error típico:
                     perder la reserva por no tener el cliente creado previamente.
                  </p>

                  <p data-aos="fade-up" data-aos-delay="280">
                     Además, cada cliente tiene acceso a su <strong>historial de reservas</strong>, últimas visitas,
                     servicios realizados, notas internas y datos esenciales. Esto ayuda al negocio a fidelizar y aumentar ventas,
                     especialmente en barberías, peluquerías, clínicas, estética, talleres y servicios profesionales.
                  </p>

               </div>

               <div class="mt-12 flex items-center gap-x-6"
                  data-aos="fade-up" data-aos-delay="360">
                  <a href="{{ route('registro') }}"
                     class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                     Empezar ahora
                  </a>
                  <a href="#"
                     class="text-sm/6 font-semibold text-gray-900">
                     Leer más <span aria-hidden="true">→</span>
                  </a>
               </div>

            </div>
         </div>
      </div>


      {{-- =========================================================
      CTA
   ========================================================= --}}
      <div class="bg-gray-100">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">

               <h3 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Crea clientes, gestiona reservas y controla el historial en un clic
               </h3>

               <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Si quieres un sistema profesional para tu negocio, Rezerva.es es tu solución.
                  Unifica clientes internos, agenda inteligente y reservas online 24/7.
               </p>

               <div class="mt-10 flex items-center justify-center gap-x-6"
                  data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  <a href="{{ route('registro') }}"
                     class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                     Empezar ahora
                  </a>
                  <a href="#"
                     class="text-sm/6 font-semibold text-gray-900">
                     Leer más <span aria-hidden="true">→</span>
                  </a>
               </div>

            </div>
         </div>
      </div>

   </section>

   {{-- AOS JS --}}
   <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         AOS.init({
            once: true,
            duration: 900,
            offset: 80,
         });
      });
   </script>

@endsection

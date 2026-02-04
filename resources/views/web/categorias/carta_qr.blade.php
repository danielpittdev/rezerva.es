@extends('plantilla.web.full')

@section('tituloSEO', 'CRM gestión de CARTAS QR para restaurantes')
@section('descripcionSEO', 'Controla y gestiona todo lo que tu negocio puede hacer. Controla las reservas y posiciona en Google tu negocio')

@section('contenido')
   <section class="bg-gray-50 text-gray-900">

      {{-- =========================================================
      HERO - CARTAS QR
   ========================================================= --}}
      <div class="relative isolate overflow-hidden">
         <div class="absolute inset-0 -z-10 opacity-40"
            style="background: radial-gradient(900px circle at 20% 10%, rgba(79,70,229,.25), transparent 60%),
                radial-gradient(900px circle at 90% 40%, rgba(59,130,246,.18), transparent 55%);">
         </div>

         <div class="mx-auto max-w-7xl px-6 pt-14 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

               {{-- Texto --}}
               <div class="max-w-xl">
                  <div class="flex items-center gap-3">
                     <img src="/media/logo/icon.png" alt="Rezerva.es" class="h-12 w-12 rounded-xl shadow-sm bg-white p-2" />
                     <span class="text-sm font-semibold text-indigo-600">
                        Cartas QR · Rezerva.es
                     </span>
                  </div>

                  <h1 class="mt-8 text-4xl font-semibold tracking-tight text-balance sm:text-5xl lg:text-6xl"
                     data-aos="fade-up" data-aos-duration="900">
                     Crea tu carta digital y tu QR en 2 minutos
                  </h1>

                  <p class="mt-6 text-lg leading-relaxed text-gray-600 sm:text-xl"
                     data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     Diseña tu carta, organiza categorías, añade artículos y genera un QR listo para imprimir.
                     Actualiza precios o productos en segundos, sin volver a imprimir.
                  </p>

                  <div class="mt-10 flex flex-col sm:flex-row sm:items-center gap-4"
                     data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                     <a href="#"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-md hover:bg-indigo-500 transition">
                        Crear mi carta QR
                     </a>

                     <a href="#features"
                        class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-semibold text-gray-900 shadow-sm ring-1 ring-gray-200 hover:ring-gray-300 transition">
                        Ver funcionalidades
                        <span class="ml-2" aria-hidden="true">→</span>
                     </a>
                  </div>

                  {{-- Confianza --}}
                  <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-3"
                     data-aos="fade-up" data-aos-delay="350" data-aos-duration="900">
                     <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                        <div class="text-2xl font-bold text-gray-900">QR</div>
                        <div class="text-sm text-gray-600">Listo para imprimir</div>
                     </div>
                     <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                        <div class="text-2xl font-bold text-gray-900">∞</div>
                        <div class="text-sm text-gray-600">Artículos ilimitados</div>
                     </div>
                     <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100 col-span-2 sm:col-span-1">
                        <div class="text-2xl font-bold text-gray-900">€</div>
                        <div class="text-sm text-gray-600">Pagos online</div>
                     </div>
                  </div>
               </div>

               {{-- Imagen --}}
               <div class="relative"
                  data-aos="fade-left"
                  data-aos-duration="1100"
                  data-aos-delay="300">
                  <div class="absolute -inset-6 rounded-[2rem] bg-gradient-to-tr from-indigo-200/40 to-blue-200/40 blur-2xl"></div>

                  {{-- Cambia esta imagen por la del módulo de carta QR --}}
                  <img src="/media/img/iphone4.png"
                     alt="Carta digital con QR Rezerva.es"
                     class="relative w-full max-w-md mx-auto  object-cover">
               </div>

            </div>
         </div>
      </div>

      {{-- =========================================================
      FEATURES
   ========================================================= --}}
      <div id="features" class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
         <div class="max-w-3xl">
            <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl"
               data-aos="fade-up" data-aos-duration="900">
               Tu carta profesional, sin diseñadores y sin líos
            </h2>

            <p class="mt-4 text-lg text-gray-600"
               data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
               Pensado para restaurantes, cafeterías, food trucks, bares, barberías o cualquier negocio con productos/servicios.
            </p>
         </div>

         <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Card 1 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="0">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  01
               </div>
               <h3 class="mt-5 text-xl font-semibold">Generador de QR</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Genera tu código QR automáticamente con enlace a tu carta digital.
                  Listo para imprimir y colocar en mesas, mostrador o escaparate.
               </p>
            </div>

            {{-- Card 2 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="150">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  02
               </div>
               <h3 class="mt-5 text-xl font-semibold">Categorías & artículos</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Organiza tu carta por categorías y añade artículos con nombre, precio, descripción y foto.
                  Todo editable en segundos.
               </p>
            </div>

            {{-- Card 3 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="300">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  03
               </div>
               <h3 class="mt-5 text-xl font-semibold">Actualización instantánea</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Cambia precios, productos o disponibilidad sin imprimir de nuevo.
                  El QR siempre apunta a la versión actualizada.
               </p>
            </div>

            {{-- Card 4 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="0">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  04
               </div>
               <h3 class="mt-5 text-xl font-semibold">Carta atractiva y responsive</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Diseño profesional optimizado para móvil.
                  Tu cliente entra, ve productos rápido y decide al instante.
               </p>
            </div>

            {{-- Card 5 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="150">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  05
               </div>
               <h3 class="mt-5 text-xl font-semibold">Pagos online</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Permite pagar online directamente desde la carta.
                  Menos esperas, más velocidad y más control para el negocio.
               </p>
            </div>

            {{-- Card 6 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="300">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  06
               </div>
               <h3 class="mt-5 text-xl font-semibold">Panel para el negocio</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Administra todo desde un panel: artículos, categorías, precios y cobros.
                  Preparado para escalar con tu negocio.
               </p>
            </div>

         </div>
      </div>

      {{-- =========================================================
      “CÓMO FUNCIONA”
   ========================================================= --}}
      <div class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

            <div class="max-w-3xl">
               <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Cómo funciona
               </h2>
               <p class="mt-4 text-lg text-gray-600"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  3 pasos para tener tu carta lista hoy mismo.
               </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">

               <div class="rounded-2xl bg-gray-50 p-7 ring-1 ring-gray-100"
                  data-aos="fade-up" data-aos-delay="0">
                  <div class="text-sm font-semibold text-indigo-600">PASO 1</div>
                  <h3 class="mt-2 text-xl font-semibold">Crea categorías</h3>
                  <p class="mt-3 text-gray-600 leading-relaxed">
                     Entrantes, bebidas, postres, menú del día…
                  </p>
               </div>

               <div class="rounded-2xl bg-gray-50 p-7 ring-1 ring-gray-100"
                  data-aos="fade-up" data-aos-delay="150">
                  <div class="text-sm font-semibold text-indigo-600">PASO 2</div>
                  <h3 class="mt-2 text-xl font-semibold">Añade artículos</h3>
                  <p class="mt-3 text-gray-600 leading-relaxed">
                     Nombre, descripción, foto y precio. Puedes duplicar, editar o desactivar cuando quieras.
                  </p>
               </div>

               <div class="rounded-2xl bg-gray-50 p-7 ring-1 ring-gray-100"
                  data-aos="fade-up" data-aos-delay="300">
                  <div class="text-sm font-semibold text-indigo-600">PASO 3</div>
                  <h3 class="mt-2 text-xl font-semibold">Imprime el QR</h3>
                  <p class="mt-3 text-gray-600 leading-relaxed">
                     Generas el QR, lo imprimes y lo colocas. Tu cliente escanea y ya está.
                  </p>
               </div>

            </div>
         </div>
      </div>

      {{-- =========================================================
      CTA FINAL
   ========================================================= --}}
      <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
         <div class="relative overflow-hidden rounded-3xl bg-indigo-600 px-8 py-14 shadow-xl">
            <div class="absolute inset-0 opacity-20"
               style="background: radial-gradient(700px circle at 15% 20%, rgba(255,255,255,.45), transparent 60%),
                     radial-gradient(700px circle at 85% 60%, rgba(255,255,255,.25), transparent 50%);">
            </div>

            <div class="relative grid gap-10 lg:grid-cols-2 lg:items-center">
               <div>
                  <h3 class="text-3xl font-semibold text-white sm:text-4xl"
                     data-aos="fade-up" data-aos-duration="900">
                     Tu carta QR lista hoy, sin costes innecesarios
                  </h3>
                  <p class="mt-4 text-lg text-white/85 leading-relaxed"
                     data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     Digitaliza tu negocio con Rezerva.es: carta QR, edición en segundos y pagos online para cobrar más rápido.
                  </p>
               </div>

               <div class="flex flex-col sm:flex-row lg:justify-end gap-4"
                  data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  <a href="#"
                     class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-semibold text-indigo-700 shadow hover:bg-indigo-50 transition">
                     Crear carta QR
                  </a>
                  <a href="#"
                     class="inline-flex items-center justify-center rounded-lg bg-indigo-500/30 px-6 py-3 text-base font-semibold text-white ring-1 ring-white/30 hover:bg-indigo-500/40 transition">
                     Ver demo
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

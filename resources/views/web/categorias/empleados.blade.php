@extends('plantilla.web.full')

@section('contenido')
   {{-- =========================================================
   AOS (si no lo tienes ya en tu layout global)
   Si ya lo cargas en fullbody, elimina este bloque completo.
========================================================= --}}
   <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

   <section class="bg-gray-50 text-gray-900">

      {{-- =========================================================
      HERO
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
                        Módulo Empleados · Rezerva.es
                     </span>
                  </div>

                  <h1 class="mt-8 text-4xl font-semibold tracking-tight text-balance sm:text-5xl lg:text-6xl"
                     data-aos="fade-up" data-aos-duration="900">
                     Gestión total de empleados y agenda inteligente
                  </h1>

                  <p class="mt-6 text-lg leading-relaxed text-gray-600 sm:text-xl"
                     data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     Controla turnos, servicios, disponibilidad y rendimiento desde un único panel.
                     Con Rezerva.es puedes gestionar tus empleados como un administrador total, sin complicaciones.
                  </p>

                  <div class="mt-10 flex flex-col sm:flex-row sm:items-center gap-4"
                     data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                     <a href="#"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-md hover:bg-indigo-500 transition">
                        Empezar ahora
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
                        <div class="text-2xl font-bold text-gray-900">+24/7</div>
                        <div class="text-sm text-gray-600">Agenda online</div>
                     </div>
                     <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100">
                        <div class="text-2xl font-bold text-gray-900">∞</div>
                        <div class="text-sm text-gray-600">Empleados ilimitados</div>
                     </div>
                     <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-100 col-span-2 sm:col-span-1">
                        <div class="text-2xl font-bold text-gray-900">Pro</div>
                        <div class="text-sm text-gray-600">Panel de rendimiento</div>
                     </div>
                  </div>
               </div>

               {{-- Imagen --}}
               <div class="relative"
                  data-aos="fade-left"
                  data-aos-duration="1100"
                  data-aos-delay="300">
                  <div class="absolute -inset-6 rounded-[2rem] bg-gradient-to-tr from-indigo-200/40 to-blue-200/40 blur-2xl"></div>

                  <img src="/media/img/imac1.png"
                     alt="Panel de empleados Rezerva.es"
                     class="relative w-full  object-cover">
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
               Control de empleados: rápido, flexible y automático
            </h2>

            <p class="mt-4 text-lg text-gray-600"
               data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
               Gestiona permisos, horarios, comisiones y rendimiento.
               Ideal para negocios con varias personas, varias agendas y varios servicios.
            </p>
         </div>

         <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Card --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="0">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  01
               </div>
               <h3 class="mt-5 text-xl font-semibold">Perfiles y permisos</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Decide qué puede ver o hacer cada empleado:
                  agenda, clientes, pagos, estadísticas o solo su calendario.
               </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="150">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  02
               </div>
               <h3 class="mt-5 text-xl font-semibold">Horarios y turnos</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Configura disponibilidad, descansos, días libres,
                  vacaciones o turnos rotativos sin perder el control.
               </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="300">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  03
               </div>
               <h3 class="mt-5 text-xl font-semibold">Servicios por empleado</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Asigna qué servicios ofrece cada persona (y a qué precio).
                  El sistema ajusta automáticamente la agenda y reservas.
               </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="0">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  04
               </div>
               <h3 class="mt-5 text-xl font-semibold">Comisiones y control</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Controla ingresos por empleado, comisiones,
                  volumen de reservas y servicios más vendidos.
               </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="150">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  05
               </div>
               <h3 class="mt-5 text-xl font-semibold">Notificaciones automáticas</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Los empleados reciben avisos por nuevas reservas,
                  cambios, cancelaciones o confirmaciones.
               </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-md transition"
               data-aos="fade-up" data-aos-delay="300">
               <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold">
                  06
               </div>
               <h3 class="mt-5 text-xl font-semibold">Estadísticas y rendimiento</h3>
               <p class="mt-3 text-gray-600 leading-relaxed">
                  Panel profesional para analizar rendimiento,
                  citas atendidas, cancelaciones y horas ocupadas.
               </p>
            </div>

         </div>
      </div>


      {{-- =========================================================
      SECTION 2 (TELÉFONO / APP)
   ========================================================= --}}
      <div class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

               {{-- Imagen --}}
               <div class="flex justify-center lg:justify-start order-2 lg:order-1"
                  data-aos="fade-right"
                  data-aos-duration="1000">
                  <img src="/media/img/iphone4.png"
                     alt="Control de empleados desde móvil"
                     class="w-[260px] sm:w-[320px] lg:w-[360px] drop-shadow-2xl">
               </div>

               {{-- Texto --}}
               <div class="order-1 lg:order-2 max-w-xl">
                  <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl"
                     data-aos="fade-up" data-aos-duration="900">
                     Control total desde el móvil
                  </h2>

                  <p class="mt-4 text-lg text-gray-600 leading-relaxed"
                     data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     Cada empleado puede gestionar su agenda y ver sus reservas desde cualquier lugar.
                     Ideal para equipos móviles, clínicas con varios profesionales o negocios con turnos.
                  </p>

                  <ul class="mt-8 space-y-4 text-gray-700">
                     <li class="flex gap-3" data-aos="fade-up" data-aos-delay="250">
                        <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-700 font-bold">✓</span>
                        <span><strong>Agenda siempre actualizada</strong> con cambios en tiempo real.</span>
                     </li>
                     <li class="flex gap-3" data-aos="fade-up" data-aos-delay="350">
                        <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-700 font-bold">✓</span>
                        <span><strong>Notificaciones automáticas</strong> para evitar errores y olvidos.</span>
                     </li>
                     <li class="flex gap-3" data-aos="fade-up" data-aos-delay="450">
                        <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-700 font-bold">✓</span>
                        <span><strong>Mayor productividad</strong> con control de disponibilidad.</span>
                     </li>
                  </ul>

                  <div class="mt-10 flex flex-col sm:flex-row gap-4"
                     data-aos="fade-up" data-aos-delay="550">
                     <a href="#"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-md hover:bg-indigo-500 transition">
                        Solicitar demo
                     </a>
                     <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-gray-900 hover:text-indigo-600 transition">
                        Ver precios <span class="ml-2">→</span>
                     </a>
                  </div>

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
                     Convierte tu equipo en una máquina de reservas
                  </h3>
                  <p class="mt-4 text-lg text-white/85 leading-relaxed"
                     data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                     Empieza con Rezerva.es y gestiona empleados, turnos y agenda desde un panel profesional.
                     Tu negocio, más rápido. Tu equipo, más organizado.
                  </p>
               </div>

               <div class="flex flex-col sm:flex-row lg:justify-end gap-4"
                  data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  <a href="#"
                     class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-semibold text-indigo-700 shadow hover:bg-indigo-50 transition">
                     Crear cuenta gratis
                  </a>
                  <a href="#"
                     class="inline-flex items-center justify-center rounded-lg bg-indigo-500/30 px-6 py-3 text-base font-semibold text-white ring-1 ring-white/30 hover:bg-indigo-500/40 transition">
                     Hablar con soporte
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

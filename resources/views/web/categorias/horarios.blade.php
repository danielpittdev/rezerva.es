@extends('plantilla.web.full')

@section('tituloSEO', 'Control de turnos y horarios para tu negocio')
@section('descripcionSEO', 'Control de horarios online para empleados y turnos: disponibilidad, agenda inteligente, calendario de reservas, gestión de citas y pagos online. Rezerva.es software nº1 en reservas.')

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
                  Rezerva.es · Control de horarios y turnos
               </p>

               <h1 class="mt-6 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Controla horarios, turnos y disponibilidad en tu agenda online
               </h1>

               <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  Rezerva.es es un <strong>software online de reservas</strong> diseñado para negocios que necesitan un
                  <strong>control de horarios</strong> profesional:
                  <strong>turnos de empleados</strong>, <strong>calendario de reservas</strong>, <strong>disponibilidad real</strong>,
                  <strong>agenda inteligente</strong> y <strong>gestión de citas</strong> sin solapamientos.
                  Ideal para clínicas, barberías, restaurantes, talleres y negocios con reservas 24/7.
               </p>

               <div class="mt-10 flex items-center justify-center gap-x-6"
                  data-aos="fade-up" data-aos-delay="350" data-aos-duration="900">
                  {{-- Mantengo tus botones EXACTOS --}}
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

            {{-- Imagen (solo 1, minimalista; puedes quitarla si quieres) --}}
            <div class="mx-auto mt-16 max-w-5xl sm:mt-24"
               data-aos="fade-up" data-aos-delay="450" data-aos-duration="900">
               <img
                  src="/media/img/imac1.png"
                  alt="Control de horarios online en agenda inteligente Rezerva.es"
                  class="w-full object-contain">
            </div>

         </div>
      </div>


      {{-- =========================================================
      BENEFICIOS (sin cards pomposas)
   ========================================================= --}}
      <div class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Horarios y turnos claros para un negocio más rentable
               </h2>
               <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                  data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Un buen <strong>control de horarios</strong> no es un extra: es lo que evita errores, reduce cancelaciones
                  y permite que la agenda funcione sola.
               </p>
            </div>

            <div class="mt-16 grid gap-14 lg:grid-cols-3">

               <div data-aos="fade-up" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Horarios por empleado
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     Configura <strong>horarios laborales</strong>, descansos, vacaciones y días no disponibles.
                     Así tu <strong>calendario de reservas online</strong> muestra solo huecos reales.
                  </p>
               </div>

               <div data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Turnos automáticos
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     Crea <strong>turnos rotativos</strong>, semanas alternas o horarios partidos.
                     Rezerva.es sincroniza los turnos con la <strong>agenda inteligente</strong> automáticamente.
                  </p>
               </div>

               <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     Citas sin solapamientos
                  </h3>
                  <p class="mt-4 text-base text-gray-600 leading-relaxed">
                     El sistema bloquea reservas incompatibles por horario, duración o empleado.
                     Esto mejora la <strong>gestión de citas</strong> y evita errores del día a día.
                  </p>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
      SEO CONTENT (estructura limpia y natural)
   ========================================================= --}}
      <div id="seo" class="bg-gray-100">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">

            <div class="mx-auto max-w-4xl">
               <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Software de control de horarios online integrado con reservas y pagos
               </h2>

               <div class="mt-10 space-y-8 text-base text-gray-700 leading-relaxed">

                  <p data-aos="fade-up" data-aos-delay="120">
                     Si tienes un negocio con citas o servicios, necesitas un sistema que controle
                     <strong>horarios</strong> y <strong>turnos</strong> con precisión.
                     Rezerva.es unifica en una misma plataforma el <strong>control de horarios de empleados</strong>
                     con un <strong>software de reservas online</strong> profesional.
                  </p>

                  <p data-aos="fade-up" data-aos-delay="200">
                     El módulo de <strong>gestión de turnos</strong> permite asignar disponibilidad por persona,
                     por día y por franja horaria, evitando el problema más común:
                     reservas creadas fuera de horario, citas mal asignadas y huecos invisibles.
                     Todo se refleja en la <strong>agenda online</strong> del negocio.
                  </p>

                  <p data-aos="fade-up" data-aos-delay="280">
                     Además, Rezerva.es incluye <strong>pagos online</strong>, confirmaciones automáticas y recordatorios,
                     lo cual hace que el <strong>calendario de reservas</strong> sea estable y rentable.
                     Es ideal para barberías, peluquerías, clínicas dentales, centros de estética, talleres,
                     fisioterapeutas y negocios que quieren automatizar su agenda y crecer.
                  </p>

               </div>

               <div class="mt-12 flex items-center gap-x-6"
                  data-aos="fade-up" data-aos-delay="360">
                  {{-- Botones nativos tuyos --}}
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
      FAQ SEO (minimalista)
   ========================================================= --}}
      <div class="bg-white">
         <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">

            <div class="mx-auto max-w-4xl">
               <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Preguntas frecuentes sobre control de horarios
               </h2>

               <dl class="mt-14 space-y-10">

                  <div data-aos="fade-up" data-aos-delay="100">
                     <dt class="text-lg font-semibold text-gray-900">
                        ¿Rezerva.es sirve para controlar horarios y turnos de empleados?
                     </dt>
                     <dd class="mt-3 text-base text-gray-600 leading-relaxed">
                        Sí. Puedes gestionar <strong>horarios de empleados</strong>, turnos, descansos, vacaciones y disponibilidad.
                        Todo se refleja automáticamente en el <strong>calendario de reservas online</strong>.
                     </dd>
                  </div>

                  <div data-aos="fade-up" data-aos-delay="180">
                     <dt class="text-lg font-semibold text-gray-900">
                        ¿Cómo evita solapamientos en la agenda?
                     </dt>
                     <dd class="mt-3 text-base text-gray-600 leading-relaxed">
                        La <strong>agenda inteligente</strong> cruza horarios, duración del servicio y disponibilidad real,
                        evitando reservas duplicadas o citas fuera de turno.
                     </dd>
                  </div>

                  <div data-aos="fade-up" data-aos-delay="260">
                     <dt class="text-lg font-semibold text-gray-900">
                        ¿Incluye pagos online y reservas 24/7?
                     </dt>
                     <dd class="mt-3 text-base text-gray-600 leading-relaxed">
                        Sí. Rezerva.es permite <strong>reservas online 24/7</strong> y también <strong>pagos online</strong>,
                        para automatizar el flujo completo: reserva, confirmación y cobro.
                     </dd>
                  </div>

               </dl>

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

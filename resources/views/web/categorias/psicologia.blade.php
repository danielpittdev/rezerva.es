@extends('plantilla.web.full')

@section('tituloSEO', 'Software de Gestión para Psicólogos | Agenda Online, Pagos y Seguimiento de Pacientes - Rezerva.es')
@section('descripcionSEO', 'Software especializado para psicólogos y consultas de psicología. Agenda online 24/7, pagos automáticos, historial de pacientes, seguimiento de sesiones y fichas clínicas. Interfaz intuitiva diseñada para profesionales de la salud mental. Prueba gratis.')

@section('contenido')

   {{-- AOS --}}
   <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

   <section class="bg-gray-100 text-gray-900">

      {{-- =========================================================
         HERO - PSICÓLOGOS
      ========================================================= --}}
      <div class="relative isolate overflow-hidden bg-gradient-to-b from-indigo-50 to-gray-100">
         <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:px-8 lg:py-40">

            <div class="mx-auto max-w-4xl text-center">
               <p class="inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-semibold text-indigo-700"
                  data-aos="fade-up" data-aos-duration="900">
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                     <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  Software para Psicólogos #1 en España
               </p>

               <h1 class="mt-8 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl lg:text-7xl"
                  data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  El software que tu
                  <span class="text-indigo-600">consulta de psicología</span>
                  necesita
               </h1>

               <p class="mt-8 text-xl font-medium text-gray-600 sm:text-2xl leading-relaxed"
                  data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
                  Agenda online 24/7, <strong>pagos automáticos</strong>, seguimiento de pacientes,
                  fichas clínicas y una <strong>interfaz ultra intuitiva</strong> diseñada específicamente para psicólogos.
               </p>

               <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4"
                  data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <a href="https://panel.rezerva.es/registro"
                     class="w-full sm:w-auto rounded-xl bg-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-lg hover:bg-indigo-500 transition-all hover:scale-105 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                     Probar gratis 14 días
                  </a>
                  <a href="#funcionalidades"
                     class="w-full sm:w-auto rounded-xl border-2 border-gray-300 bg-white px-8 py-4 text-lg font-semibold text-gray-700 hover:border-indigo-300 hover:bg-indigo-50 transition-all">
                     Ver funcionalidades
                  </a>
               </div>

               <p class="mt-6 text-sm text-gray-500" data-aos="fade-up" data-aos-delay="350">
                  Sin tarjeta de crédito · Configuración en 5 minutos · Soporte incluido
               </p>
            </div>

            {{-- Stats de confianza --}}
            <div class="mx-auto mt-16 max-w-4xl grid grid-cols-2 gap-8 sm:grid-cols-4"
               data-aos="fade-up" data-aos-delay="400" data-aos-duration="900">
               <div class="text-center">
                  <p class="text-4xl font-bold text-indigo-600">+2.500</p>
                  <p class="mt-1 text-sm text-gray-600">Psicólogos activos</p>
               </div>
               <div class="text-center">
                  <p class="text-4xl font-bold text-indigo-600">+180K</p>
                  <p class="mt-1 text-sm text-gray-600">Citas gestionadas/mes</p>
               </div>
               <div class="text-center">
                  <p class="text-4xl font-bold text-indigo-600">99.9%</p>
                  <p class="mt-1 text-sm text-gray-600">Uptime garantizado</p>
               </div>
               <div class="text-center">
                  <p class="text-4xl font-bold text-indigo-600">4.9/5</p>
                  <p class="mt-1 text-sm text-gray-600">Valoración media</p>
               </div>
            </div>

            {{-- Imagen --}}
            <div class="mx-auto mt-16 max-w-5xl sm:mt-24"
               data-aos="fade-up" data-aos-delay="450" data-aos-duration="900">
               <img
                  src="/media/img/imac1.png"
                  alt="Software de gestión para psicólogos - Panel de control Rezerva.es"
                  class="w-full object-contain rounded-xl shadow-2xl">
            </div>

         </div>
      </div>


      {{-- =========================================================
         PROBLEMAS QUE RESOLVEMOS
      ========================================================= --}}
      <div class="bg-white py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Problemas que Rezerva.es soluciona para tu consulta
               </h2>
               <p class="mt-6 text-lg text-gray-600"
                  data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  Sabemos los retos diarios de gestionar una consulta de psicología. Por eso hemos creado una herramienta que elimina las tareas administrativas para que te centres en tus pacientes.
               </p>
            </div>

            <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-red-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Horas perdidas en gestión</h3>
                  <p class="mt-3 text-gray-600">
                     Llamadas, WhatsApps, emails para confirmar citas... Con Rezerva.es tus pacientes reservan solos y reciben recordatorios automáticos.
                  </p>
               </div>

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Cobros complicados</h3>
                  <p class="mt-3 text-gray-600">
                     Perseguir pagos, transferencias que no llegan, efectivo... Activa pagos online y cobra automáticamente antes de cada sesión.
                  </p>
               </div>

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 text-yellow-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Historial desorganizado</h3>
                  <p class="mt-3 text-gray-600">
                     Notas en papeles, archivos dispersos... Centraliza todo el historial del paciente: sesiones, notas, evolución y pagos en un solo lugar.
                  </p>
               </div>

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Ausencias y cancelaciones</h3>
                  <p class="mt-3 text-gray-600">
                     Los no-shows cuestan dinero. Con recordatorios automáticos y pagos anticipados reduces las ausencias hasta un 90%.
                  </p>
               </div>

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-delay="400" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Agenda caótica</h3>
                  <p class="mt-3 text-gray-600">
                     Citas superpuestas, huecos sin llenar, horarios confusos. Visualiza tu semana completa con una agenda clara y profesional.
                  </p>
               </div>

               <div class="relative rounded-2xl border border-gray-200 bg-gray-50 p-8 hover:shadow-lg transition-shadow"
                  data-aos="fade-up" data-aos-delay="500" data-aos-duration="900">
                  <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-green-600">
                     <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                     </svg>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Sin control de negocio</h3>
                  <p class="mt-3 text-gray-600">
                     Estadísticas de ingresos, pacientes recurrentes, servicios más demandados... Toma decisiones basadas en datos reales.
                  </p>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
         FUNCIONALIDADES PRINCIPALES
      ========================================================= --}}
      <div id="funcionalidades" class="bg-gray-100 py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide"
                  data-aos="fade-up" data-aos-duration="900">
                  Funcionalidades
               </p>
               <h2 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  Todo lo que necesitas para gestionar tu consulta de psicología
               </h2>
            </div>

            {{-- FUNCIONALIDAD 1: Interfaz Intuitiva --}}
            <div class="mt-24 grid items-center gap-12 lg:grid-cols-2">
               <div data-aos="fade-right" data-aos-duration="900">
                  <div class="inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700">
                     <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                     </svg>
                     Interfaz Ultra Intuitiva
                  </div>
                  <h3 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
                     Diseñada para que no pierdas ni un segundo
                  </h3>
                  <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                     Nuestra interfaz ha sido diseñada específicamente pensando en profesionales de la salud mental.
                     <strong>Sin curva de aprendizaje</strong>, sin menús confusos, sin funciones innecesarias.
                  </p>
                  <ul class="mt-8 space-y-4">
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Panel limpio y minimalista:</strong> Solo ves lo que necesitas, cuando lo necesitas</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Navegación en 2 clics:</strong> Accede a cualquier función sin perderte</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Responsive total:</strong> Gestiona desde móvil, tablet u ordenador</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Accesos rápidos:</strong> Las acciones frecuentes siempre a mano</span>
                     </li>
                  </ul>
               </div>
               <div class="rounded-2xl bg-white p-4 shadow-xl" data-aos="fade-left" data-aos-delay="200" data-aos-duration="900">
                  <img src="/media/img/imac1.png" alt="Interfaz intuitiva para psicólogos - Rezerva.es" class="rounded-xl w-full">
               </div>
            </div>

            {{-- FUNCIONALIDAD 2: Pagos Online --}}
            <div class="mt-32 grid items-center gap-12 lg:grid-cols-2">
               <div class="order-2 lg:order-1 rounded-2xl bg-white p-4 shadow-xl" data-aos="fade-right" data-aos-duration="900">
                  <img src="/media/img/imac1.png" alt="Sistema de pagos online para psicólogos - Rezerva.es" class="rounded-xl w-full">
               </div>
               <div class="order-1 lg:order-2" data-aos="fade-left" data-aos-delay="200" data-aos-duration="900">
                  <div class="inline-flex items-center gap-2 rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                     <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                     </svg>
                     Pagos Online Integrados
                  </div>
                  <h3 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
                     Cobra automáticamente cada sesión
                  </h3>
                  <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                     Olvídate de perseguir pagos. Con <strong>Stripe Connect</strong> integrado, tus pacientes pagan al reservar
                     y el dinero llega directamente a tu cuenta bancaria.
                  </p>
                  <ul class="mt-8 space-y-4">
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Pago al reservar:</strong> El paciente paga cuando agenda su cita online</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Tarjeta, Bizum, Google/Apple Pay:</strong> Todos los métodos de pago</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Facturación automática:</strong> Genera facturas sin esfuerzo</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Bonos y paquetes:</strong> Vende sesiones en packs con descuento</span>
                     </li>
                  </ul>
               </div>
            </div>

            {{-- FUNCIONALIDAD 3: Gestión de Pacientes --}}
            <div class="mt-32 grid items-center gap-12 lg:grid-cols-2">
               <div data-aos="fade-right" data-aos-duration="900">
                  <div class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-700">
                     <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                     Gestión de Pacientes
                  </div>
                  <h3 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
                     Toda la información de cada paciente en un lugar
                  </h3>
                  <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                     Cada paciente tiene su <strong>ficha completa</strong> con historial de sesiones, notas clínicas,
                     documentos adjuntos, pagos realizados y próximas citas programadas.
                  </p>
                  <ul class="mt-8 space-y-4">
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Fichas de paciente:</strong> Datos personales, contacto de emergencia, historial</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Notas privadas:</strong> Añade observaciones que solo tú puedes ver</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Historial completo:</strong> Todas las sesiones realizadas con fechas y detalles</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Búsqueda instantánea:</strong> Encuentra cualquier paciente en segundos</span>
                     </li>
                  </ul>
               </div>
               <div class="rounded-2xl bg-white p-4 shadow-xl" data-aos="fade-left" data-aos-delay="200" data-aos-duration="900">
                  <img src="/media/img/imac1.png" alt="Gestión de pacientes para psicólogos - Rezerva.es" class="rounded-xl w-full">
               </div>
            </div>

            {{-- FUNCIONALIDAD 4: Seguimiento de Sesiones --}}
            <div class="mt-32 grid items-center gap-12 lg:grid-cols-2">
               <div class="order-2 lg:order-1 rounded-2xl bg-white p-4 shadow-xl" data-aos="fade-right" data-aos-duration="900">
                  <img src="/media/img/imac1.png" alt="Seguimiento de sesiones de psicología - Rezerva.es" class="rounded-xl w-full">
               </div>
               <div class="order-1 lg:order-2" data-aos="fade-left" data-aos-delay="200" data-aos-duration="900">
                  <div class="inline-flex items-center gap-2 rounded-full bg-purple-100 px-4 py-2 text-sm font-semibold text-purple-700">
                     <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                     </svg>
                     Seguimiento de Sesiones
                  </div>
                  <h3 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
                     Controla la evolución de cada paciente
                  </h3>
                  <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                     Registra notas después de cada sesión, programa citas de seguimiento automáticamente
                     y mantén un <strong>control total del proceso terapéutico</strong>.
                  </p>
                  <ul class="mt-8 space-y-4">
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Notas post-sesión:</strong> Documenta cada sesión con notas clínicas</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Recordatorios automáticos:</strong> SMS y email antes de cada cita</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Citas recurrentes:</strong> Programa sesiones semanales o quincenales</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Alertas de seguimiento:</strong> No pierdas el contacto con ningún paciente</span>
                     </li>
                  </ul>
               </div>
            </div>

            {{-- FUNCIONALIDAD 5: Organización y Vistas --}}
            <div class="mt-32 grid items-center gap-12 lg:grid-cols-2">
               <div data-aos="fade-right" data-aos-duration="900">
                  <div class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-700">
                     <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                     </svg>
                     Organización Total
                  </div>
                  <h3 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
                     Vistas organizadas para cada necesidad
                  </h3>
                  <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                     Cambia entre vista diaria, semanal o mensual. Filtra por tipo de servicio,
                     por paciente o por estado de pago. <strong>Tu consulta, organizada como tú quieras</strong>.
                  </p>
                  <ul class="mt-8 space-y-4">
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Vista diaria:</strong> Todas las citas del día de un vistazo</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Vista semanal:</strong> Planifica tu semana completa</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Calendario mensual:</strong> Visión general de tu disponibilidad</span>
                     </li>
                     <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700"><strong>Filtros avanzados:</strong> Encuentra cualquier cita al instante</span>
                     </li>
                  </ul>
               </div>
               <div class="rounded-2xl bg-white p-4 shadow-xl" data-aos="fade-left" data-aos-delay="200" data-aos-duration="900">
                  <img src="/media/img/imac1.png" alt="Agenda organizada para psicólogos - Rezerva.es" class="rounded-xl w-full">
               </div>
            </div>

         </div>
      </div>


      {{-- =========================================================
         MÁS FUNCIONALIDADES (Grid)
      ========================================================= --}}
      <div class="bg-white py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Y mucho más para tu consulta de psicología
               </h2>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">App móvil</h3>
                  <p class="mt-2 text-sm text-gray-600">Gestiona tu consulta desde el móvil en cualquier momento.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="50" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Recordatorios SMS</h3>
                  <p class="mt-2 text-sm text-gray-600">Reduce ausencias con recordatorios automáticos.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">RGPD compliant</h3>
                  <p class="mt-2 text-sm text-gray-600">Datos encriptados y cumplimiento total con la ley.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Link de reservas</h3>
                  <p class="mt-2 text-sm text-gray-600">Comparte tu link y recibe reservas 24/7.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Videoconsultas</h3>
                  <p class="mt-2 text-sm text-gray-600">Sesiones online integradas en la plataforma.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="250" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Estadísticas</h3>
                  <p class="mt-2 text-sm text-gray-600">Ingresos, pacientes, servicios más demandados.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-teal-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Sincronización</h3>
                  <p class="mt-2 text-sm text-gray-600">Conecta con Google Calendar y Outlook.</p>
               </div>

               <div class="rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="350" data-aos-duration="900">
                  <div class="h-10 w-10 rounded-lg bg-pink-100 flex items-center justify-center">
                     <svg class="h-5 w-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                     </svg>
                  </div>
                  <h3 class="mt-4 font-semibold text-gray-900">Soporte humano</h3>
                  <p class="mt-2 text-sm text-gray-600">Ayuda real de personas reales cuando lo necesites.</p>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
         CÓMO FUNCIONA
      ========================================================= --}}
      <div class="bg-gray-100 py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Empieza a usar Rezerva.es en 3 pasos
               </h2>
               <p class="mt-6 text-lg text-gray-600"
                  data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  Configuración rápida, sin complicaciones técnicas
               </p>
            </div>

            <div class="mt-16 grid gap-8 lg:grid-cols-3">

               <div class="relative" data-aos="fade-up" data-aos-duration="900">
                  <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-2xl font-bold text-white">
                     1
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Crea tu cuenta gratis</h3>
                  <p class="mt-4 text-gray-600">
                     Regístrate en menos de 2 minutos. Sin tarjeta de crédito, sin compromisos.
                     Acceso inmediato a todas las funciones durante 14 días.
                  </p>
               </div>

               <div class="relative" data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-2xl font-bold text-white">
                     2
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Configura tu consulta</h3>
                  <p class="mt-4 text-gray-600">
                     Añade tus servicios (terapia individual, parejas, grupal...), define tus horarios
                     y personaliza tu página de reservas.
                  </p>
               </div>

               <div class="relative" data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-2xl font-bold text-white">
                     3
                  </div>
                  <h3 class="mt-6 text-xl font-semibold text-gray-900">Comparte tu link</h3>
                  <p class="mt-4 text-gray-600">
                     Comparte tu enlace personalizado en redes sociales, tu web o WhatsApp.
                     Los pacientes reservan solos 24/7.
                  </p>
               </div>

            </div>

            <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="900">
               <a href="https://panel.rezerva.es/registro"
                  class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-lg hover:bg-indigo-500 transition-all hover:scale-105">
                  Crear mi cuenta gratis
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                  </svg>
               </a>
            </div>

         </div>
      </div>


      {{-- =========================================================
         TESTIMONIOS
      ========================================================= --}}
      <div class="bg-white py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">
               <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Lo que dicen otros psicólogos
               </h2>
            </div>

            <div class="mt-16 grid gap-8 lg:grid-cols-3">

               <div class="rounded-2xl bg-gray-50 p-8" data-aos="fade-up" data-aos-duration="900">
                  <div class="flex gap-1 text-yellow-400">
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                  </div>
                  <p class="mt-6 text-gray-700">
                     "Desde que uso Rezerva.es he recuperado <strong>5 horas semanales</strong> que antes perdía gestionando citas por WhatsApp. Ahora los pacientes reservan solos y yo me centro en lo importante."
                  </p>
                  <div class="mt-6 flex items-center gap-4">
                     <div class="h-12 w-12 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-semibold">
                        MC
                     </div>
                     <div>
                        <p class="font-semibold text-gray-900">María Castillo</p>
                        <p class="text-sm text-gray-500">Psicóloga clínica · Madrid</p>
                     </div>
                  </div>
               </div>

               <div class="rounded-2xl bg-gray-50 p-8" data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <div class="flex gap-1 text-yellow-400">
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                  </div>
                  <p class="mt-6 text-gray-700">
                     "El sistema de pagos online ha sido revolucionario. <strong>Ya no persigo cobros</strong>, los pacientes pagan al reservar y yo recibo el dinero automáticamente. Profesional y cómodo."
                  </p>
                  <div class="mt-6 flex items-center gap-4">
                     <div class="h-12 w-12 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-semibold">
                        JR
                     </div>
                     <div>
                        <p class="font-semibold text-gray-900">Javier Rodríguez</p>
                        <p class="text-sm text-gray-500">Psicólogo sanitario · Barcelona</p>
                     </div>
                  </div>
               </div>

               <div class="rounded-2xl bg-gray-50 p-8" data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <div class="flex gap-1 text-yellow-400">
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                     <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                           d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                     </svg>
                  </div>
                  <p class="mt-6 text-gray-700">
                     "La interfaz es increíblemente simple. En mi anterior software tardaba minutos en hacer cualquier cosa. Con Rezerva.es <strong>todo está a dos clics</strong>. Lo recomiendo a todos mis colegas."
                  </p>
                  <div class="mt-6 flex items-center gap-4">
                     <div class="h-12 w-12 rounded-full bg-purple-200 flex items-center justify-center text-purple-700 font-semibold">
                        LG
                     </div>
                     <div>
                        <p class="font-semibold text-gray-900">Laura García</p>
                        <p class="text-sm text-gray-500">Psicóloga infantil · Valencia</p>
                     </div>
                  </div>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
         FAQ SEO
      ========================================================= --}}
      <div class="bg-gray-100 py-24 sm:py-32">
         <div class="mx-auto max-w-4xl px-6 lg:px-8">

            <div class="text-center">
               <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                  data-aos="fade-up" data-aos-duration="900">
                  Preguntas frecuentes sobre software para psicólogos
               </h2>
            </div>

            <div class="mt-16 space-y-8">

               <div class="rounded-xl bg-white p-6 shadow-sm" data-aos="fade-up" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     ¿Qué es un software de gestión para psicólogos?
                  </h3>
                  <p class="mt-3 text-gray-600">
                     Un software de gestión para psicólogos es una herramienta digital que permite organizar la agenda de citas,
                     gestionar pacientes, procesar pagos online, mantener historiales clínicos y automatizar recordatorios.
                     Rezerva.es ofrece todas estas funciones en una plataforma intuitiva diseñada específicamente para profesionales de la salud mental.
                  </p>
               </div>

               <div class="rounded-xl bg-white p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     ¿Cómo funcionan los pagos online para sesiones de psicología?
                  </h3>
                  <p class="mt-3 text-gray-600">
                     Con Rezerva.es, puedes activar pagos online con Stripe Connect. Cuando un paciente reserva una cita,
                     paga automáticamente con tarjeta, Bizum o Google/Apple Pay. El dinero se transfiere directamente a tu cuenta bancaria.
                     Esto reduce las ausencias y elimina la necesidad de gestionar cobros manualmente.
                  </p>
               </div>

               <div class="rounded-xl bg-white p-6 shadow-sm" data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     ¿Rezerva.es cumple con la RGPD y la protección de datos de pacientes?
                  </h3>
                  <p class="mt-3 text-gray-600">
                     Sí, Rezerva.es cumple totalmente con el Reglamento General de Protección de Datos (RGPD).
                     Todos los datos de pacientes están encriptados, almacenados en servidores seguros en la UE
                     y solo accesibles por el profesional autorizado. La privacidad y confidencialidad son nuestra prioridad.
                  </p>
               </div>

               <div class="rounded-xl bg-white p-6 shadow-sm" data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     ¿Puedo ofrecer sesiones de terapia online con videollamada?
                  </h3>
                  <p class="mt-3 text-gray-600">
                     Sí, Rezerva.es permite integrar videoconsultas en tu práctica. Los pacientes pueden reservar sesiones presenciales
                     u online, y reciben un enlace automático para conectarse a la videollamada en el horario programado.
                     Ideal para terapia a distancia o consultas híbridas.
                  </p>
               </div>

               <div class="rounded-xl bg-white p-6 shadow-sm" data-aos="fade-up" data-aos-delay="400" data-aos-duration="900">
                  <h3 class="text-lg font-semibold text-gray-900">
                     ¿Cuánto cuesta Rezerva.es para psicólogos?
                  </h3>
                  <p class="mt-3 text-gray-600">
                     Rezerva.es ofrece una prueba gratuita de 14 días sin necesidad de tarjeta de crédito.
                     Después, los planes empiezan desde un precio muy asequible con todas las funcionalidades incluidas.
                     Sin costes ocultos, sin comisiones por reserva. Consulta nuestros planes actualizados en la web.
                  </p>
               </div>

            </div>

         </div>
      </div>


      {{-- =========================================================
         CONTENIDO SEO LARGO
      ========================================================= --}}
      <div id="seo" class="bg-white py-24 sm:py-32">
         <div class="mx-auto max-w-4xl px-6 lg:px-8">

            <article class="prose prose-lg prose-indigo max-w-none">

               <h2 class="text-3xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="900">
                  Software de gestión integral para psicólogos y consultas de psicología
               </h2>

               <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  En el mundo actual, los <strong>psicólogos y profesionales de la salud mental</strong> necesitan herramientas digitales
                  que les permitan centrarse en lo que realmente importa: sus pacientes. La gestión administrativa tradicional
                  consume horas valiosas que podrían dedicarse a la práctica clínica.
               </p>

               <p data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <strong>Rezerva.es</strong> es un software de gestión diseñado específicamente para consultas de psicología,
                  gabinetes psicológicos, centros de salud mental y psicólogos autónomos que buscan <strong>profesionalizar
                     y automatizar su práctica</strong>.
               </p>

               <h3 class="text-2xl font-bold text-gray-900 mt-12" data-aos="fade-up" data-aos-duration="900">
                  Ventajas de digitalizar tu consulta de psicología
               </h3>

               <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  La transformación digital en el sector de la salud mental no es opcional: es necesaria.
                  Los pacientes de hoy esperan poder <strong>reservar citas online 24/7</strong>, recibir recordatorios automáticos
                  y pagar de forma segura sin complicaciones.
               </p>

               <p data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  Con un <strong>sistema de agenda online para psicólogos</strong> como Rezerva.es, reduces las ausencias hasta un 90%
                  gracias a los recordatorios por SMS y email. Además, al cobrar por adelantado, eliminas los impagos
                  y aseguras tus ingresos.
               </p>

               <h3 class="text-2xl font-bold text-gray-900 mt-12" data-aos="fade-up" data-aos-duration="900">
                  Gestión de pacientes y fichas clínicas digitales
               </h3>

               <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  Cada paciente merece una atención personalizada basada en su historial. Rezerva.es te permite
                  mantener <strong>fichas de pacientes completas</strong> con toda la información relevante:
                  datos personales, historial de sesiones, notas clínicas privadas, estado de pagos y próximas citas.
               </p>

               <p data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  El <strong>seguimiento de sesiones</strong> es fundamental en psicología. Nuestra plataforma te permite
                  documentar cada sesión, programar citas de seguimiento automáticas y mantener un registro completo
                  del proceso terapéutico de cada paciente.
               </p>

               <h3 class="text-2xl font-bold text-gray-900 mt-12" data-aos="fade-up" data-aos-duration="900">
                  Tipos de psicólogos que usan Rezerva.es
               </h3>

               <ul data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  <li><strong>Psicólogos clínicos:</strong> Gestión de terapia individual y seguimiento de tratamientos</li>
                  <li><strong>Psicólogos sanitarios:</strong> Organización de consultas privadas y públicas</li>
                  <li><strong>Psicólogos infantiles:</strong> Coordinación con padres y gestión de sesiones familiares</li>
                  <li><strong>Psicólogos de pareja:</strong> Agenda compartida para sesiones de terapia conjunta</li>
                  <li><strong>Neuropsicólogos:</strong> Seguimiento de evaluaciones y planes de intervención</li>
                  <li><strong>Psicólogos organizacionales:</strong> Gestión de clientes corporativos y sesiones grupales</li>
                  <li><strong>Gabinetes y centros:</strong> Gestión multi-profesional con varios psicólogos</li>
               </ul>

               <h3 class="text-2xl font-bold text-gray-900 mt-12" data-aos="fade-up" data-aos-duration="900">
                  Por qué elegir Rezerva.es frente a otras soluciones
               </h3>

               <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
                  Existen muchos programas genéricos de gestión de citas, pero pocos están diseñados pensando
                  en las <strong>necesidades específicas de los psicólogos</strong>. Rezerva.es combina la simplicidad
                  de uso con funcionalidades profesionales:
               </p>

               <ul data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                  <li>Interfaz ultra intuitiva que no requiere formación</li>
                  <li>Pagos online integrados con Stripe (sin comisiones ocultas)</li>
                  <li>Recordatorios automáticos por SMS y email</li>
                  <li>Fichas de pacientes con historial completo</li>
                  <li>Cumplimiento total con RGPD</li>
                  <li>Soporte en español por personas reales</li>
                  <li>Precios accesibles para autónomos y pequeñas consultas</li>
               </ul>

               <div class="mt-12 rounded-2xl bg-indigo-50 p-8 text-center" data-aos="fade-up" data-aos-duration="900">
                  <p class="text-xl font-semibold text-gray-900">
                     Únete a los más de 2.500 psicólogos que ya gestionan su consulta con Rezerva.es
                  </p>
                  <a href="https://panel.rezerva.es/registro"
                     class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-lg hover:bg-indigo-500 transition-all">
                     Probar gratis 14 días
                  </a>
               </div>

            </article>

         </div>
      </div>


      {{-- =========================================================
         CTA FINAL
      ========================================================= --}}
      <div class="bg-indigo-600 py-24 sm:py-32">
         <div class="mx-auto max-w-4xl px-6 text-center lg:px-8">

            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-5xl"
               data-aos="fade-up" data-aos-duration="900">
               Transforma tu consulta de psicología hoy
            </h2>

            <p class="mt-6 text-xl text-indigo-100"
               data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
               Empieza gratis y descubre por qué miles de psicólogos confían en Rezerva.es
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4"
               data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
               <a href="https://panel.rezerva.es/registro"
                  class="w-full sm:w-auto rounded-xl bg-white px-8 py-4 text-lg font-semibold text-indigo-600 shadow-lg hover:bg-indigo-50 transition-all hover:scale-105">
                  Crear cuenta gratis
               </a>
               <a href="#funcionalidades"
                  class="w-full sm:w-auto rounded-xl border-2 border-indigo-300 px-8 py-4 text-lg font-semibold text-white hover:bg-indigo-500 transition-all">
                  Ver demo
               </a>
            </div>

            <p class="mt-8 text-sm text-indigo-200" data-aos="fade-up" data-aos-delay="300">
               Sin tarjeta de crédito · 14 días gratis · Cancela cuando quieras
            </p>

         </div>
      </div>

   </section>


@endsection

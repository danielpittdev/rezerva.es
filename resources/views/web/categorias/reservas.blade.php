@extends('plantilla.web.full')

@section('contenido')
   <!-- SECCION HERO -->
   <section class="min-h-[91vh] flex bg-gradient-to-tr from-blue-500 to-purple-600 text-white overflow-hidden">
      <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-2 grid-cols-1 items-center">

         <!-- Imagen (solo desktop) -->
         <div class="hidden lg:block relative">
            <img
               data-aos="fade-right"
               data-aos-duration="1000"
               data-aos-delay="300"
               class="w-full max-w-3xl -ml-40 scale-125"
               src="/media/img/cap5.png"
               alt="">
         </div>

         <!-- Texto -->
         <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="py-16 lg:py-0 space-y-7 max-w-[520px]">
            <h1 class="font-medium text-5xl leading-tight">
               Organiza las reservas de tu negocio
            </h1>

            <div class="space-y-5">
               <h3 class="font-normal text-xl leading-relaxed">
                  Pensado para ser rápido e intuitivo en cada acción que hagas para tus clientes.
                  Crea a tu cliente a la misma vez que ya estás reservando su cita o reserva.
               </h3>

               <h3 class="font-normal text-xl leading-relaxed">
                  Automatiza tu agenda, gestiona clientes internos y controla tus próximas reservas
                  en una sola pantalla.
               </h3>
            </div>

            <div class="caja mt-10">
               <a href="{{ route('registro') }}"
                  class="rounded-md bg-white p-3 px-5 text-md font-semibold text-black shadow-xs hover:bg-gray-100 focus-visible:outline-indigo-600">
                  Empezar ahora
               </a>
            </div>
         </div>

      </div>
   </section>


   <!-- SECCION 2 -->
   <section class="flex lg:p-7 p-5 bg-gradient-to-t from-gray-50 to-gray-100 text-base-content overflow-hidden">
      <div class="w-full max-w-7xl mx-auto gap-10 px-6 grid lg:grid-cols-2 grid-cols-1 items-center">

         <!-- Texto -->
         <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="space-y-7 max-w-[520px] py-12 lg:py-0">
            <h2 class="font-medium text-5xl leading-tight">
               Ten a mano siempre tus reservas
            </h2>

            <div class="space-y-5">
               <h3 class="font-normal text-xl leading-relaxed">
                  Revisa en un vistazo tu día, los ingresos estimados y también el calendario rápido del día.
                  Todo lo tienes en una sola pantalla sin más.
               </h3>

               <h3 class="font-normal text-xl leading-relaxed">
                  Revisa tu calendario, de manera clara, rápida y precisa.
                  Reconoce al instante las acciones de tus clientes y mantente al tanto sin apuntes y sin pérdida de tiempo.
               </h3>
            </div>

            <div class="caja mt-10">
               <a href="{{ route('registro') }}"
                  class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">
                  Empezar ahora
               </a>
            </div>
         </div>

         <!-- Imagenes -->
         <div class="relative flex justify-center lg:justify-end py-16 lg:py-0">
            <div class="relative w-full max-w-xl h-[520px] sm:h-[580px] lg:h-[620px]">

               <img
                  data-aos="fade-left"
                  data-aos-duration="500"
                  data-aos-delay="500"
                  class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 w-[260px] sm:w-[300px] lg:w-[340px]"
                  src="/media/img/iphone5.png"
                  alt="">

               <img
                  data-aos="fade-left"
                  data-aos-duration="500"
                  data-aos-delay="800"
                  class="hidden lg:block absolute right-0 top-12 w-[340px]"
                  src="/media/img/iphone4.png"
                  alt="">

            </div>
         </div>

      </div>
   </section>


   <!-- SECCION 3 -->
   <section class="flex lg:p-7 p-5 bg-gradient-to-t from-gray-700 to-black text-white overflow-hidden">
      <div class="w-full max-w-7xl mx-auto gap-10 p-6 grid grid-cols-1 lg:grid-rows-[auto_1fr]">

         <!-- Texto -->
         <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="space-y-7 max-w-3xl mx-auto text-center py-12 lg:py-0">
            <h2 class="font-medium lg:text-5xl text-4xl leading-tight">
               Portal de reservas online propio
            </h2>

            <div class="space-y-5">
               <h3 class="font-normal text-xl leading-relaxed">
                  Creado para que tus clientes reserven en menos de 2 minutos contigo.
                  Sin interfaces complejas y adaptado a todas las pantallas.
               </h3>

               <h3 class="font-normal text-xl leading-relaxed">
                  Un portal moderno, rápido y escalable para que tu negocio reciba reservas 24/7 sin llamadas ni mensajes.
               </h3>
            </div>

            <div class="caja mt-10">
               <a href="{{ route('registro') }}"
                  class="rounded-md bg-white p-3 px-5 text-md font-semibold text-black shadow-xs hover:bg-gray-100 focus-visible:outline-indigo-600">
                  Empezar ahora
               </a>
            </div>
         </div>

         <!-- Imagenes: en móvil centradas (no absolute), en desktop flotantes -->
         <div class="relative flex justify-center items-center py-16 lg:py-0">
            <div class="relative w-full max-w-5xl">

               <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 place-items-center lg:hidden">
                  <img
                     data-aos="fade-up"
                     data-aos-duration="1000"
                     data-aos-delay="1000"
                     class="w-[260px] sm:w-[320px]"
                     src="/media/img/iphone2.png"
                     alt="">
                  <img
                     data-aos="fade-up"
                     data-aos-duration="1000"
                     data-aos-delay="1300"
                     class="w-[260px] sm:w-[320px]"
                     src="/media/img/iphone1.png"
                     alt="">
               </div>

               <div class="hidden lg:block relative h-[520px]">
                  <img
                     data-aos="fade-up"
                     data-aos-duration="1000"
                     data-aos-delay="1000"
                     class="absolute left-[52%] top-20 w-[380px] rotate-3"
                     src="/media/img/iphone2.png"
                     alt="">

                  <img
                     data-aos="fade-up"
                     data-aos-duration="1000"
                     data-aos-delay="1300"
                     class="absolute left-[70%] top-10 w-[380px] rotate-3"
                     src="/media/img/iphone1.png"
                     alt="">
               </div>

            </div>
         </div>

      </div>
   </section>


   <!-- SECCION 4 -->
   <section class="flex lg:p-7 p-5 text-black overflow-hidden relative bg-white">
      <div class="w-full max-w-7xl mx-auto gap-10 p-6 grid lg:grid-cols-2 grid-cols-1 items-center">

         <!-- Texto -->
         <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300"
            class="space-y-7 max-w-[550px] py-12 lg:py-0">
            <h2 class="font-medium lg:text-5xl text-4xl leading-tight">
               Panel para administradores
            </h2>

            <div class="space-y-5">
               <h3 class="font-normal text-xl leading-relaxed text-gray-700">
                  Creado para que gestionarlo sea cómodo, fácil e intuitivo.
                  Minimalista y con acceso a todas las características de forma limpia.
               </h3>
            </div>

            <div class="caja mt-10">
               <a href="{{ route('registro') }}"
                  class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">
                  Empezar ahora
               </a>
            </div>
         </div>

         <!-- Imagen -->
         <div class="relative flex justify-center lg:justify-end py-10 lg:py-0">
            <img
               data-aos="fade-up"
               data-aos-duration="1000"
               data-aos-delay="1000"
               class="w-full max-w-4xl object-contain"
               src="/media/img/imac1.png"
               alt="">
         </div>

      </div>
   </section>
@endsection

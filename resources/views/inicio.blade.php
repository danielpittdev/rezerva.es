@extends('plantilla.web.full')

@section('contenido')
   <section class="space-y-20">
      <!-- SEC -->
      <section class="bg-base-200 flex gap-5 w-full text-base-content lg:h-[91vh] h-300">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[auto_1fr] overflow-hidden">

            <div class="lg:my-auto space-y-7 max-w-[500px]">
               <h1 class="font-medium text-6xl">
                  Aumenta las reservas de tu negocio
               </h1>

               <h2 class="font-medium text-2xl">
                  Para tu restaurante, taller, consulta clínica o barberías. Implementa tu sistema de reservas propio y escalable.
               </h2>

               <div class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Empezar ahora</a>
               </div>
            </div>

            <div class="flex items-center relative">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="absolute lg:block hidden lg:start-10 lg:top-10 lg:w-100 lg:-rotate-2" src="/media/img/iphone2.png" alt="">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="absolute lg:block lg:start-60 lg:top-30 lg:w-100 lg:rotate-2 -top-70" src="/media/img/iphone1.png" alt="">
            </div>
         </div>
      </section>

      <!-- SEC -->
      <section class="bg-base-100 text-base-content flex gap-5 w-full min-h-[100vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[1fr_auto] grid-cols-1">

            <div class="flex items-center relative">
               <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" class="rounded-box lg:block hidden lg:-ml-80 absolute scale-170 w-full" src="/media/img/cap5.png" alt="">
            </div>

            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="lg:my-auto space-y-7 max-w-[500px]">
               <h2 class="font-medium text-5xl">
                  Organiza tus citas y reservas en solo un clic
               </h2>

               <div class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     Pensado para ser rápido e intuitivo en cada acción que hagas para tus clientes. Crea a tu cliente a la misma vez que ya estás reservando su cita o reserva.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Pensado para ser rápido e intuitivo en cada acción que hagas para tus clientes. Crea a tu cliente a la misma vez que ya estás reservando su cita o reserva.
                  </h3>
               </div>

               <div class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Empezar ahora</a>
               </div>
            </div>
         </div>
      </section>

      <!-- SEC -->
      <section class="bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[auto_1fr] grid-cols-1">

            <div class="lg:my-auto space-y-7 max-w-[500px]">
               <h2 data-aos="fade-up" data-aos-delay="400" class="font-medium text-5xl">
                  Solución de marca blanca
               </h2>

               <div data-aos="fade-up" data-aos-delay="700" class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     Creamos una marca blanca para tu negocio para que todo lo que se vea esté acorde a tus necesidades y branding de tu negocio.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Tu marca y tu identidad es lo más importante aquí, por eso contamos con numerosas plantillas que puedes solicitar para que tu negocio transmita tu escencia.
                  </h3>
               </div>

               <div data-aos="fade-up" data-aos-delay="1100" class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Empezar ahora</a>
               </div>
            </div>

            <div class="flex items-center relative">
               <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" class="lg:block hidden lg:ml-40 absolute w-120 top-0" src="/media/img/iphone1.png" alt="">
            </div>
         </div>
      </section>

      <!-- SEC -->
      <section class="bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] min-h-[120vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[1fr_auto] grid-cols-1">

            <div class="lg:order-1 order-2 flex items-center relative">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="lg:ml-40 absolute w-130 lg:top-30 -top-40 left-3" src="/media/img/8.png" alt="">
            </div>

            <div class="lg:order-2 order-1 lg:my-auto lg:ml-30 mt-0 space-y-7 max-w-[500px] lg:text-justify">
               <h2 data-aos="fade-up" data-aos-delay="400" class="font-medium text-5xl">
                  Avisa a tus clientes
               </h2>

               <div data-aos="fade-up" data-aos-delay="700" class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     La comunicación entre negocio y cliente es crucial, por eso podrás avisar de manera automática a tus clientes de los cambios que hagas en sus reservas y citas.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Cualquier movimiento será comunicado a tu cliente sin necesidad que te pares a escribir, nos hacemos cargo de enviarle su notificación correspondiente para que tu cliente esté bien notificado.
                  </h3>
               </div>

               <div data-aos="fade-up" data-aos-delay="1100" class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Empezar ahora</a>
               </div>
            </div>
         </div>
      </section>

      <!-- FAQ -->
      <section class="px-5 bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] min-h-[120vh] overflow-hidden">
         <div class="mx-auto max-w-4xl">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Preguntas frecuentes</h2>
            <dl class="mt-16 divide-y divide-gray-900/10">
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-0" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Puedo registrar más de un negocio?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-0" class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           Sí, puedes registrar más de un negocio si necesitas manejar muchos negocios con nuestra herramienta Rezerva Manager
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-1" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Cuanto tardo en conseguir clientes?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-1" hidden class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           Rezerva es una herramienta para recibir a tus clientes, aunque ayuda en las búsquedas de Google se puede conseguir hasta un rendimiento mayor sin que no lo tengas.
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-2" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Rezerva sirve para gestionar franquicias?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-2" hidden class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           Sí, absolutamente. Rezerva funciona para poder gestionar a la misma vez varios negocios e incluso cortejar información adicional como estadísticas de ventas y visitas de los usuarios para tener un rendimiento increíble.
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-3" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">Mi negocio no es físico</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-3" hidden class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           No importa, si eres consultor, terapéuta o te dedicas al sector clínico conferencial, etc... Puedes usar Rezerva.es para que tus clientes puedan contactar contigo y tengas un espacio entero dedicado a tu trabajo.
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-4" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Puedo cancelar cuando quiera?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-4" hidden class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           Sí. Tu suscripción es sin compromiso ni permanencia, entra cuando quieras, date de baja cuando quieras.
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-5" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">
                           La plantilla de mi negocio es muy grande
                        </span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                              <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-5" hidden class="contents">
                     <dd class="mt-2 pr-12">
                        <p class="text-base/7 text-gray-600">
                           No conocemos los límites. En Rezerva puedes agregar a todos los empleados que quieras y gestionarlos de una manera efectiva, rápida y segura. Añade a tu plantilla de empresa a los empleados que quieras.
                        </p>
                     </dd>
                  </el-disclosure>
               </div>
            </dl>
         </div>

      </section>
   </section>
@endsection

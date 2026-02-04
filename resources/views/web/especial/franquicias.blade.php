@extends('plantilla.web.full')

@section('tituloSEO', 'Gestiona reservas para tus franquicias')
@section('descripcionSEO', 'La solución definitiva para franquicias: gestiona múltiples sedes, empleados ilimitados y automatiza la comunicación de toda tu red desde un solo panel.')

@section('contenido')
   <section class="space-y-20">
      <section class="bg-base-200 flex gap-5 w-full text-base-content lg:h-[91vh] h-300">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[auto_1fr] overflow-hidden">

            <div class="lg:my-auto space-y-7 max-w-[500px]">
               <h1 class="font-medium text-6xl">
                  Control total sobre tu red de franquicias
               </h1>

               <h2 class="font-medium text-2xl">
                  La plataforma diseñada para crecer. Gestiona múltiples ubicaciones, cientos de empleados y miles de citas con una simplicidad asombrosa.
               </h2>

               <div class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Escalar mi negocio</a>
               </div>
            </div>

            <div class="flex items-center relative">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="absolute lg:block hidden lg:start-10 lg:top-10 lg:w-100 lg:-rotate-2" src="/media/img/iphone2.png" alt="Gestión de sedes">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500" class="absolute lg:block lg:start-60 lg:top-30 lg:w-100 lg:rotate-2 -top-70" src="/media/img/iphone1.png" alt="Panel de control">
            </div>
         </div>
      </section>

      <section class="bg-base-100 text-base-content flex gap-5 w-full min-h-[100vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[1fr_auto] grid-cols-1">

            <div class="flex items-center relative">
               <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" class="rounded-box lg:block hidden lg:-ml-80 absolute scale-170 w-full" src="/media/img/cap5.png" alt="Dashboard multi-sede">
            </div>

            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="lg:my-auto space-y-7 max-w-[500px]">
               <h2 class="font-medium text-5xl">
                  Negocios y empleados sin límites
               </h2>

               <div class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     ¿Tu red crece? Rezerva.es te acompaña. No cobramos por "asiento" ni por sede adicional. Añade a todo tu equipo y abre nuevas sucursales en un clic.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Nuestra interfaz intuitiva permite que cada gerente de franquicia gestione su propia agenda mientras tú mantienes la visión global de todo el grupo.
                  </h3>
               </div>

               <div class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Empezar ahora</a>
               </div>
            </div>
         </div>
      </section>

      <section class="bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[auto_1fr] grid-cols-1">

            <div class="lg:my-auto space-y-7 max-w-[500px]">
               <h2 data-aos="fade-up" data-aos-delay="400" class="font-medium text-5xl">
                  Unifica la imagen de tu marca
               </h2>

               <div data-aos="fade-up" data-aos-delay="700" class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     Mantén la coherencia visual en todos tus centros. Ofrecemos una solución de marca blanca para que el portal de reservas respire la identidad de tu franquicia.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Personaliza plantillas de forma masiva o individual. Tu marca es el activo más valioso; nosotros nos encargamos de que luzca profesional en cada interacción.
                  </h3>
               </div>

               <div data-aos="fade-up" data-aos-delay="1100" class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Ver demostración</a>
               </div>
            </div>

            <div class="flex items-center relative">
               <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300" class="lg:block hidden lg:ml-40 absolute w-120 top-0" src="/media/img/iphone1.png" alt="Branding personalizado">
            </div>
         </div>
      </section>

      <section class="bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] min-h-[120vh] overflow-hidden">
         <div class="w-full max-w-7xl mx-auto gap-8 px-6 grid lg:grid-cols-[1fr_auto] grid-cols-1">

            <div class="lg:order-1 order-2 flex items-center relative">
               <img data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="lg:ml-40 absolute w-130 lg:top-30 -top-40 left-3" src="/media/img/8.png" alt="Notificaciones automáticas">
            </div>

            <div class="lg:order-2 order-1 lg:my-auto lg:ml-30 mt-0 space-y-7 max-w-[500px] lg:text-justify">
               <h2 data-aos="fade-up" data-aos-delay="400" class="font-medium text-5xl">
                  Comunicación impecable y automática
               </h2>

               <div data-aos="fade-up" data-aos-delay="700" class="space-y-5">
                  <h3 class="font-normal text-base-content/70 text-xl">
                     La entereza de tu negocio reside en su atención al cliente. Enviamos correos y notificaciones automáticas con un diseño pulcro y profesional por cada acción realizada.
                  </h3>

                  <h3 class="font-normal text-base-content/70 text-xl">
                     Confirmaciones, recordatorios de citas o cambios de última hora: todo se comunica instantáneamente sin que muevas un dedo, garantizando que tu cliente siempre esté informado.
                  </h3>
               </div>

               <div data-aos="fade-up" data-aos-delay="1100" class="caja mt-10">
                  <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 p-3 px-5 text-md font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600">Probar gratis</a>
               </div>
            </div>
         </div>
      </section>

      <section class="px-5 bg-base-100 text-base-content flex gap-5 w-full lg:min-h-[100vh] min-h-[120vh] overflow-hidden">
         <div class="mx-auto max-w-4xl">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Preguntas frecuentes para Franquicias</h2>
            <dl class="mt-16 divide-y divide-gray-900/10">
               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-0" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Puedo gestionar 50 sedes desde una sola cuenta?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-0" class="contents">
                     <dd class="mt-2 pr-12 text-base/7 text-gray-600">
                        Totalmente. Rezerva Manager está diseñado específicamente para centralizar la gestión de múltiples negocios, permitiéndote saltar de una sede a otra instantáneamente.
                     </dd>
                  </el-disclosure>
               </div>

               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-1" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Hay límites de empleados por local?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-1" hidden class="contents">
                     <dd class="mt-2 pr-12 text-base/7 text-gray-600">
                        Ninguno. Creemos en el crecimiento sin barreras. Puedes añadir a toda tu plantilla, asignarles turnos y servicios específicos sin costes adicionales por usuario.
                     </dd>
                  </el-disclosure>
               </div>

               <div class="py-6 first:pt-0 last:pb-0">
                  <dt>
                     <button type="button" command="--toggle" commandfor="faq-2" class="flex w-full items-start justify-between text-left text-gray-900">
                        <span class="text-base/7 font-semibold">¿Cómo ayudan las estadísticas a mi franquicia?</span>
                        <span class="ml-6 flex h-7 items-center">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                              <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </span>
                     </button>
                  </dt>
                  <el-disclosure id="faq-2" hidden class="contents">
                     <dd class="mt-2 pr-12 text-base/7 text-gray-600">
                        Podrás cotejar información clave como volumen de ventas por sede, horas punta y recurrencia de clientes para tomar decisiones basadas en datos reales.
                     </dd>
                  </el-disclosure>
               </div>
            </dl>
         </div>
      </section>
   </section>
@endsection

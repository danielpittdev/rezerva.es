@extends('plantilla.web.full')

@section('tituloSEO', 'el CRM más potente para tu negocio')
@section('descripcionSEO', 'Gestión total. Controla múltiples negocios, empleados y flujos de comunicación desde una interfaz oscura, minimalista y de alto rendimiento.')

@section('contenido')
   <section class="bg-[#050505] text-white selection:bg-indigo-500/30">

      <section class="relative flex items-center justify-center overflow-hidden min-h-[90vh] px-6">
         <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,#1a1a1a_0%,#050505_100%)]"></div>

         <div class="relative z-10 w-full max-w-5xl mx-auto text-center space-y-8">
            <span data-aos="fade-down" class="inline-block px-4 py-1.5 mb-4 text-xs font-semibold tracking-widest uppercase bg-neutral-900 border border-neutral-800 rounded-full text-indigo-400">
               Rezerva Manager Pro
            </span>
            <h1 data-aos="fade-up" class="text-6xl md:text-8xl font-bold tracking-tighter bg-gradient-to-b from-white to-neutral-500 bg-clip-text text-transparent">
               Gestión Total. <br>Sin límites.
            </h1>
            <p data-aos="fade-up" data-aos-delay="200" class="max-w-2xl mx-auto text-xl md:text-2xl text-neutral-400 font-light leading-relaxed">
               El centro de mando diseñado para quienes lo controlan todo. Administra cada sede, empleado y comunicación con una precisión quirúrgica.
            </p>
            <div data-aos="fade-up" data-aos-delay="400" class="pt-10">
               <a href="{{ route('registro') }}" class="px-8 py-4 text-black bg-white rounded-full font-semibold hover:bg-neutral-200 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                  Tomar el control
               </a>
            </div>
         </div>
      </section>

      <section class="py-32 border-t border-neutral-900">
         <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-8">
               <h2 class="text-4xl md:text-5xl font-semibold tracking-tight">
                  Un solo panel. <br><span class="text-neutral-500">Infinitas posibilidades.</span>
               </h2>
               <p class="text-lg text-neutral-400 leading-relaxed">
                  Cambia de un negocio a otro con la fluidez de un gesto. Rezerva Manager unifica tus estadísticas, agendas y bases de datos en una experiencia cohesiva. No importa si son 2 sedes o 200.
               </p>
               <ul class="space-y-4 text-neutral-300">
                  <li class="flex items-center gap-3 italic font-light"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Negocios ilimitados.</li>
                  <li class="flex items-center gap-3 italic font-light"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Empleados sin restricciones.</li>
                  <li class="flex items-center gap-3 italic font-light"><span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Sincronización en tiempo real.</li>
               </ul>
            </div>
            <div class="relative group">
               <img data-aos="fade-right" data-aos-duration="1000" class="lg:scale-120 relative" src="/media/img/imac2.png" alt="Manager Dashboard Dark">
            </div>
         </div>
      </section>

      <section class="py-32 bg-neutral-950/50">
         <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-[0.8fr_1.2fr] gap-20 items-center">
            <div class="order-2 lg:order-1 flex justify-center">
               <img data-aos="fade-right" class="w-full max-w-md drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]" src="/media/img/iphone6.png" alt="Notificaciones Pro">
            </div>
            <div class="order-1 lg:order-2 space-y-8">
               <h2 class="text-4xl md:text-5xl font-semibold tracking-tight">
                  Los detalles son importantes
               </h2>
               <div class="space-y-6">
                  <p class="text-lg text-neutral-400">
                     Escala tus servicios con una escalabilidad absoluta, personaliza hasta el más mínimo detalle para que tu servicio quede completamente cubierto.
                  </p>
                  <div class="p-6 bg-neutral-900/50 border border-neutral-800 rounded-2xl">
                     <h4 class="text-white font-medium mb-2 italic">Automatización Inteligente</h4>
                     <p class="text-sm text-neutral-500 leading-relaxed">
                        Cada cambio de cita, cada nueva reserva y cada recordatorio se envía con una estructura visual impecable, garantizando que tu marca se sienta premium en la bandeja de entrada.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="py-32 px-6">
         <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-16 tracking-tight">Preguntas frecuentes</h2>
            <div class="divide-y divide-neutral-900 border-t border-b border-neutral-900">

               <details class="group py-6 cursor-pointer">
                  <summary class="flex items-center justify-between list-none">
                     <span class="text-lg font-medium text-neutral-300 group-hover:text-white transition-colors italic">¿Es escalable para franquicias masivas?</span>
                     <span class="text-neutral-600 transition group-open:rotate-45">+</span>
                  </summary>
                  <p class="mt-4 text-neutral-500 leading-relaxed pl-4 border-l border-indigo-500">
                     Arquitectura diseñada para el crecimiento vertical. No hay límites en el número de sedes o transacciones que Rezerva Manager puede procesar simultáneamente.
                  </p>
               </details>

               <details class="group py-6 cursor-pointer">
                  <summary class="flex items-center justify-between list-none">
                     <span class="text-lg font-medium text-neutral-300 group-hover:text-white transition-colors italic">¿Puedo controlar el branding de cada sede?</span>
                     <span class="text-neutral-600 transition group-open:rotate-45">+</span>
                  </summary>
                  <p class="mt-4 text-neutral-500 leading-relaxed pl-4 border-l border-indigo-500">
                     Sí. Ofrecemos marca blanca completa. Cada sede puede heredar el branding global o tener una identidad única, manteniendo siempre la robustez del sistema Manager.
                  </p>
               </details>

               <details class="group py-6 cursor-pointer">
                  <summary class="flex items-center justify-between list-none">
                     <span class="text-lg font-medium text-neutral-300 group-hover:text-white transition-colors italic">¿Cómo funciona el envío masivo de notificaciones?</span>
                     <span class="text-neutral-600 transition group-open:rotate-45">+</span>
                  </summary>
                  <p class="mt-4 text-neutral-500 leading-relaxed pl-4 border-l border-indigo-500">
                     El sistema de entereza de correos funciona bajo una infraestructura de alta entregabilidad. Tus clientes recibirán notificaciones en milisegundos, con diseños adaptativos y profesionales.
                  </p>
               </details>

            </div>
         </div>
      </section>

      <section class="py-20 text-center">
         <div class="max-w-4xl mx-auto px-6 py-20 rounded-[3rem] bg-gradient-to-b from-neutral-900 to-transparent border border-neutral-800">
            <h3 class="text-4xl font-bold mb-8 italic">¿Listo para el siguiente nivel?</h3>
            <a href="{{ route('registro') }}" class="inline-flex items-center justify-center px-10 py-4 bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-500 transition-all hover:scale-105 active:scale-95">
               Configurar mi ecosistema
            </a>
         </div>
      </section>

   </section>
@endsection

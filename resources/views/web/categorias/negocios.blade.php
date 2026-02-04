@extends('plantilla.web.full')

@section('tituloSEO', 'CRM para gestión de negocios online')
@section('descripcionSEO', 'Controla y gestiona todo lo que tu negocio puede hacer. Controla las reservas y posiciona en Google tu negocio')

@section('contenido')
   <!-- SEC -->
   <section>

      <div class="relative isolate">
         <svg aria-hidden="true" class="absolute inset-x-0 top-0 -z-10 h-256 w-full mask-[radial-gradient(32rem_32rem_at_center,white,transparent)] stroke-gray-200">
            <defs>
               <pattern id="1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                  <path d="M.5 200V.5H200" fill="none" />
               </pattern>
            </defs>
            <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
               <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" fill="url(#1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84)" stroke-width="0" />
         </svg>
         <div aria-hidden="true" class="absolute top-0 right-0 left-1/2 -z-10 -ml-24 transform-gpu overflow-hidden blur-3xl lg:ml-24 xl:ml-48">
            <div style="clip-path: polygon(63.1% 29.5%, 100% 17.1%, 76.6% 3%, 48.4% 0%, 44.6% 4.7%, 54.5% 25.3%, 59.8% 49%, 55.2% 57.8%, 44.4% 57.2%, 27.8% 47.9%, 35.1% 81.5%, 0% 97.7%, 39.2% 100%, 35.2% 81.4%, 97.2% 52.8%, 63.1% 29.5%)"
               class="aspect-801/1036 w-200.25 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30"></div>
         </div>
         <div class="overflow-hidden">
            <div class="mx-auto max-w-7xl px-6 pt-36 pb-32 sm:pt-60 lg:px-8 lg:pt-32">
               <div class="mx-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
                  <div class="relative w-full lg:max-w-xl lg:shrink-0 xl:max-w-2xl">
                     <h1 class="text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl">Gestor de reservas para tu negocio</h1>
                     <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:max-w-md sm:text-xl/8 lg:max-w-none">
                        Integra tu propio sistema de agendamiento virtual en unos pocos clics y a un precio ultra cómodo. Si quieres gestionar tu negocio, no escondemos precios extras, todo unificado en un solo lugar. Rezerva.es, tu software de agendamiento online.
                     </p>
                     <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('registro') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Empezar gratis</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Ver más <span aria-hidden="true">→</span></a>
                     </div>
                  </div>
                  <div class="mt-14 flex justify-end gap-8 sm:-mt-44 sm:justify-start sm:pl-20 lg:mt-0 lg:pl-0">
                     <div class="ml-auto w-44 flex-none space-y-8 pt-32 sm:ml-0 sm:pt-80 lg:order-last lg:pt-36 xl:order-0 xl:pt-80">
                        <div class="relative">
                           <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&h=528&q=80" alt="" class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg" />
                           <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
                        </div>
                     </div>
                     <div class="mr-auto w-44 flex-none space-y-8 sm:mr-0 sm:pt-52 lg:pt-36">
                        <div class="relative">
                           <img src="https://images.unsplash.com/photo-1485217988980-11786ced9454?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&h=528&q=80" alt="" class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg" />
                           <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
                        </div>
                        <div class="relative">
                           <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-x=.4&w=396&h=528&q=80" alt=""
                              class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg" />
                           <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
                        </div>
                     </div>
                     <div class="w-44 flex-none space-y-8 pt-32 sm:pt-0">
                        <div class="relative">
                           <img src="https://images.unsplash.com/photo-1670272504528-790c24957dda?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=left&w=400&h=528&q=80" alt=""
                              class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg" />
                           <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
                        </div>
                        <div class="relative">
                           <img src="https://images.unsplash.com/photo-1670272505284-8faba1c31f7d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&h=528&q=80" alt="" class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg" />
                           <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </section>

   <!-- SEC -->
   <section>

      <div class="overflow-hidden bg-white py-24 sm:py-32">
         <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
               <div class="lg:ml-auto lg:pt-4 lg:pl-4">
                  <div class="lg:max-w-lg">
                     <h2 class="text-base/7 font-semibold text-indigo-600">Software de agendamiento online</h2>
                     <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Ordena tus citas de manera intuitiva</p>
                     <p class="mt-6 text-lg/8 text-gray-600">
                        Si lo que buscas es una <strong>agenda online</strong> para tu negocio de <strong>barbería</strong>, <strong>consulta de psicología</strong> o <strong>centro de estética</strong>, te ayudamos a montar toda tu agenda en <strong>menos de 5 minutos</strong> para que empieces a
                        organizar de manera
                        instantánea y sin
                        demoras. <strong>Tu
                           tiempo es valioso</strong> y no
                        estás
                        para
                        perderlo.
                     </p>
                     <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none">
                        <div class="relative pl-9">
                           <dt class="inline font-semibold text-gray-900">
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="absolute top-1 left-1 size-5 text-indigo-600">
                                 <path d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                              Panel sencillo de entender
                           </dt>
                           <dd class="inline">
                              Nada de funcionalidades complejas, todo resumido, sabiendo donde estás tocando, optimizado para que seas ágil.
                           </dd>
                        </div>
                        <div class="relative pl-9">
                           <dt class="inline font-semibold text-gray-900">
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="absolute top-1 left-1 size-5 text-indigo-600">
                                 <path d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                              En la nube
                           </dt>
                           <dd class="inline">
                              No pierdas tus citas en calendarios extensos, en bloc de notas ni en lugares donde se te pierdan, Rezerva lo tiene todo en un mismo sitio, en pleno orden.
                           </dd>
                        </div>
                        <div class="relative pl-9">
                           <dt class="inline font-semibold text-gray-900">
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="absolute top-1 left-1 size-5 text-indigo-600">
                                 <path d="M4.632 3.533A2 2 0 0 1 6.577 2h6.846a2 2 0 0 1 1.945 1.533l1.976 8.234A3.489 3.489 0 0 0 16 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234Z" />
                                 <path d="M4 13a2 2 0 1 0 0 4h12a2 2 0 1 0 0-4H4Zm11.24 2a.75.75 0 0 1 .75-.75H16a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75V15Zm-2.25-.75a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75h-.01Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                              Pensado para negocios
                           </dt>
                           <dd class="inline">
                              Todas las funcionalidades están pensadas para que puedas ser más muy rápido y centrarte en tu trabajo.
                           </dd>
                        </div>
                     </dl>
                  </div>
               </div>
               <div class="flex items-start justify-end lg:order-first">
                  <img width="2432" height="1442" src="/media/img/IMG_0612.webp" alt="Product screenshot" class="w-3xl max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-228" />
               </div>
            </div>
         </div>
      </div>

   </section>

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

@endsection

@extends('plantilla.web.full')

@section('tituloSEO', 'Soporte técnico')
@section('descripcionSEO', 'Descubre por qué miles de negocios están migrando a Rezerva.es: reservas online 24/7, agenda inteligente, alta rápida, empleados ilimitados, recordatorios automáticos, pagos con Stripe, portal web personalizable y soporte en español.')

@section('contenido')

   <section>
      <div class="relative isolate bg-white pt-20">
         <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
            <div class="relative px-6 pt-24 pb-20 sm:pt-32 lg:static lg:px-8 lg:py-48">
               <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                  <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">
                     <svg aria-hidden="true" class="absolute inset-0 size-full mask-[radial-gradient(100%_100%_at_top_right,white,transparent)] stroke-gray-200">
                        <defs>
                           <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="100%" y="-1" patternUnits="userSpaceOnUse">
                              <path d="M130 200V.5M.5 .5H200" fill="none" />
                           </pattern>
                        </defs>
                        <rect width="100%" height="100%" stroke-width="0" class="fill-white" />
                        <svg x="100%" y="-1" class="overflow-visible fill-gray-50">
                           <path d="M-470.5 0h201v201h-201Z" stroke-width="0" />
                        </svg>
                        <rect width="100%" height="100%" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" stroke-width="0" />
                     </svg>
                     <div aria-hidden="true" class="absolute top-[calc(100%-13rem)] -left-56 hidden transform-gpu blur-3xl lg:top-[calc(50%-7rem)] lg:left-[max(-14rem,calc(100%-59rem))]">
                        <div style="clip-path: polygon(74.1% 56.1%, 100% 38.6%, 97.5% 73.3%, 85.5% 100%, 80.7% 98.2%, 72.5% 67.7%, 60.2% 37.8%, 52.4% 32.2%, 47.5% 41.9%, 45.2% 65.8%, 27.5% 23.5%, 0.1% 35.4%, 17.9% 0.1%, 27.6% 23.5%, 76.1% 2.6%, 74.1% 56.1%)"
                           class="aspect-1155/678 w-288.75 bg-linear-to-br from-[#80caff] to-[#4f46e5] opacity-10"></div>
                     </div>
                  </div>
                  <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Soporte técnico de Rezerva.es</h2>
                  <p class="mt-6 text-lg/8 text-gray-600">
                     Si tienes alguna pregunta, duda o problema con Rezerva.es puedes ponerte en contacto con nosotros por aquí. Te responderemos con la mayor brevedad posible y la mayor transparencia para que puedas usar Rezerva.es para tu negocio.
                  </p>
                  <dl class="mt-10 space-y-4 text-base/7 text-gray-600">
                     <div class="flex gap-x-4">
                        <dt class="flex-none">
                           <span class="sr-only">Correo electrónico</span>
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="h-7 w-6 text-gray-400">
                              <path d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"
                                 stroke-linecap="round" stroke-linejoin="round" />
                           </svg>
                        </dt>
                        <dd><a href="mailto:contacto@rezerva.es" class="hover:text-gray-900">contacto@rezerva.es</a></dd>
                     </div>
                  </dl>
               </div>
            </div>
            <form id="enviar_contacto" action="{{ route('api_contacto') }}" method="POST" class="px-6 pt-20 pb-24 sm:pb-32 lg:px-8 lg:py-48">
               @csrf
               <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
                  <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                     <div>
                        <label for="nombre" class="block text-sm/6 font-semibold text-gray-900">Nombre*</label>
                        <div class="mt-2.5">
                           <input id="nombre" type="text" name="nombre" autocomplete="given-name"
                              class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600" />
                        </div>
                     </div>
                     <div>
                        <label for="apellido" class="block text-sm/6 font-semibold text-gray-900">Apellido*</label>
                        <div class="mt-2.5">
                           <input id="apellido" type="text" name="apellido" autocomplete="family-name"
                              class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600" />
                        </div>
                     </div>
                     <div class="sm:col-span-2">
                        <label for="email" class="block text-sm/6 font-semibold text-gray-900">Correo electrónico*</label>
                        <div class="mt-2.5">
                           <input id="email" type="email" name="email" autocomplete="email"
                              class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600" />
                        </div>
                     </div>
                     <div class="sm:col-span-2">
                        <label for="telefono" class="block text-sm/6 font-semibold text-gray-900">Teléfono</label>
                        <div class="mt-2.5">
                           <input id="telefono" type="tel" name="telefono" autocomplete="tel"
                              class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600" />
                        </div>
                     </div>
                     <div class="sm:col-span-2">
                        <label for="mensaje" class="block text-sm/6 font-semibold text-gray-900">Mensaje*</label>
                        <div class="mt-2.5">
                           <textarea id="mensaje" name="mensaje" rows="4" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="mt-8 flex justify-end">
                     <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enviar mensaje</button>
                  </div>
               </div>
            </form>
         </div>
      </div>

   </section>

@endsection

@section('scripts')
   <script>
      const contacto_formulario = document.getElementById('enviar_contacto');

      contacto_formulario.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(contacto_formulario, {
            resetForm: false,
            highlightInputs: true,
            showAlert: false,
            reload: true
         });
      });
   </script>
@endsection

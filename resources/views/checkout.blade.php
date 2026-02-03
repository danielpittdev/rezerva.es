@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] pt-10 pb-30">
      <div class="relative border border-base-content/10 shadow bg-base-100 mx-auto max-w-2xl rounded-3xl overflow-hidden">


         <!-- Cuerpo -->
         <div class="cuerpo min-h-[600px] pt-15 px-5">



            <form id="crearReservaForm" action="{{ route('reserva.store') }}">
               <div class="grid lg:grid-cols-[auto_1fr] grid-cols-1 gap-2">

                  <!-- Caja -->
                  <div class="caja min-w-[100px]">
                     <!-- Calendario -->
                     <div class="calendai bg-base-100">

                        <!-- Desktop -->
                        <div class="border border-base-content/10 rounded-md xl:block hidden caja max-w-xs mx-auto overflow-hidden">

                           <!-- Selectores -->
                           <div class="flex items-center justify-center text-base-content">
                              <div class="flex w-full items-center justify-between bg-base-100 border-b border-base-content/10">
                                 <button type="button" id="btn-prev-month" class="hover:bg-base-200 duration-300 border-r border-base-content/10 flex flex-none items-center justify-center p-1.5 text-base-content hover:text-gray-500">
                                    <span class="sr-only">Mes anterior</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                       <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <div class="flex-auto text-sm font-semibold text-center titulo-mes">-</div>

                                 <button type="button" id="btn-next-month" class="hover:bg-base-200 duration-300 border-l border-base-content/10 flex flex-none items-center justify-center p-1.5 text-base-content hover:text-gray-500">
                                    <span class="sr-only">Mes siguiente</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                       <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>
                              </div>
                           </div>

                           <!-- Calendario DESK -->
                           <div class="mt-3 grid grid-cols-7 text-xs/6 text-gray-500 text-center">
                              <div>Lu</div>
                              <div>Ma</div>
                              <div>Mi</div>
                              <div>Ju</div>
                              <div>Vi</div>
                              <div>Sa</div>
                              <div>Do</div>
                           </div>
                           <div class="grilla-calendario bg-base-200 xl:rounded-box gap-[1px] grid grid-cols-7 overflow-hidden"></div>
                        </div>

                        <!-- Móvil -->
                        <div class="space-y-4 xl:hidden block mx-auto max-w-sm">
                           <!-- Controles -->
                           <div class="flex items-center justify-between">
                              <button id="btn-prev" class="p-2 rounded-full hover:bg-base-300">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                 </svg>
                              </button>

                              <h2 id="mes-actual-mobile" class="text-md font-semibold text-base-content text-center">*</h2>

                              <button id="btn-next" class="p-2 rounded-full hover:bg-base-300">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                 </svg>
                              </button>
                           </div>

                           <!-- Carrusel -->
                           <div id="calendario-horizontal" class="grid grid-cols-7 gap-2"></div>
                        </div>

                     </div>
                  </div>

                  <!-- Caja de horas disponibles -->
                  @csrf
                  <div class="caja">
                     <div class="px-4">
                        <h3 class="text-md font-medium text-base-content mb-4">Selecciona una hora</h3>

                        <!-- Loader -->
                        <div id="horas-loader" class="hidden">
                           <div class="flex items-center justify-center py-8">
                              <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                 <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                 <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                              </svg>
                              <span class="ml-2 text-sm text-base-content/70">Cargando horas...</span>
                           </div>
                        </div>

                        <!-- Mensaje cuando no hay fecha seleccionada -->
                        <div id="horas-placeholder" class="text-start">
                           <p class="text-sm text-base-content/50">Selecciona una fecha en el calendario</p>
                        </div>

                        <!-- Mensaje de cerrado -->
                        <div id="horas-cerrado" class="hidden text-start">
                           <p class="text-sm text-base-content/50">El negocio está cerrado este día</p>
                        </div>

                        <!-- Grid de horas -->
                        <div id="horas-container" class="hidden">
                           <div id="horas-grid" class="grid grid-cols-2 sm:grid-cols-2 gap-2">
                              <!-- Las horas se cargan dinámicamente -->
                           </div>
                        </div>

                        <!-- Input hidden para la fecha y hora seleccionadas -->
                        <input type="hidden" id="fecha-seleccionada" name="fecha" value="">
                        <input type="hidden" id="hora-seleccionada" name="hora" value="">
                     </div>
                  </div>

                  <button type="submit">
                     Wenviar
                  </button>
               </div>
            </form>
         </div>

         <!-- Discalimer -->
         <div class="caja py-10 px-5 border-t border-base-content/10 shadow space-y-7">
            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Rezerva.es es una <strong>plataforma online</strong> para negocios en donde pueden crear su <strong>propio portal de reservas online</strong> y compartirla con todo el mundo de manera rápida y directa. Sube tu audiencia en las <strong>búsquedas de Google</strong>.
            </p>

            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Al realizar una reserva en <strong>{{ $negocio->nombre }}</strong>, el usuario contrata directamente con el negocio o profesional responsable del servicio. Rezerva.es actúa exclusivamente como intermediario tecnológico, facilitando la gestión de reservas y pagos online.
            </p>

            <p class="text-base-content text-base-content/70 text-sm text-justify">
               El negocio <strong>{{ $negocio->nombre }}</strong>, con dirección en <strong>{{ $negocio->postal_direccion }}</strong>, es el único responsable de la prestación del servicio, de la información publicada y de la correcta ejecución de la cita reservada.
            </p>

            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Para más información sobre el funcionamiento de la plataforma, condiciones de uso y derechos del consumidor, puedes consultar las condiciones del servicio .
            </p>

            <div class="caja">
               <small>Powered by</small>
               <img src="/media/logo/logo.png" class="size-8 w-auto" alt="">
               <p class="text-base-content/90 text-sm">
                  ¿Quieres que tu negocio esté online? <a class="hover:underline text-blue-600" href="https://rezerva.es/registro">Regístrate en Rezerva.es</a>
               </p>
            </div>
         </div>
      </div>

   </section>
@endsection

@section('scripts')
   <script>
      const negocioUuid = '{{ $negocio->uuid }}';
      const servicioUuid = '{{ $servicio->uuid }}';

      async function cargarHorasDisponibles(fecha) {
         const loader = document.getElementById('horas-loader');
         const placeholder = document.getElementById('horas-placeholder');
         const cerrado = document.getElementById('horas-cerrado');
         const container = document.getElementById('horas-container');
         const grid = document.getElementById('horas-grid');

         // Mostrar loader
         placeholder.classList.add('hidden');
         cerrado.classList.add('hidden');
         container.classList.add('hidden');
         loader.classList.remove('hidden');

         try {
            const response = await fetch('{{ route('api.horas.disponibles') }}', {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
               },
               body: JSON.stringify({
                  negocio: negocioUuid,
                  servicio: servicioUuid,
                  fecha: fecha
               })
            });

            const data = await response.json();
            loader.classList.add('hidden');

            if (data.mensaje || data.horas.length === 0) {
               cerrado.classList.remove('hidden');
               return;
            }

            // Renderizar horas
            grid.innerHTML = '';
            data.horas.forEach(hora => {
               const btn = document.createElement('button');
               btn.type = 'button';
               btn.className = 'btn-hora px-3 py-2 text-sm font-medium rounded-lg border border-base-content/20 hover:border-indigo-500 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500';
               btn.textContent = hora;
               btn.dataset.hora = hora;

               btn.addEventListener('click', () => {
                  // Quitar selección anterior
                  document.querySelectorAll('.btn-hora').forEach(b => {
                     b.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600');
                  });
                  // Añadir selección
                  btn.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');
                  document.getElementById('hora-seleccionada').value = hora;
               });

               grid.appendChild(btn);
            });

            container.classList.remove('hidden');

         } catch (error) {
            console.error('Error:', error);
            loader.classList.add('hidden');
            cerrado.classList.remove('hidden');
         }
      }

      // Función para llamar cuando se selecciona una fecha del calendario
      function onFechaSeleccionada(fecha) {
         document.getElementById('fecha-seleccionada').value = fecha;
         cargarHorasDisponibles(fecha);
      }

      const reservaFormCrear = document.getElementById('crearReservaForm');

      reservaFormCrear.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(reservaFormCrear, {
            // reload: true,
            resetForm: false,
            highlightInputs: true,
            showAlert: true,
            reciclar: true
         });
      });
   </script>
@endsection

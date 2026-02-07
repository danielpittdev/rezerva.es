@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] pt-10 pb-30">
      <div class="relative border border-base-content/10 shadow bg-base-100 mx-auto xl:max-w-md max-w-md rounded-3xl overflow-hidden">

         <!-- Cuerpo -->
         <div class="cuerpo lg:pt-5 pt-5 px-5 pb-5">
            <form id="crearEventoForm" action="{{ route('api.evento.store') }}">
               @csrf
               <input type="text" hidden name="evento" value="{{ $evento->uuid }}">

               <div class="grid xl:grid-cols-[1fr] xl:grid-cols-2 grid-cols-1 lg:gap-x-6 gap-x-4 gap-y-4">
                  <!-- Aviso disclaimer -->
                  <div class="caja">

                     <div class="rounded-md bg-yellow-50 p-4">
                        <div class="flex">
                           <div class="shrink-0">
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-yellow-400">
                                 <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                           </div>
                           <div class="ml-3">
                              <h3 class="text-sm font-medium text-yellow-800">Antes de continuar</h3>
                              <div class="mt-2 text-sm text-yellow-700">
                                 <p>
                                    Revisa muy bien los datos del evento antes de adquirir una entrada o pase. Las entradas no son reembolsables, debes hablar con el comerciante en caso de que haya algún problema.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>

                  <!-- Caja de horas disponibles -->
                  <div class="caja space-y-4">

                     <div class="caja">
                        <fieldset>
                           <legend class="text-sm/6 font-semibold text-gray-900">Selecciona un método de pago</legend>
                           <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                              <label aria-label="Pago efectivo" aria-description="Paga en efectivo al llegar"
                                 class="group relative flex rounded-lg border border-gray-300 bg-white p-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-indigo-600 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                 <input type="radio" name="metodo_pago" value="efectivo" class="absolute inset-0 appearance-none focus:outline-none" />
                                 <div class="flex-1">
                                    <span class="block text-sm font-medium text-gray-900">Pago efectivo</span>
                                    <span class="mt-1 block text-sm text-gray-500">Paga en efectivo al llegar</span>
                                 </div>
                                 <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="invisible size-5 text-indigo-600 group-has-checked:visible">
                                    <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </label>

                              <label aria-label="Pago tarjeta" aria-description="Paga con tarjeta ahora"
                                 class="group relative flex rounded-lg border border-gray-300 bg-white p-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-indigo-600 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                 <input type="radio" name="metodo_pago" value="tarjeta" class="absolute inset-0 appearance-none focus:outline-none" />
                                 <div class="flex-1">
                                    <span class="block text-sm font-medium text-gray-900">Pago tarjeta</span>
                                    <span class="mt-1 block text-sm text-gray-500">Paga con tarjeta ahora</span>
                                 </div>
                                 <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="invisible size-5 text-indigo-600 group-has-checked:visible">
                                    <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </label>

                              @if ($evento->pago_online)
                              @endif
                           </div>
                        </fieldset>
                     </div>

                     <div class="caja space-y-1">
                        <div class="flex items-center justify-between">
                           <h1 class="font-medium text-lg">
                              {{ $evento->nombre }}
                           </h1>

                           {{ number_format($evento->precio, 2, ',', '.') }}€
                        </div>

                        <p class="text-sm text-base-content/70">
                           {{ $evento->descripcion }}
                        </p>
                     </div>

                     <div class="caja">
                        <small>Comprar como:</small>

                        <div class="caja font-medium">
                           {{ ucfirst($cliente['nombre']) }} {{ ucfirst($cliente['apellido']) }}
                        </div>
                     </div>

                     <div class="caja mt-5">
                        <label for="cantidad" class="block text-sm/6 font-medium">Cantidad de entradas</label>
                        <div class="mt-2">
                           <input id="cantidad" type="number" min="1" name="cantidad" autocomplete="cantidad"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                     </div>
                  </div>

                  <div class="mt-4 block">
                     <button type="submit" class="w-full rounded-md bg-indigo-600 p-3 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
                        Reservar
                     </button>
                  </div>
               </div>
            </form>
         </div>

         <!-- Discalimer -->
         <div class="caja py-10 px-5 border-t border-base-content/10 shadow space-y-7">
            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Rezerva.es es una <strong>plataforma online</strong> para negocios en donde pueden crear su <strong>propio portal de reservas online</strong> y compartirla con todo el mundo de manera rápida y directa. Sube tu audiencia en las <strong>búsquedas de Google</strong>.
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
      const reservaFormCrear = document.getElementById('crearEventoForm');

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

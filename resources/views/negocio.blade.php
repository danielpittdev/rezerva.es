@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] pt-20 pb-30">

      <div class="relative border border-base-content/10 shadow bg-base-100 mx-auto max-w-lg rounded-3xl overflow-hidden">
         <!-- Imagen -->
         <div class="p-0 shadow overflow-hidden">
            <img class="w-full h-70 object-cover" src="/media/img/banner.png" alt="">
         </div>

         <!-- Título -->
         <div class="p-5 absolute left-17 top-50 rounded-md w-sm space-y-3">
            <div class="caja">
               <img class="rounded-full size-30 mx-auto border-7 border-base-100" src="/media/logo/brand.png" alt="">
            </div>
            <h1 class="text-2xl font-medium text-center">
               {{ $negocio->nombre }}
            </h1>
         </div>

         <!-- Cuerpo -->
         <div class="cuerpo min-h-[600px] pt-40">

            <!-- Servicios -->
            <section class="caja">
               <div class="p-3 px-5">
                  <h2 class="font-medium text-lg">
                     Servicios
                  </h2>
               </div>

               <div class="caja">
                  <ul role="list" class="divide-y divide-gray-100">
                     @if ($negocio->servicios->count() > 0)
                        @foreach ($negocio->servicios as $servicio)
                           <li class="flex items-center justify-between gap-x-6 py-5 px-5">
                              <div class="min-w-0">
                                 <div class="flex items-start gap-x-3">
                                    <p class="text-sm/6 font-semibold text-base-content/90">{{ $servicio->nombre }}</p>
                                    @if ($servicio->pago_online)
                                       <p class="mt-0.5 rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">
                                          Pago online
                                       </p>
                                    @endif
                                 </div>
                                 <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-base-content/50">
                                    <p class="whitespace-nowrap">{{ number_format($servicio->precio, 2, ',', '.') }}€</p>
                                    <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                                       <circle r="1" cx="1" cy="1" />
                                    </svg>
                                    <p class="truncate">{{ $servicio->duracion ?? 'Sin duración' }}</p>
                                 </div>
                              </div>
                              <div class="flex flex-none items-center gap-x-4">
                                 <button target="{{ $servicio->uuid }}" class="pet_reservar hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-base-content/90 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">
                                    Reservar
                                 </button>
                              </div>
                           </li>
                        @endforeach
                     @else
                        <li class="flex items-center justify-between gap-x-6 py-5 px-5">
                           <p class="text-base-content/70">
                              Aún no hay servicios registrados. Prueba a visitarnos más tarde.
                           </p>
                        </li>
                     @endif
                  </ul>
               </div>

            </section>

         </div>

         <!-- Información del negocio -->
         <div class="caja py-10 px-5 border-t border-base-content/10 shadow space-y-7">
            <p class="text-base-content text-base-content/70 text-sm text-justify">
               {{ $negocio->nombre }} se encuentra en <strong>{{ $negocio->postal_direccion }}</strong>. Para poder contactar con el establecimiento puede hacerlo con la información que se encuentra acontinuación:
            </p>

            <ul>
               <li class="text-sm text-base-content/90"><strong>Email</strong>: {{ $negocio->info_email ?? 'No hay información' }}</li>
               <li class="text-sm text-base-content/90"><strong>Teléfono</strong>: {{ $negocio->info_telefono ?? 'No hay información' }}</li>
            </ul>
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

@section('drawers')
   <el-dialog hidden id="d0_cliente">
      <dialog id="modal_cliente" aria-labelledby="dialog-title" class="z-100 fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent" style="right: var(--el-top-layer-scrollbar-offset, 0px);" open="">
         <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in" inert=""></el-dialog-backdrop>

         <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
            <el-dialog-panel
               class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-sm p-7 data-closed:sm:translate-y-0 data-closed:sm:scale-95">
               <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                  <button type="button" command="close" commandfor="modal_cliente" class="rounded-md bg-white text-gray-400 hover:text-base-content/50 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600" aria-expanded="true">
                     <span class="sr-only">Close</span>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                  </button>
               </div>
               <div class="sm:flex sm:items-start">
                  <div class="mt-3 text-center sm:mt-0 sm:text-left">

                     <div class="flex items-center gap-3">
                        <img class="size-8 rounded-md" src="@if ($negocio->icono) {{ Storage::ulr($negocio->icono) }}
                        @else
                           /media/logo/brand.png @endif
                        " alt="">
                        <h3 id="dialog-title" class="text-base font-semibold text-base-content/90">{{ $negocio->nombre }}</h3>
                     </div>

                     <div class="mt-5 text-start">
                        <p class="text-sm text-base-content/70">
                           Para continuar con la reserva es necesario que rellene los siguientes campos.
                        </p>
                     </div>

                     <div class="mt-5 space-y-5">

                        <form id="clienteForm" action="{{ route('api.cliente') }}" class="text-start" method="post">
                           @csrf

                           <input type="text" hidden="" name="negocio" value="{{ $negocio->uuid }}">
                           <input type="text" hidden="" name="servicio" value="">

                           <div class="space-y-2 grid gap-3 lg:grid-cols-2 grid-cols-1 mt-2">
                              <div class="lg:col-span-1 col-span-1">
                                 <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                                 <div class="mt-2">
                                    <input id="nombre" type="text" name="nombre" autocomplete="nombre"
                                       class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 </div>
                              </div>

                              <div class="lg:col-span-1 col-span-1">
                                 <label for="apellido" class="block text-sm/6 font-medium">Apellido</label>
                                 <div class="mt-2">
                                    <input id="apellido" type="text" name="apellido" autocomplete="apellido"
                                       class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 </div>
                              </div>

                              <div class="lg:col-span-2 col-span-1">
                                 <label for="email" class="block text-sm/6 font-medium">Correo electrónico</label>
                                 <div class="mt-2">
                                    <input id="email" type="text" name="email" autocomplete="email"
                                       class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                 </div>
                              </div>

                              <!-- Campo -->
                              <div class="flex items-center justify-between col-span-full">
                                 <div class="flex gap-3">
                                    <div class="flex h-6 shrink-0 items-center">
                                       <div class="group grid size-4 grid-cols-1">
                                          <input id="terminos-condiciones" type="checkbox" name="terminos-condiciones"
                                             class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                          <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                                             <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100"></path>
                                             <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100"></path>
                                          </svg>
                                       </div>
                                    </div>
                                    <label for="terminos-condiciones" class="block text-sm/6 text-base-content/90">Acepto los <a class="text-blue-500 hover:underline" href="https://rezerva.es/contrato">términos y condiciones</a></label>
                                 </div>
                              </div>

                              <div class="lg:col-span-2 col-span-1 mt-5">
                                 <button type="submit"
                                    class="duration-300 flex w-full justify-center rounded-md bg-indigo-600 p-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Continuar</button>
                              </div>
                           </div>
                        </form>

                     </div>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
@endsection

@section('scripts')
   <script>
      // Verificar sesión al hacer clic en reservar
      document.querySelectorAll('.pet_reservar').forEach(btn => {
         btn.addEventListener('click', async () => {
            const servicioId = btn.getAttribute('target');

            // Setear el servicio en el formulario
            $('input[name=servicio]').val(servicioId);

            try {
               const response = await fetch('{{ route('verificar.sesion.cliente') }}', {
                  method: 'POST',
                  headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  }
               });

               if (response.status === 401) {
                  document.getElementById('d0_cliente').removeAttribute('hidden');
                  document.getElementById('d0_cliente').show();
                  return;
               }

               const data = await response.json();
               if (data.redirect) {
                  // Continuar con el proceso de reserva
                  console.log('Sesión válida, continuar con reserva');
                  // window.location.href = response.redirect;
                  console.log(data.redirect)

                  window.location.href = data.redirect
               }

            } catch (error) {
               console.error('Error:', error);
            }
         });
      });

      const clienteFormForm = document.getElementById('clienteForm');

      clienteFormForm.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(clienteFormForm, {
            // reload: true,
            resetForm: false,
            highlightInputs: true,
            showAlert: true
         });
      });
   </script>
@endsection

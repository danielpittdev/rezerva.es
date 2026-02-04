@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] pt-30 pb-30">

      <div class="relative border border-base-content/10 shadow bg-base-100 mx-auto max-w-xl rounded-3xl overflow-hidden">
         <!-- Imagen -->
         <div class="p-0 shadow overflow-hidden">
            <img class="w-full h-70 object-cover" src="@if ($reserva->negocio->banner) {{ Storage::url($reserva->negocio->banner) }} @else /media/img/banner.png @endif" alt="">
         </div>

         <!-- Título -->
         <div class="p-5 absolute left-25 top-50 rounded-md w-sm space-y-3">
            <div class="caja">
               <img class="object-cover rounded-full size-27 aspect-1/1 mx-auto border-3 border-base-200" src="@if ($reserva->negocio->icono) {{ Storage::url($reserva->negocio->icono) }} @else /media/img/banner.png @endif" alt="">
            </div>
            <h1 class="text-2xl font-medium text-center">
               {{ $reserva->negocio->nombre }}
            </h1>
         </div>

         <!-- Cuerpo -->
         <div class="cuerpo min-h-[600px] pt-30">

            <!-- Servicios -->
            <section class="caja space-y-5">
               <div class="p-3 px-5 pt-7">
                  <h2 class="font-medium text-lg">
                     Datos de tu reserva
                  </h2>
               </div>

               <div class="caja px-5 border-t border-base-content/10 pt-7">
                  <ul class="space-y-3 grid lg:grid-cols-2 grid-cols-1 gap-2 text-start">
                     <li>
                        Servicio: <strong>{{ $reserva->servicio->nombre }}</strong>
                     </li>

                     <li>
                        Precio: <strong>{{ number_format($reserva->servicio->precio, 2, ',', '.') }}€</strong>
                     </li>

                     <li>
                        Lugar: <strong>{{ $reserva->negocio->postal_direccion . ', ' . $reserva->negocio->postal_ciudad }}</strong>
                     </li>

                     <li>
                        Estado: <strong>{{ $reserva->estado }}</strong>
                     </li>
                  </ul>
               </div>

               <div class="caja px-5 border-t border-base-content/10 pt-7">
                  <small class="text-base-content/60">Si quieres cambiar tu reserva puedes hacerlo solicitando de nuevo el servicio desde el negocio. Puedes cancelar tu reserva cuando quieras*. Para cancelar pon tu correo electrónico para confirmar que eres tú.</small>
               </div>

               @if ($reserva->estado != 'cancelado')
                  <div class="caja px-5 pb-10">
                     <form id="cancelarReserva" action="{{ route('reserva.destroy', ['reserva' => $reserva->uuid]) }}" class="space-y-5">
                        @csrf
                        @method('DELETE')

                        <div class="caja mt-2">
                           <div>
                              <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo electrónico</label>
                              <div class="mt-2">
                                 <input id="email" type="email" name="email" placeholder="tucorreo@electronico.com"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                              </div>
                           </div>
                        </div>

                        <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                           Cancelar ahora
                        </button>
                     </form>
                  </div>
               @endif

            </section>

         </div>

         <!-- Información del negocio -->
         <div class="caja py-10 px-5 border-t border-base-content/10 shadow space-y-7">
            <p class="text-base-content text-base-content/70 text-sm text-justify">
               {{ $reserva->negocio->nombre }} se encuentra en <strong>{{ $reserva->negocio->postal_direccion }}</strong>. Para poder contactar con el establecimiento puede hacerlo con la información que se encuentra acontinuación:
            </p>

            <ul>
               <li class="text-sm text-base-content/90"><strong>Email</strong>: {{ $reserva->negocio->info_email ?? 'No hay información' }}</li>
               <li class="text-sm text-base-content/90"><strong>Teléfono</strong>: {{ $reserva->negocio->info_telefono ?? 'No hay información' }}</li>
            </ul>
         </div>

         <!-- Discalimer -->
         <div class="caja py-10 px-5 border-t border-base-content/10 shadow space-y-7">
            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Rezerva.es es una <strong>plataforma online</strong> para negocios en donde pueden crear su <strong>propio portal de reservas online</strong> y compartirla con todo el mundo de manera rápida y directa. Sube tu audiencia en las <strong>búsquedas de Google</strong>.
            </p>

            <p class="text-base-content text-base-content/70 text-sm text-justify">
               Al realizar una reserva en <strong>{{ $reserva->negocio->nombre }}</strong>, el usuario contrata directamente con el negocio o profesional responsable del servicio. Rezerva.es actúa exclusivamente como intermediario tecnológico, facilitando la gestión de reservas y pagos online.
            </p>

            <p class="text-base-content text-base-content/70 text-sm text-justify">
               El negocio <strong>{{ $reserva->negocio->nombre }}</strong>, con dirección en <strong>{{ $reserva->negocio->postal_direccion }}</strong>, es el único responsable de la prestación del servicio, de la información publicada y de la correcta ejecución de la cita reservada.
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
                        <img class="size-8 rounded-md" src="@if ($reserva->icono) {{ Storage::ulr($reserva->icono) }}
                        @else
                           /media/logo/brand.png @endif
                        " alt="">
                        <h3 id="dialog-title" class="text-base font-semibold text-base-content/90">{{ $reserva->nombre }}</h3>
                     </div>

                     <div class="mt-5 text-start">
                        <p class="text-sm text-base-content/70">
                           Para continuar con la reserva es necesario que rellene los siguientes campos.
                        </p>
                     </div>

                     <div class="mt-5 space-y-5">

                        <form id="clienteForm" action="{{ route('api.cliente') }}" class="text-start" method="post">
                           @csrf

                           <input type="text" hidden="" name="negocio" value="{{ $reserva->uuid }}">
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
      const cancelarReserva = document.getElementById('cancelarReserva');

      cancelarReserva.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(cancelarReserva, {
            reload: true,
            resetForm: false,
            highlightInputs: true,
            showAlert: true
         });
      });
   </script>
@endsection

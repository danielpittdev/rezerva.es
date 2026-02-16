@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-200/50 min-h-[100vh] lg:pt-16 lg:pb-30">

      <div class="relative lg:border border-base-content/10 shadow-lg bg-base-100 mx-auto max-w-xl lg:rounded-3xl overflow-hidden">

         <!-- Banner -->
         <div class="relative overflow-hidden">
            <img class="w-full h-52 sm:h-64 object-cover" src="@if ($evento->evento->negocio->banner) {{ Storage::url($evento->evento->negocio->banner) }} @else /media/logo/banner.png @endif" alt="">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
         </div>

         <!-- Negocio info -->
         <div class="relative px-5 -mt-10 flex items-end gap-4">
            <img class="bg-base-100 object-cover rounded-full size-20 sm:size-24 aspect-square border-4 border-base-100 shadow-md shrink-0"
               src="@if ($evento->evento->negocio->icono) {{ Storage::url($evento->evento->negocio->icono) }} @else /media/logo/brand.png @endif" alt="">
            <div class="pb-2 min-w-0">
               <h1 class="text-lg sm:text-xl font-semibold flex items-center gap-2 truncate">
                  <span class="truncate">{{ $evento->evento->nombre }}</span>
                  @if ($evento->evento->negocio->verificado)
                     @svg('gravityui-seal-check', 'size-5 shrink-0 text-blue-500')
                  @endif
               </h1>
            </div>
         </div>

         <!-- QR Code -->
         <div class="flex flex-col items-center mt-8 px-5">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-base-content/5">
               {!! QrCode::size(160)->generate($evento->uuid) !!}
            </div>
            <p class="text-xs text-base-content/50 mt-3">Presenta este código en el evento</p>
         </div>

         <!-- Resumen de reserva -->
         <div class="px-5 mt-8 lg:pb-8">
            <h2 class="font-semibold text-base mb-4">Resumen de la reserva</h2>

            <div class="bg-base-200/40 rounded-2xl border border-base-content/5 divide-y divide-base-content/5">
               <!-- Evento -->
               <div class="flex items-center gap-3 p-4">
                  <div class="min-w-0">
                     <p class="text-xs text-base-content/50">Evento</p>
                     <p class="text-sm font-medium truncate">{{ $evento->evento->nombre }}</p>
                  </div>
               </div>

               <!-- Lugar -->
               <div class="flex items-center gap-3 p-4">
                  <div class="min-w-0">
                     <p class="text-xs text-base-content/50">Lugar</p>
                     <p class="text-sm font-medium truncate">{{ $evento->evento->lugar }}</p>
                  </div>
               </div>

               <!-- Unidades y Precio -->
               <div class="grid grid-cols-2 divide-x divide-base-content/5">
                  <div class="flex items-center gap-3 p-4">
                     <div>
                        <p class="text-xs text-base-content/50">Entradas</p>
                        <p class="text-sm font-medium">{{ $evento->cantidad }}</p>
                     </div>
                  </div>
                  <div class="flex items-center gap-3 p-4">
                     <div>
                        <p class="text-xs text-base-content/50">Total</p>
                        <p class="text-sm font-semibold">{{ number_format($evento->evento->precio * $evento->cantidad, 2, ',', '.') }}€</p>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Aviso -->
            <div class="mt-5 bg-amber-50 border border-amber-200/60 rounded-xl p-4">
               <p class="text-xs text-amber-800/80 leading-relaxed">
                  Este tipo de reservas no son reembolsables ni cancelables. En caso de cancelación del evento podrás solicitar tu devolución en
                  <a class="font-medium text-amber-900 underline" href="mailto:devoluciones@rezerva.es">devoluciones@rezerva.es</a>
               </p>
            </div>
         </div>

         <!-- Footer -->
         <div class="px-5 py-8 border-t border-base-content/5 bg-base-200/30 space-y-4">
            <div class="flex items-center gap-3">
               <img src="/media/logo/logo.png" class="h-7 w-auto" alt="Rezerva.es">
               <div>
                  <p class="text-xs text-base-content/50">Evento gestionado con</p>
                  <p class="text-sm font-medium text-base-content/80">Rezerva.es</p>
               </div>
            </div>
            <p class="text-xs text-base-content/40 leading-relaxed">
               Plataforma online para gestionar servicios y eventos. <a class="hover:underline text-blue-600" href="https://rezerva.es/registro">Regístrate gratis</a>
            </p>
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
                        <img class="size-8 rounded-md" src="@if ($evento->icono) {{ Storage::ulr($evento->icono) }}
                        @else
                           /media/logo/brand.png @endif
                        " alt="">
                        <h3 id="dialog-title" class="text-base font-semibold text-base-content/90">{{ $evento->nombre }}</h3>
                     </div>

                     <div class="mt-5 text-start">
                        <p class="text-sm text-base-content/70">
                           Para continuar con la evento es necesario que rellene los siguientes campos.
                        </p>
                     </div>

                     <div class="mt-5 space-y-5">

                        <form id="clienteForm" action="{{ route('api.cliente') }}" class="text-start" method="post">
                           @csrf

                           <input type="text" hidden="" name="negocio" value="{{ $evento->uuid }}">
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

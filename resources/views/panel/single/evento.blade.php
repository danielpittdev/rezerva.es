@extends('components.html.plantilla.fullbody')

<div class="z-1000 loader flex items-center justify-center w-full fixed h-full bg-base-100/70 hidden">
   <span class="loading loading-spinner loading-xl"></span>
</div>

@section('contenido')
   <section class="h-full w-full rounded-md grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-[auto_1fr] grid-rows-[auto_1fr] gap-2">
      <!-- Barra superior -->
      <div class="rounded col-span-full lg:relative sticky top-0">
         <div class="flex justify-between gap-2">
            <button type="button" command="show-modal" commandfor="drawer_editar_reserva" class="lg:w-auto w-full rounded-md bg-white px-3 py-2 text-sm border border-base-content/15 font-semibold text-base-content/70 shadow-xs hover:bg-base-content/10">Editar evento</button>

            <button type="button" command="show-modal" commandfor="drawer_crear_invitacion" class="lg:w-auto w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400">Enviar invitación</button>
         </div>
      </div>

      <!-- Sección -->
      <div class="col-span-full lg:pb-0 overflow-y-auto space-y-3">

         <div class="grid lg:grid-cols-3 grid-cols-1 gap-3 items-start">
            <div class="caja border border-base-content/15 bg-base-100 rounded-box overflow-y-auto">
               <!-- HD -->
               <div class="caja divide-y divide-base-content/20">
                  <div class="z-10 bg-base-100 sticky top-0 p-3">
                     <h2 class="font-medium text-md">
                        Lista de clientes
                     </h2>
                  </div>

                  <!-- SEC -->
                  <ul role="list" id="evento_compras" class="divide-y divide-gray-100 max-h-[400px]">

                  </ul>
               </div>

            </div>

            <!-- KPIs -->
            <div class="caja border border-base-content/15 bg-base-100 p-3 rounded-box flex flex-col justify-start gap-4">
               <div>
                  <h2 class="font-medium text-sm text-base-content/60">Entradas vendidas</h2>
                  <p class="text-3xl font-bold mt-1">{{ $totalVendidas }}</p>
                  <p class="text-xs text-base-content/50 mt-1">de {{ $stockOriginal }} disponibles</p>
               </div>

               <div>
                  <div class="flex justify-between text-xs text-base-content/60 mb-1">
                     <span>Ocupación</span>
                     <span>{{ $porcentajeOcupacion }}%</span>
                  </div>
                  <div class="w-full bg-base-content/10 rounded-full h-2">
                     <div class="bg-indigo-600 h-2 rounded-full transition-all" style="width: {{ $porcentajeOcupacion }}%"></div>
                  </div>
               </div>

               <div>
                  <h2 class="font-medium text-sm text-base-content/60">Ingresos brutos</h2>
                  <p class="text-2xl font-bold mt-1">{{ number_format($ingresosTotales, 2, ',', '.') }} €</p>
               </div>
            </div>

            <!-- Métodos de pago -->
            <div class="caja border border-base-content/15 bg-base-100 p-3 rounded-box">
               <h2 class="font-medium text-sm text-base-content/60">Métodos de pago</h2>
               <div id="chart-metodos-pago" class="mt-2"></div>
            </div>
         </div>

         <!-- Gráfica principal: Ventas por día -->
         <div class="caja border border-base-content/15 bg-base-100 p-3 rounded-box lg:col-span-3">
            <h2 class="font-medium text-sm text-base-content/60">Entradas vendidas por día</h2>
            <div id="chart-ventas-dia" class="mt-2"></div>
         </div>

      </div>
   </section>
@endsection

@section('drawers')
   <el-dialog id="crear_reserva_evento">
      <dialog id="drawer_crear_invitacion" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Enviar invitación</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_invitacion" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                              <span class="absolute -inset-2.5"></span>
                              <span class="sr-only">Close panel</span>
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">

                     <form id="crear_invitacion" action="{{ route('eventoReserva.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <!-- Nombre -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="cliente_nombre" type="text" name="cliente_nombre"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Apellido -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_apellido" class="block text-sm/6 font-medium">Apellido</label>
                           <div class="mt-2">
                              <input id="cliente_apellido" type="text" name="cliente_apellido"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Correo electrónico -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_email" class="block text-sm/6 font-medium">Correo electrónico</label>
                           <div class="mt-2">
                              <input id="cliente_email" type="text" name="cliente_email"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_telefono" class="block text-sm/6 font-medium">Teléfono</label>
                           <div class="mt-2">
                              <input id="cliente_telefono" type="text" name="cliente_telefono"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Pagado -->
                        <div class="col-span-full">
                           <label for="pagado" class="block text-sm/6 font-medium">Marcar como pagado</label>

                           <div class="mt-2">
                              <input name="pagado" type="checkbox" class="toggle checked:text-green-500" />
                           </div>
                        </div>

                        <!-- Método de pago -->
                        <div class="col-span-full">
                           <label for="metodo_pago" class="block text-sm/6 font-medium">Método de pago</label>
                           @php
                              $tipos_pregunta = ['tarjeta', 'bizum', 'efectivo', 'presencial'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="metodo_pago" name="metodo_pago" value="{{ $tipos_pregunta[0] }}" class="block">
                                 <button type="button"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Texto</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @foreach ($tipos_pregunta as $tipo)
                                       <el-option value="{{ $tipo }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($tipo) }}</span>
                                          <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                             <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                             </svg>
                                          </span>
                                       </el-option>
                                    @endforeach

                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <!-- Cantidad -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="cantidad" class="block text-sm/6 font-medium">Cantidad</label>
                           <div class="mt-2">
                              <input id="cantidad" type="number" step="1" min="1" name="cantidad"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>


                        <input type="text" name="evento_id" hidden value="{{ $evento->uuid }}">


                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Registrar</button>
                        </div>
                     </form>

                     <script>
                        const crear_invitacion = document.getElementById('crear_invitacion');

                        crear_invitacion.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crear_invitacion, {
                              resetForm: true,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: true,
                              funcion: listaEvento
                           });

                        });
                     </script>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>

   <el-dialog id="editar_reserva_evento">
      <dialog id="drawer_editar_reserva" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Editar evento</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_editar_reserva" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                              <span class="absolute -inset-2.5"></span>
                              <span class="sr-only">Close panel</span>
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">

                     <form id="editarEvento" action="{{ route('evento.update', ['evento' => $evento->uuid]) }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf
                        @method('PUT')

                        <div class="alerta col-span-full p-3 rounded-md"></div>

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="nombre" value="{{ $evento->nombre }}" type="text" name="nombre" autocomplete="given-name"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Descripcion -->
                        <div class="lg:col-span-4 col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Descripcion</label>
                           <div class="mt-2">
                              <textarea class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" name="descripcion" id="" cols="30"
                                 rows="5"> {{ $evento->descripcion }}</textarea>
                           </div>
                        </div>

                        <!-- Límite de compras -->
                        <div class="lg:col-span-full col-span-full">
                           <div class="caja">
                              <label for="lugar" class="block text-sm/6 font-medium">Limitar transacción</label>
                              <small class="text-base-content/70">
                                 Limita cuantas entradas pueden comprar por cada transacción
                              </small>
                           </div>
                           <div class="mt-2">
                              <input value="{{ $evento->lugar }}" id="lugar" type="text" name="lugar"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Lugar -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="lugar" class="block text-sm/6 font-medium">Lugar</label>
                           <div class="mt-2">
                              <input value="{{ $evento->lugar }}" id="lugar" type="text" name="lugar"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Fecha -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>
                           <div class="mt-2">
                              <input value="{{ $evento->fecha }}" id="fecha" type="datetime-local" name="fecha"
                                 class="appearance-none block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Stock -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="stock" class="block text-sm/6 font-medium">Stock</label>
                           <div class="mt-2">
                              <input value="{{ $evento->stock }}" id="stock" type="number" min="0" step="1" name="stock"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Precio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="precio" class="block text-sm/6 font-medium">Precio</label>
                           <div class="mt-2">
                              <input value="{{ $evento->precio }}" id="precio" type="number" min="0" step="0.01" name="precio"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Pago en efectivo -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="pago_efectivo" class="block text-sm/6 font-medium">Pago en efectivo</label>
                           <div class="mt-2">
                              <input name="pago_efectivo" type="checkbox" class="toggle checked:text-green-500" {{ $evento->pago_efectivo ? 'checked' : '' }} />
                           </div>
                        </div>

                        <!-- Pago online -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="pago_online" class="block text-sm/6 font-medium">Pago con tarjeta</label>
                           <div class="mt-2">
                              <input name="pago_online" type="checkbox" class="toggle checked:text-green-500" {{ $evento->pago_online ? 'checked' : '' }} />
                           </div>
                        </div>

                        <!-- Negocio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="negocio_id" class="block text-sm/6 font-medium">Negocio</label>
                           @php
                              $negocios = Auth::user()->negocios;
                           @endphp

                           <div class="mt-2">
                              <el-select id="negocio_id" name="negocio_id" value="{{ $negocios[0]->uuid }}" class="block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Empleado</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @foreach ($negocios as $negocio)
                                       <el-option value="{{ $negocio->uuid }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($negocio->nombre) }}</span>
                                          <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                             <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                             </svg>
                                          </span>
                                       </el-option>
                                    @endforeach

                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                              Actualizar
                           </button>
                        </div>
                     </form>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>

   <el-dialog id="md_tog_1">
      <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
         <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

         <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-4">
            <el-dialog-panel
               class="relative transform overflow-hidden bg-base-100 px-4 pt-5 pb-4 text-left shadow-xl transition-all w-full data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:max-w-md rounded-lg sm:p-6 data-closed:sm:translate-y-0 data-closed:sm:scale-95">
               <div id="md_conten_md1" class="caja">

               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
@endsection

@section('scripts')
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script>
      const editarEventoForm = document.getElementById('editarEvento');

      editarEventoForm.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(editarEventoForm, {
            resetForm: false,
            highlightInputs: true,
            showAlert: false,
            reciclar: true,
            funcion: listaEvento
         });
      });

      function listaEvento() {
         $.ajax({
            type: "GET",
            url: "{{ route('evento.show', ['evento' => $evento->uuid]) }}",
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#evento_compras').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               $('#evento_compras').empty().append(r.listas.reservas)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      setInterval(() => {
         listaEvento()
      }, 30000);

      window.addEventListener('load', function() {
         listaEvento()
      });

      // Gráfica: Entradas vendidas por día
      const chartVentasOptions = {
         series: [{
            name: 'Entradas',
            data: @json($chartData)
         }],
         chart: {
            type: 'area',
            height: '90%',
            toolbar: {
               show: false
            },
            fontFamily: 'inherit'
         },
         dataLabels: {
            enabled: false
         },
         stroke: {
            curve: 'smooth',
            width: 2
         },
         xaxis: {
            categories: @json($chartLabels),
            axisBorder: {
               show: false
            },
            axisTicks: {
               show: false
            }
         },
         yaxis: {
            labels: {
               formatter: function(val) {
                  return Math.floor(val);
               }
            }
         },
         fill: {
            type: 'gradient',
            gradient: {
               shadeIntensity: 1,
               opacityFrom: 0.4,
               opacityTo: 0.1,
            },
            colors: ['#4f46e5']
         },
         colors: ['#4f46e5'],
         grid: {
            borderColor: '#e5e7eb',
            strokeDashArray: 4
         },
         tooltip: {
            y: {
               formatter: function(val) {
                  return val + ' entradas';
               }
            }
         }
      };
      new ApexCharts(document.querySelector("#chart-ventas-dia"), chartVentasOptions).render();

      // Gráfica: Métodos de pago
      const metodoLabels = @json($metodoLabels);
      const metodoData = @json($metodoData);

      if (metodoLabels.length > 0) {
         const chartMetodosOptions = {
            series: metodoData,
            chart: {
               type: 'donut',
               height: 200,
               fontFamily: 'inherit'
            },
            labels: metodoLabels,
            colors: ['#4f46e5', '#06b6d4', '#10b981', '#f59e0b'],
            legend: {
               position: 'bottom',
               fontSize: '12px'
            },
            dataLabels: {
               enabled: false
            },
            plotOptions: {
               pie: {
                  donut: {
                     size: '60%'
                  }
               }
            }
         };
         new ApexCharts(document.querySelector("#chart-metodos-pago"), chartMetodosOptions).render();
      }

      // Caption
      document.addEventListener('DOMContentLoaded', function() {
         $(document).on('click', '.caption_reserva', function() {
            let id = $(this).attr('target');

            // PET

            $.ajax({
               type: "GET",
               url: `/api/v1/eventoReserva/${id}`,
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               },
               beforeSend: function() {
                  $('.loader').removeClass('hidden')
               },
               success: function(r) {
                  console.log(r)
                  $('.loader').addClass('hidden')

                  $('#md_conten_md1').empty().append(r.modal)
                  $('#md_tog_1').attr('open', true)
               },
               error: function(e) {
                  console.log(e.responseJSON);
               }
            });
         });
      });
   </script>
@endsection

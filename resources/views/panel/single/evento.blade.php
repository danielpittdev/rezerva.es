@extends('components.html.plantilla.fullbody')

<div class="z-1000 loader flex items-center justify-center w-full fixed h-full bg-base-100/70 hidden">
   <span class="loading loading-spinner loading-xl"></span>
</div>

@section('contenido')
   @if (!Auth::user()->negocios[0]->stripe_account_id)
      <div class="rounded-md bg-yellow-50 border border-yellow-300 p-4 mb-3">
         <div class="flex">
            <div class="shrink-0">
               <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-yellow-400">
                  <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"
                     fill-rule="evenodd" />
               </svg>
            </div>
            <div class="ml-3">
               <h3 class="text-sm font-medium text-yellow-800">Pagos online desactivados</h3>
               <div class="mt-2 text-sm text-yellow-700">
                  <p>Asegurate que tu negocio está conectado a Stripe para crear eventos y procesar pagos online. Solamente podrás vender las entradas de manera libre o efectivo.</p>
               </div>
            </div>
         </div>
      </div>
   @endif
   <section class="h-full w-full grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-[auto_1fr_1fr] gap-2">

      <!-- Barra superior -->
      <div class="col-span-full flex flex-wrap items-center justify-between gap-2">
         <div class="flex items-center gap-2">
            <button type="button" command="show-modal" commandfor="drawer_editar_reserva" class="rounded-md bg-white px-2.5 py-1.5 text-sm border border-base-content/15 font-semibold text-base-content/70 shadow-xs hover:bg-base-content/10">Editar evento</button>
            <button type="button" command="show-modal" commandfor="drawer_add_topping" class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm border border-indigo-500/15 font-semibold text-white shadow-xs hover:bg-indigo-400">Añadir topping</button>
            <button type="button" command="show-modal" commandfor="drawer_crear_invitacion" class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm border border-indigo-500/15 font-semibold text-white shadow-xs hover:bg-indigo-400">Enviar invitación</button>
            <button type="button" command="show-modal" commandfor="dialog_compartir" class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm border border-indigo-500/15 font-semibold text-white shadow-xs hover:bg-indigo-400">Compartir</button>
         </div>
         <button type="button" command="show-modal" commandfor="drawer_emitir_aviso" class="rounded-md bg-yellow-500 px-2.5 py-1.5 text-sm border border-yellow-500/15 font-semibold text-white shadow-xs hover:bg-yellow-400">Emitir aviso</button>

      </div>

      <!-- Panel 1: Reservas (2 cols, fila 1) -->
      <div class="lg:col-span-1 lg:min-h-0 min-h-[300px] border border-base-content/10 rounded-box bg-base-100 overflow-y-auto divide-y divide-base-content/10">
         <div class="p-3">
            <h2 class="font-medium">
               Resumen de entradas
            </h2>
         </div>

         <ul id="evento_compras">

         </ul>
      </div>

      <!-- Panel 1: Reservas (2 cols, fila 1) -->
      <div class="lg:col-span-1 lg:min-h-0 min-h-[300px] border border-base-content/10 rounded-box bg-base-100 overflow-y-auto divide-y divide-base-content/10">
         <div class="p-3">
            <h2 class="font-medium">
               Toppings
            </h2>
         </div>

         <ul id="topping_lista">

         </ul>
      </div>

      <!-- Panel 2: Métodos de pago (1 col, fila 1) -->
      <div class="lg:col-span-1 lg:min-h-0 min-h-[250px] border border-base-content/10 rounded-box bg-base-100 overflow-y-auto p-4 flex flex-col">
         <div class="flex items-center justify-between mb-1">
            <div>
               <h3 class="text-sm font-semibold text-base-content">Métodos de pago</h3>
               <p class="text-xs text-base-content/50 mt-0.5">Distribución por tipo</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-600">
               <svg class="size-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
               </svg>
               Donut
            </span>
         </div>
         <div class="flex-1 flex items-center justify-center min-h-0">
            <div id="chart-metodos-pago" class="w-full"></div>
         </div>
      </div>

      <!-- Panel 3: Resumen rápido (1 col, fila 2) -->
      <div class="lg:col-span-1 lg:min-h-0 min-h-[250px] border border-base-content/10 rounded-box bg-base-100 overflow-y-auto p-4 flex flex-col gap-3">
         <div>
            <h3 class="text-sm font-semibold text-base-content">Resumen del evento</h3>
            <p class="text-xs text-base-content/50 mt-0.5">Datos generales</p>
         </div>
         <div class="flex-1 grid grid-cols-1 gap-2 content-start">
            <div class="rounded-lg bg-gradient-to-br from-indigo-500/10 to-indigo-500/5 border border-indigo-500/10 p-3">
               <p class="text-xs text-base-content/60 font-medium">Precio entrada</p>
               <p class="text-lg font-bold text-indigo-600 mt-0.5">{{ number_format($evento->precio, 2, ',', '.') }} &euro;</p>
            </div>
            <div class="rounded-lg bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/10 p-3">
               <p class="text-xs text-base-content/60 font-medium">Stock disponible</p>
               <p class="text-lg font-bold text-emerald-600 mt-0.5">{{ $evento->stock }}</p>
            </div>
            <div class="rounded-lg bg-gradient-to-br from-amber-500/10 to-amber-500/5 border border-amber-500/10 p-3">
               <p class="text-xs text-base-content/60 font-medium">Total recaudado</p>
               <p class="text-lg font-bold text-amber-600 mt-0.5">{{ number_format(array_sum($chartData ?? []) * $evento->precio, 2, ',', '.') }} &euro;</p>
            </div>
         </div>
      </div>

      <!-- Panel 4: Ventas por día (2 cols, fila 2) -->
      <div class="lg:col-span-2 lg:min-h-0 min-h-[250px] border border-base-content/10 rounded-box bg-base-100 overflow-y-auto p-4 flex flex-col">
         <div class="flex items-center justify-between mb-1">
            <div>
               <h3 class="text-sm font-semibold text-base-content">Entradas vendidas por día</h3>
               <p class="text-xs text-base-content/50 mt-0.5">Evolución de ventas</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-600">
               <svg class="size-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
               </svg>
               Tendencia
            </span>
         </div>
         <div class="flex-1 min-h-0">
            <div id="chart-ventas-dia" class="w-full h-full"></div>
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
                              <label for="max_compra" class="block text-sm/6 font-medium">Limitar transacción</label>
                              <small class="text-base-content/70">
                                 Limita cuantas entradas pueden comprar por cada transacción
                              </small>
                           </div>
                           <div class="mt-2">
                              <input value="{{ $evento->max_compra }}" id="max_compra" type="number" step="1" name="max_compra"
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

   <el-dialog id="emitir_aviso_evento">
      <dialog id="drawer_emitir_aviso" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Emitir aviso a usuarios</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_emitir_aviso" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                              <span class="absolute -inset-2.5"></span>
                              <span class="sr-only">Close panel</span>
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>

                  <div class="relative mt-6 flex-1 px-4 sm:px-6 space-y-4">

                     <div class="rounded-md bg-yellow-50 border border-yellow-300 p-4">
                        <div class="flex">
                           <div class="shrink-0">
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-yellow-400">
                                 <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                           </div>
                           <div class="ml-3">
                              <h3 class="text-sm font-medium text-yellow-800">Avisarás a todos los compradores</h3>
                              <div class="mt-2 text-sm text-yellow-700">
                                 <p>
                                    Estás a punto de enviar un correo masivo a todos tus compradores. Antes de enviar un correo masivo asegurate de todo lo que enviarás porque la acción no se puede deshacer.
                                 </p>
                                 <br>
                                 <p>
                                    Si el evento es masivo algunos correos pueden tardar en llegar mientras se completa el proceso. Cada correo masivo tiene un coste asociado de <strong>0,90€</strong> el envío.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <form id="emitirAviso" action="{{ route('evento.avisar', ['evento' => $evento->uuid]) }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <div class="alerta col-span-full"></div>

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="titulo" class="block text-sm/6 font-medium">Título</label>
                           <div class="mt-2">
                              <input id="titulo" type="text" name="titulo" autocomplete="given-name"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Cuerpo -->
                        <div class="lg:col-span-4 col-span-full">
                           <label for="cuerpo" class="block text-sm/6 font-medium">Cuerpo</label>
                           <div class="mt-2">
                              <textarea class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" name="cuerpo" id="cuerpo" cols="30"
                                 rows="5"> {{ $evento->cuerpo }}</textarea>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                              Enviar aviso
                           </button>
                        </div>
                     </form>

                     <script>
                        const formularioEmitirAviso = document.getElementById('emitirAviso');

                        formularioEmitirAviso.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(formularioEmitirAviso, {
                              resetForm: false,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: true,
                           });
                        });
                     </script>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>

   <el-dialog id="add_topping_modal">
      <dialog id="drawer_add_topping" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <div class="space-y-2">
                           <h2 id="drawer-title" class="text-base font-semibold text-base-content">Añadir un topping</h2>
                           <small class="text-base-content/70">
                              Crea articulos dentro de tu evento a modo de merchandising o extras
                           </small>
                        </div>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_add_topping" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                              <span class="absolute -inset-2.5"></span>
                              <span class="sr-only">Close panel</span>
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>

                  <div class="relative mt-6 flex-1 px-4 sm:px-6 space-y-4">

                     <form id="crearToppigForm" action="{{ route('eventoToppin.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <div class="alerta col-span-full"></div>

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="topping_nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="topping_nombre" type="text" name="nombre" placeholder="Ej: Camiseta, Pulsera VIP..."
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Descripcion -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="topping_descripcion" class="block text-sm/6 font-medium">Descripcion</label>
                           <div class="mt-2">
                              <textarea id="topping_descripcion" name="descripcion" cols="30" rows="3" placeholder="Descripcion opcional del topping"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
                           </div>
                        </div>

                        <!-- Icono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="topping_icono" class="block text-sm/6 font-medium">Foto</label>
                           <div class="mt-2">
                              <input id="topping_icono" type="file" name="icono" accept="image/*"
                                 class="file-input file-input-bordered w-full bg-base-200 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Precio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="topping_precio" class="block text-sm/6 font-medium">Precio</label>
                           <div class="mt-2">
                              <input id="topping_precio" type="number" name="precio" min="0" step="0.01" placeholder="0.00"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <input type="hidden" name="evento_id" value="{{ $evento->uuid }}">

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                              Crear topping
                           </button>
                        </div>
                     </form>

                     <script>
                        const crearToppingForm = document.getElementById('crearToppigForm');

                        crearToppingForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearToppingForm, {
                              resetForm: true,
                              highlightInputs: true,
                              showAlert: true,
                              reciclar: true,
                              reload: true
                           });
                        });
                     </script>

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
               <section id="md_conten_md1" class="caja">

               </section>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>

   <el-dialog id="md_enviar_aviso">
      <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
         <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

         <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-4">
            <el-dialog-panel
               class="relative transform overflow-hidden bg-base-100 px-4 pt-5 pb-4 text-left shadow-xl transition-all w-full data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:max-w-md rounded-lg sm:p-6 data-closed:sm:translate-y-0 data-closed:sm:scale-95">
               <section id="md_conten_md1" class="caja space-y-5">

                  <div class="caja">
                     <h6 class="font-medium">
                        Información del ticket
                     </h6>

                     <small class="text-base-content/60">
                        Edite la información de la entrada acontinuación
                     </small>
                  </div>

                  <div class="grid grid-cols-[auto_1fr] gap-8">
                     <!-- aaa -->
                     <div class="caja space-y-1">
                        <div class="lista">
                           <ul class="space-y-3">
                              <li>
                                 <div class="caja">
                                    <div class="info">
                                       <h6 class="font-medium text-sm">
                                          Datos cliente
                                       </h6>
                                    </div>
                                    <span class="text-sm text-base-content/70">Daniel Gonzalez</span>
                                 </div>
                              </li>
                              <li>
                                 <div class="caja">
                                    <div class="info">
                                       <h6 class="font-medium text-sm">
                                          Correo electrónico
                                       </h6>
                                    </div>
                                    <span class="text-sm text-base-content/70">correo@gmail.com</span>
                                 </div>
                              </li>
                              <li>
                                 <div class="caja">
                                    <div class="info">
                                       <h6 class="font-medium text-sm">
                                          Teléfono
                                       </h6>
                                    </div>
                                    <span class="text-sm text-base-content/70">123123123</span>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>

                     <!-- aaa -->
                     <div class="caja space-y-1">
                        <div class="lista">
                           <ul class="space-y-3">
                              <li>
                                 <div class="caja">
                                    <div class="info">
                                       <h6 class="font-medium text-sm">
                                          Precio de entrada
                                       </h6>
                                    </div>
                                    <span class="text-sm text-base-content/70">
                                       12,00
                                    </span>
                                 </div>
                              </li>
                              <li>
                                 <div class="caja">
                                    <div class="info">
                                       <h6 class="font-medium text-sm">
                                          Total gastado
                                       </h6>
                                    </div>
                                    <span class="text-sm text-base-content/70">123,90</span>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>

                  <!-- aaa -->
                  <div class="caja mt-7">
                     <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                        Enviar aviso
                     </button>
                  </div>

               </section>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>

   <el-dialog id="md_compartir">
      <dialog id="dialog_compartir" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
         <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

         <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-4">
            <el-dialog-panel
               class="relative transform overflow-hidden bg-base-100 px-4 pt-5 pb-4 text-left shadow-xl transition-all w-full data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:max-w-md rounded-lg sm:p-6 data-closed:sm:translate-y-0 data-closed:sm:scale-95">
               <section id="md_conten_md1" class="caja space-y-5">

                  <div class="caja">
                     <h3 class="font-medium text-lg">
                        Compartir enlace
                     </h3>

                     <small class="text-base-content/70">
                        Comparte el enlace del evento para que las personas puedan encontrar tu evento.
                     </small>
                  </div>

                  <div class="caja">
                     <a class="text-blue-500 hover:underline" href="https://rezerva.es/e/{{ $evento->uuid }}">https://rezerva.es/e/{{ $evento->uuid }}</a>
                  </div>

               </section>
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
               $('#cont_clientes').empty().append(r.datos.cont_clientes)
               $('#cont_localidades').empty().append(r.datos.cont_localidades)
               $('#evento_compras').empty().append(r.listas.reservas)
               $('#topping_lista').empty().append(r.listas.toppings)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

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
            height: '100%',
            toolbar: {
               show: false
            },
            fontFamily: 'inherit',
            sparkline: {
               enabled: false
            },
            zoom: {
               enabled: false
            },
            parentHeightOffset: 0,
         },
         dataLabels: {
            enabled: false
         },
         stroke: {
            curve: 'smooth',
            width: 2.5,
            lineCap: 'round'
         },
         xaxis: {
            categories: @json($chartLabels),
            axisBorder: {
               show: false
            },
            axisTicks: {
               show: false
            },
            labels: {
               style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontWeight: 500
               }
            },
            crosshairs: {
               stroke: {
                  color: '#4f46e5',
                  width: 1,
                  dashArray: 3
               }
            }
         },
         yaxis: {
            labels: {
               formatter: (val) => Math.floor(val),
               style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontWeight: 500
               },
               offsetX: -5
            },
            min: 0
         },
         fill: {
            type: 'gradient',
            gradient: {
               shadeIntensity: 1,
               type: 'vertical',
               opacityFrom: 0.35,
               opacityTo: 0.02,
               stops: [0, 100]
            },
            colors: ['#6366f1']
         },
         colors: ['#6366f1'],
         grid: {
            borderColor: '#f3f4f6',
            strokeDashArray: 5,
            xaxis: {
               lines: {
                  show: false
               }
            },
            yaxis: {
               lines: {
                  show: true
               }
            },
            padding: {
               top: -10,
               bottom: 0,
               left: 10,
               right: 10
            }
         },
         tooltip: {
            theme: 'light',
            style: {
               fontSize: '12px'
            },
            y: {
               formatter: (val) => val + ' entradas'
            },
            marker: {
               show: true
            },
            x: {
               show: true
            }
         },
         markers: {
            size: 0,
            hover: {
               size: 5,
               sizeOffset: 3
            },
            colors: ['#6366f1'],
            strokeColors: '#fff',
            strokeWidth: 2
         }
      };
      new ApexCharts(document.querySelector("#chart-ventas-dia"), chartVentasOptions).render();

      // Gráfica: Métodos de pago
      const metodoLabels = @json($metodoLabels);
      const metodoData = @json($metodoData);

      if (metodoLabels.length > 0) {
         const totalPagos = metodoData.reduce((a, b) => a + b, 0);
         const chartMetodosOptions = {
            series: metodoData,
            chart: {
               type: 'donut',
               height: '100%',
               fontFamily: 'inherit',
            },
            labels: metodoLabels,
            colors: ['#6366f1', '#06b6d4', '#10b981', '#f59e0b'],
            legend: {
               position: 'bottom',
               fontSize: '12px',
               fontWeight: 500,
               labels: {
                  colors: '#6b7280'
               },
               markers: {
                  size: 6,
                  shape: 'circle',
                  offsetX: -3
               },
               itemMargin: {
                  horizontal: 8,
                  vertical: 4
               }
            },
            dataLabels: {
               enabled: false
            },
            plotOptions: {
               pie: {
                  donut: {
                     size: '70%',
                     labels: {
                        show: true,
                        name: {
                           show: true,
                           fontSize: '13px',
                           fontWeight: 600,
                           color: '#374151',
                           offsetY: -5
                        },
                        value: {
                           show: true,
                           fontSize: '20px',
                           fontWeight: 700,
                           color: '#111827',
                           offsetY: 5,
                           formatter: (val) => val
                        },
                        total: {
                           show: true,
                           label: 'Total',
                           fontSize: '12px',
                           fontWeight: 500,
                           color: '#9ca3af',
                           formatter: () => totalPagos
                        }
                     }
                  },
                  expandOnClick: false
               }
            },
            stroke: {
               width: 3,
               colors: ['#fff']
            },
            tooltip: {
               enabled: true,
               style: {
                  fontSize: '12px'
               },
               y: {
                  formatter: (val) => val + ' pagos'
               }
            },
            states: {
               hover: {
                  filter: {
                     type: 'darken',
                     value: 0.9
                  }
               },
               active: {
                  filter: {
                     type: 'none'
                  }
               }
            }
         };
         new ApexCharts(document.querySelector("#chart-metodos-pago"), chartMetodosOptions).render();
      }

      function eliminarTopping(uuid) {
         if (!confirm('¿Estás seguro de que quieres eliminar este topping?')) return;

         $.ajax({
            type: "DELETE",
            url: `/api/v1/eventoToppin/${uuid}`,
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            success: function(r) {
               listaEvento();
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      // Caption
      let currentNegocioId = null;

      document.addEventListener('DOMContentLoaded', function() {
         $(document).on('click', '.caption_reserva', function() {
            let id = $(this).attr('target');

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

                  currentNegocioId = r.negocio_id;

                  $('#md_conten_md1').empty().append(r.modal)
                  $('#md_tog_1').attr('open', true)
               },
               error: function(e) {
                  console.log(e.responseJSON);
               }
            });
         });

         // Toggle formulario de email individual
         $(document).on('click', '.fn_alertar_usuario', function() {
            $('.fn_form_email').toggleClass('hidden');
         });

         // Cancelar formulario de email
         $(document).on('click', '.fn_cancelar_email', function() {
            $('.fn_form_email').addClass('hidden');
         });

         // Enviar email individual
         $(document).on('submit', '.formEmailIndividual', function(e) {
            e.preventDefault();
            peticion(this, {
               resetForm: true,
               highlightInputs: true,
               showAlert: true,
               reciclar: true,
            });
         });

         // Emitir reembolso - Abrir dashboard Stripe Connect
         $(document).on('click', '.fn_emitir_rembolso', function() {
            if (!currentNegocioId) return;

            $.ajax({
               type: "POST",
               url: `/stripe/connect/dashboard/${currentNegocioId}`,
               headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
               },
               beforeSend: function() {
                  $('.loader').removeClass('hidden')
               },
               success: function(r) {
                  $('.loader').addClass('hidden')
                  if (r.redirect) {
                     window.open(r.redirect, '_blank');
                  }
               },
               error: function(e) {
                  $('.loader').addClass('hidden')
                  console.log(e.responseJSON);
               }
            });
         });
      });
   </script>
@endsection

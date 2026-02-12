@extends('components.html.plantilla.center')

@section('contenido')
   <section class="grid grid-cols-1 gap-4 grid-rows-[auto_1fr]">

      <div class="flex justify-between items-start p-2">
         <div class="caja space-y-2 flex-1">
            <h1 class="text-xl font-medium">
               Eventos
            </h1>

            <p class="text-xs text-base-content/70">
               Gestiona tus eventos cómodamente
            </p>
         </div>

         <button command="show-modal" commandfor="drawer_crear_evento" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white hover:bg-indigo-500">
            Añadir evento
         </button>
      </div>

      <div class="bg-base-100 p-2 rounded-box border border-base-content/10">
         <ul id="load_lista_eventos" role="list" class="divide-y divide-base-content/10">
            <li class="flex py-8">
               <span class="mx-auto loading loading-spinner loading-md"></span>
            </li>
         </ul>
      </div>
   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_eventos_1">
      <dialog id="drawer_crear_evento" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Crear evento</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_evento" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="crearEmpleado" action="{{ route('evento.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <div class="alerta col-span-full p-3 rounded-md"></div>

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="nombre" type="text" name="nombre" autocomplete="given-name"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Descripcion -->
                        <div class="lg:col-span-4 col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Descripcion</label>
                           <div class="mt-2">
                              <textarea class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" name="descripcion" id="" cols="30"
                                 rows="5"></textarea>
                           </div>
                        </div>

                        <!-- Lugar -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="lugar" class="block text-sm/6 font-medium">Lugar</label>
                           <div class="mt-2">
                              <input id="lugar" type="text" name="lugar"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Fecha -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>
                           <div class="mt-2">
                              <input id="fecha" type="datetime-local" name="fecha"
                                 class="appearance-none block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Stock -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="stock" class="block text-sm/6 font-medium">Stock</label>
                           <div class="mt-2">
                              <input id="stock" type="number" min="0" step="1" name="stock"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Precio -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="precio" class="block text-sm/6 font-medium">Precio</label>
                           <div class="mt-2">
                              <input id="precio" type="number" min="0" step="0.01" name="precio"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
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
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear
                              evento</button>
                        </div>
                     </form>

                     <script>
                        const crearEmpleadoForm = document.getElementById('crearEmpleado');

                        crearEmpleadoForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearEmpleadoForm, {
                              resetForm: true,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: true,
                              funcion: llamadaLista
                           });

                        });
                     </script>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
@endsection

@section('scripts')
   <script>
      function llamadaLista() {
         $.ajax({
            type: "GET",
            url: "{{ route('evento.index') }}",
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#load_lista_eventos').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               console.log(r)
               document.getElementById('modal_eventos_1').hide()
               $('#load_lista_eventos').empty().append(r.listas.lista)
            }
         });
      }

      window.addEventListener('load', function() {
         // document.getElementById('modal_eventos_1').show()
         llamadaLista()
      });
   </script>
@endsection

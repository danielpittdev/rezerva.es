@extends('components.html.plantilla.center')

@section('contenido')
   <section class="bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex items-center gap-5">

         <div class="caja">
            <h1 class="text-md font-medium">
               Información del servicio
            </h1>
         </div>
      </div>

   </section>

   <section class="grid lg:grid-cols-[1fr_1fr] grid-cols-1 items-start gap-3">

      <!-- Izquierda -->
      <section class="col-span-1 lg:col-span-auto space-y-3">
         <!-- Servicios -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Edición de servicio
                  </span>
               </div>
            </div>

            <div class="material p-4">
               <div class="overflow-x-auto">
                  <form id="servicio_actualizar" action="{{ route('servicio.update', ['servicio' => $servicio->uuid]) }}" method="POST" class="space-y-3 grid lg:grid-cols-4 grid-cols-1 gap-3">
                     @csrf
                     @method('PUT')

                     <!-- Caja -->
                     <div class="lg:col-span-full col-span-1">
                        <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                        <div class="mt-2">
                           <input id="nombre" type="text" name="nombre" autocomplete="nombre" value="{{ $servicio->nombre }}"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <!-- Caja -->
                     <div class="lg:col-span-2 col-span-1">
                        <label for="duracion" class="block text-sm/6 font-medium">Duración (Min)</label>
                        <div class="mt-2">
                           <input id="duracion" type="number" min="0" step="1" name="duracion" autocomplete="duracion" value="{{ $servicio->duracion }}"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <!-- Caja -->
                     <div class="lg:col-span-2 col-span-1">
                        <label for="precio" class="block text-sm/6 font-medium">Precio</label>
                        <div class="mt-2">
                           <input id="precio" type="number" min="0" step="0.01" name="precio" autocomplete="precio" value="{{ $servicio->precio }}"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <!-- Color -->
                     <div class="lg:col-span-full col-span-1">
                        <label for="color" class="block text-sm/6 font-medium">Color</label>
                        <div class="mt-2">

                           @php
                              $colores = [
                                  'blue' => 'Azul',
                                  'green' => 'Verde',
                                  'yellow' => 'Amarillo',
                                  'red' => 'Rojo',
                                  'purple' => 'Púrpura',
                                  'pink' => 'Rosa',
                                  'indigo' => 'Índigo',
                                  'orange' => 'Naranja',
                                  'black' => 'Negro',
                              ];
                           @endphp

                           <el-select id="color" name="color" value="{{ $servicio->color }}" class="mt-2 block">
                              <button type="button"
                                 class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                 <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
                                 <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                    <path
                                       d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                       clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </button>

                              <el-options anchor="bottom start" popover
                                 class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                 @foreach ($colores as $color => $colEs)
                                    <el-option value="{{ $color }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($colEs) }}</span>
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


                     <!-- Caja -->
                     <div class="lg:col-span-full col-span-1">
                        <label for="pago_online" class="block text-sm/6 font-medium">Pago online</label>
                        <small class="text-base-content/70">
                           Tus clientes podrán optar por pagar antes por tu servicio.
                        </small>
                        <div class="mt-2">
                           <input type="checkbox" name="pago_online" @if ($servicio->pago_online == true) checked @endif class="toggle text-base-content/50 checked:text-green-500" />
                        </div>
                     </div>

                     <!-- Caja -->
                     <div class="lg:col-span-full col-span-1">
                        <label for="nota_rapida" class="block text-sm/6 font-medium">Habilitar notas rápidas</label>
                        <small class="text-base-content/70">
                           Habilita notas rápidas que tus clientes puedan comentarte algo antes de que reserven.
                        </small>
                        <div class="mt-2">
                           <input type="checkbox" name="nota_rapida" @if ($servicio->nota_rapida == true) checked @endif class="toggle text-base-content/50 checked:text-green-500" />
                        </div>
                     </div>

                     <div class="divider col-span-full"></div>

                     <div class="col-span-full">
                        <button type="submit" class="text-base-100 flex justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Actualizar</button>
                     </div>
                  </form>

                  <script>
                     const servicio_actualizarForm = document.getElementById('servicio_actualizar');

                     servicio_actualizarForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        peticion(servicio_actualizarForm, {
                           resetForm: false,
                           highlightInputs: true,
                           showAlert: false,
                           reciclar: true,
                        });
                     });
                  </script>
               </div>
            </div>
         </div>
      </section>

      <!-- Derecha -->
      <section class="col-span-1 lg:col-span-auto space-y-3">
         <!-- Configurar preguntas -->
         <div class="min-w-[330px] bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <div class="caja">
                     <h6 class="font-medium text-md">
                        Configurar preguntas
                     </h6>

                     <small class="text-ba">
                        Configurar preguntas
                     </small>
                  </div>

                  <button command="show-modal" commandfor="drawer_crear_pregunta_servicio" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white hover:bg-indigo-500">
                     Crear pregunta
                  </button>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">

                  <table class="table">
                     <tbody id="load_lista_preguntas">

                     </tbody>
                  </table>

               </div>
            </div>
         </div>
      </section>

   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_o">
      <dialog id="drawer_crear_pregunta_servicio" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Crear pregunta</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_pregunta_servicio" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="crearPreguntaForm" action="{{ route('servicioConf.store') }}" method="POST" class="grid grid-cols-1 gap-3">
                        @csrf

                        <input type="hidden" name="request" value="crear_pregunta">
                        <input type="hidden" name="servicio_id" value="{{ $servicio->uuid }}">

                        <!-- Pregunta -->
                        <div class="col-span-full">
                           <label for="pregunta" class="block text-sm/6 font-medium">Pregunta</label>
                           <div class="mt-2">
                              <input id="pregunta" type="text" name="pregunta" required
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                                 placeholder="¿Cuál es tu nombre completo?" />
                           </div>
                        </div>

                        <!-- Tipo de pregunta -->
                        <div class="col-span-full">
                           <label for="tipo" class="block text-sm/6 font-medium">Tipo de pregunta</label>
                           @php
                              $tipos_pregunta = ['text', 'textarea', 'check', 'number'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="select_tipo" name="tipo" value="{{ $tipos_pregunta[0] }}" class="block">
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

                        <!-- Obligatorio -->
                        <div class="col-span-full">
                           <label for="obligatorio" class="block text-sm/6 font-medium">¿Es obligatoria?</label>

                           <div class="mt-2">
                              <el-select id="select_obligatorio" name="obligatorio" value="1" class="block">
                                 <button type="button"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Sí</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    <el-option value="1" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <span class="block truncate font-normal group-aria-selected/option:font-semibold">Sí</span>
                                       <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                             <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                          </svg>
                                       </span>
                                    </el-option>

                                    <el-option value="0" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <span class="block truncate font-normal group-aria-selected/option:font-semibold">No</span>
                                       <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                             <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                          </svg>
                                       </span>
                                    </el-option>

                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear
                              pregunta</button>
                        </div>
                     </form>

                     <script>
                        const crearPreguntaForm = document.getElementById('crearPreguntaForm');

                        crearPreguntaForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearPreguntaForm, {
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
            url: "{{ route('servicioConf.show', ['servicioConf' => $servicio->uuid]) }}",
            data: {
               'html': true,
            },
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#load_lista_preguntas').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               document.getElementById('modal_o').hide()
               $('#load_lista_preguntas').empty().append(r.html.lista_preguntas)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      window.addEventListener('load', function() {
         // document.getElementById('modal_o').show()
         llamadaLista()
      });

      document.addEventListener('submit', async function(e) {
         const form = e.target;
         if (!form.classList.contains('elim_servicioConf')) return;
         e.preventDefault();

         if (!confirm('¿Eliminar esta pregunta?')) return;

         try {
            await axios.post(form.action, new FormData(form), {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               }
            });

            // 👉 Recargar listas
            if (typeof llamadaLista === "function") {
               llamadaLista();
            }

         } catch (err) {
            alert('Error eliminando horario');
            console.error(err.response?.data);
         }
      });
   </script>
@endsection

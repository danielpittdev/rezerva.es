@extends('components.html.plantilla.center')

@section('contenido')
   <section class="bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex items-center gap-5">
         <div class="icono">
            <div class="bg-indigo-500 rounded-full size-15 flex items-center justify-center text-white text-2xl font-bold">
               {{ strtoupper(substr($empleado->nombre, 0, 1) . substr($empleado->apellido, 0, 1)) }}
            </div>
         </div>

         <div class="caja">
            <h1 class="text-sm text-base-content/70 font-light">
               Información del empleado
            </h1>

            <p class="text-lg font-medium">
               {{ $empleado->nombre }} {{ $empleado->apellido }}
            </p>

            <div class="flex items-center gap-2 mt-1">
               <span class="text-xs text-base-content/70">{{ ucfirst($empleado->tipo) }}</span>
               @if ($empleado->estado === 'activo')
                  <span class="badge badge-success badge-xs">Activo</span>
               @else
                  <span class="badge badge-error badge-xs">Inactivo</span>
               @endif
            </div>
         </div>
      </div>

      <div class="flex gap-2">
         <button command="show-modal" commandfor="drawer_editar_empleado" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
            Editar empleado
         </button>
      </div>
   </section>

   <section class="grid lg:grid-cols-12 grid-cols-1 items-start gap-3">

      <!-- # SECCION ARRIBA # -->
      <section class="col-span-full grid lg:grid-cols-4 grid-cols-1 gap-3">

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas completadas
            </span>
            <span id="reservas_finalizadas" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas este mes
            </span>
            <span id="reservas_este_mes" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas pendientes
            </span>
            <span id="reservas_pendientes" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Ingresos generados
            </span>
            <span id="ingresos_estimados" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>
      </section>

      <!-- Información de contacto -->
      <section class="lg:col-span-4 col-span-full">
         <div class="bg-base-100 border border-base-content/10 rounded-md">
            <div class="p-4 border-b border-base-content/10">
               <span class="font-medium text-md">
                  Información de contacto
               </span>
            </div>

            <div class="p-4 space-y-3">
               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/50">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                  </svg>
                  <span class="text-sm">{{ $empleado->email ?? 'No especificado' }}</span>
               </div>

               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/50">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                  </svg>
                  <span class="text-sm">{{ $empleado->telefono ?? 'No especificado' }}</span>
               </div>

               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/50">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                  </svg>
                  <span class="text-sm">{{ $empleado->negocio->nombre ?? 'Sin negocio asignado' }}</span>
               </div>
            </div>
         </div>
      </section>

      <!-- Últimas reservas -->
      <section class="lg:col-span-8 col-span-full">
         <div class="bg-base-100 border border-base-content/10 rounded-md">
            <div class="p-4 border-b border-base-content/10">
               <span class="font-medium text-md">
                  Últimas reservas
               </span>
            </div>

            <div class="overflow-x-auto">
               <table id="load_lista_reservas" class="table">
                  <tbody>
                     <tr>
                        <td colspan="4" class="text-center py-8">
                           <span class="loading loading-spinner loading-md"></span>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </section>

   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_editar_empleado">
      <dialog id="drawer_editar_empleado" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Editar empleado</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_editar_empleado" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="editarEmpleado" action="{{ route('empleado.update', ['empleado' => $empleado->uuid]) }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="edit_nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="edit_nombre" type="text" name="nombre" autocomplete="given-name" value="{{ $empleado->nombre }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Apellido -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="edit_apellido" class="block text-sm/6 font-medium">Apellido</label>
                           <div class="mt-2">
                              <input id="edit_apellido" type="text" name="apellido" autocomplete="family-name" value="{{ $empleado->apellido }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Email -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="edit_email" class="block text-sm/6 font-medium">Correo electrónico</label>
                           <div class="mt-2">
                              <input id="edit_email" type="email" name="email" autocomplete="email" value="{{ $empleado->email }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="edit_telefono" class="block text-sm/6 font-medium">Teléfono</label>
                           <div class="mt-2">
                              <input id="edit_telefono" type="tel" name="telefono" autocomplete="tel" value="{{ $empleado->telefono }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <div class="divider col-span-full"></div>

                        <!-- Tipo de empleado -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="edit_tipo" class="block text-sm/6 font-medium">Tipo de empleado</label>
                           @php
                              $tipos = ['empleado', 'colaborador', 'administrador'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="edit_select_tipo" name="tipo" value="{{ $empleado->tipo }}" class="block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">{{ ucfirst($empleado->tipo) }}</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @foreach ($tipos as $tipo)
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

                        <!-- Estado -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="edit_estado" class="block text-sm/6 font-medium">Estado</label>
                           @php
                              $estados = ['activo', 'inactivo'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="edit_select_estado" name="estado" value="{{ $empleado->estado }}" class="block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">{{ ucfirst($empleado->estado) }}</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @foreach ($estados as $estado)
                                       <el-option value="{{ $estado }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($estado) }}</span>
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

                        <div class="col-span-full mt-6 flex gap-2">
                           <button type="submit" class="rounded-md bg-indigo-600 px-4 py-1.5 text-sm font-semibold text-white hover:bg-indigo-500">Actualizar empleado</button>
                           <button type="button" id="btn_eliminar_empleado" class="rounded-md bg-red-600 px-4 py-1.5 text-sm font-semibold text-white hover:bg-red-500">Eliminar</button>
                        </div>
                     </form>

                     <script>
                        const editarEmpleadoForm = document.getElementById('editarEmpleado');

                        editarEmpleadoForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(editarEmpleadoForm, {
                              resetForm: false,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: false,
                              reload: true,
                           });
                        });

                        document.getElementById('btn_eliminar_empleado').addEventListener('click', function() {
                           if (confirm('¿Estás seguro de que deseas eliminar este empleado? Esta acción no se puede deshacer.')) {
                              $.ajax({
                                 type: "DELETE",
                                 url: "{{ route('empleado.destroy', ['empleado' => $empleado->uuid]) }}",
                                 headers: {
                                    "Authorization": "Bearer " + localStorage.getItem('token'),
                                    "Accept": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                 },
                                 success: function(r) {
                                    window.location.href = "{{ route('empleados') }}";
                                 },
                                 error: function(e) {
                                    console.log(e.responseJSON);
                                    alert('Error al eliminar el empleado');
                                 }
                              });
                           }
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
      function cargarDatosEmpleado() {
         $.ajax({
            type: "GET",
            url: "{{ route('empleado.show', ['empleado' => $empleado->uuid]) }}",
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#load_lista_reservas').html(`
                  <tbody>
                     <tr>
                        <td colspan="4" class="text-center py-8">
                           <span class="loading loading-spinner loading-md"></span>
                        </td>
                     </tr>
                  </tbody>
               `);
            },
            success: function(r) {
               // Actualizar tabla de reservas
               $('#load_lista_reservas').html(r.lista_reservas);

               // Actualizar estadísticas
               if (r.estadisticas) {
                  $('#reservas_finalizadas').text(r.estadisticas.reservas_finalizadas);
                  $('#reservas_este_mes').text(r.estadisticas.reservas_este_mes);
                  $('#reservas_pendientes').text(r.estadisticas.reservas_pendientes);
                  $('#ingresos_estimados').html(r.estadisticas.ingresos_estimados + ' <span class="text-base font-normal">€</span>');
               }
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      window.addEventListener('load', function() {
         cargarDatosEmpleado();
      });
   </script>
@endsection

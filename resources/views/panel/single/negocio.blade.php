@extends('components.html.plantilla.center')

@section('contenido')
   <button command="show-modal" commandfor="drawer_editar_negocio" class="lg:hidden block z-10 rounded-md bg-white p-2 px-3 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
      Editar negocio
   </button>
   <section class="relative bg-base-100 @if ($negocio->banner) pb-80 @endif p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex-1 flex items-center gap-3 z-10">
         <div class="icono">
            @if ($negocio->icono)
               <img src="@if ($negocio->nombre) {{ Storage::url($negocio->icono) }}
               @else
                  /media/logo/brand.png @endif" class="rounded-full lg:size-15 size-10 object-cover border border-base-content/20" alt="{{ $negocio->nombre }}">
            @else
               <div class="bg-indigo-500 rounded-full lg:size-15 size-10 flex items-center justify-center text-white text-2xl font-bold">
                  {{ strtoupper(substr($negocio->nombre, 0, 1)) }}
               </div>
            @endif
         </div>

         <div class="caja">
            <h1 class="text-sm text-base-content/70 font-light">
               Información del negocio
            </h1>

            <p class="text-lg font-medium">
               {{ $negocio->nombre }}
            </p>
         </div>
      </div>

      <button command="show-modal" commandfor="drawer_editar_negocio" class="lg:block hidden z-10 rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
         Editar negocio
      </button>

      @if ($negocio->banner)
         <img class="z-1 w-full h-[75%] object-cover absolute bottom-0 start-0" src="{{ Storage::url($negocio->banner) }}" alt="">
      @endif

   </section>

   <section class="grid lg:grid-cols-12 grid-cols-1 items-start gap-3">

      <!-- # SECCION ARRIBA # -->
      <section class="col-span-full grid lg:grid-cols-3 grid-cols-1 gap-3">

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas atendidas
            </span>
            <span id="reservas_finalizadas" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas atendidas este mes
            </span>
            <span id="reservas_este_mes" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Caja -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Ingresos estimados
            </span>
            <span id="ingresos_estimados" class="font-semibold text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>
      </section>

      <!-- # STRIPE CONNECT # -->
      <section class="col-span-full">
         <div id="stripe_connect_section" class="bg-base-100 rounded-md p-4 border border-base-content/10">
            <div class="flex items-center justify-between">
               <div>
                  <h3 class="font-medium text-md">Pagos online</h3>
                  <p id="stripe_status_text" class="text-sm text-base-content/70">Cargando estado...</p>
               </div>
               <div id="stripe_connect_buttons">
                  <!-- Se carga dinámicamente -->
               </div>
            </div>
         </div>
      </section>

      <!-- Izquierda -->
      <section class="lg:col-span-6 col-span-full space-y-3">
         <!-- Servicios -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Lista de servicios
                  </span>

                  <button type="button" command="show-modal" commandfor="drawer_crear_servicio" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                     Añadir servicio
                  </button>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">
                  <table class="table">
                     <tbody id="load_lista_servicios">

                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         <!-- Horarios -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Horarios
                  </span>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">
                  <table id="load_horarios_recurrente" class="table">

                  </table>
               </div>
            </div>
         </div>
      </section>

      <!-- Derecha -->
      <section class="lg:col-span-6 col-span-full space-y-3">
         <!-- Clientes habituales -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Clientes habituales
                  </span>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">
                  <table class="table">
                     <tbody id="load_clientes_habituales">

                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         <!-- Estadísticas servicios -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Estadísticas de reservas
                  </span>
               </div>
            </div>

            <div class="material">
               <div class="p-4">
                  No disponible
               </div>
            </div>
         </div>
      </section>

   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_crear_servicio">
      <dialog id="drawer_crear_servicio" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Añadir servicio</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_servicio" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="crearServicio" action="{{ route('servicio.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <div class="alerta col-span-full p-3 rounded-md"></div>

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="nombre" type="nombre" name="nombre" autocomplete="nombre"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Duración -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="duracion" class="block text-sm/6 font-medium">Duración</label>
                           <div class="mt-2">
                              <input id="duracion" type="number" step="1" min="0" name="duracion" autocomplete="duracion"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Precio -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="precio" class="block text-sm/6 font-medium">Precio</label>
                           <div class="mt-2">
                              <input id="precio" type="number" min="0" step="0.01" name="precio" autocomplete="precio"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Descripción -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
                           <div class="mt-2">
                              <textarea id="descripcion" name="descripcion" rows="4"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base text-base-content outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                           </div>
                        </div>

                        <!-- Tipo de servicio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="tipo" class="block text-sm/6 font-medium">Tipo de servicio</label>
                           @php
                              $tipos = ['recurrente'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="select" name="tipo" value="{{ $tipos[0] }}" class="mt-2 block">
                                 <button type="button"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
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

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear
                              servicio</button>
                        </div>

                        <input hidden type="text" name="negocio_id" value="{{ $negocio->uuid }}">
                     </form>

                     <script>
                        const crearServicioForm = document.getElementById('crearServicio');

                        crearServicioForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearServicioForm, {
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

   <el-dialog id="modal_editar_negocio">
      <dialog id="drawer_editar_negocio" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Editar negocio</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_editar_negocio" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="editarNegocio" action="{{ route('negocio.update', ['negocio' => $negocio->uuid]) }}" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="nombre" type="text" name="nombre" autocomplete="nombre" value="{{ $negocio->nombre }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Descripción -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
                           <div class="mt-2">
                              <textarea id="descripcion" name="descripcion" rows="4"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base text-base-content outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ $negocio->descripcion }}</textarea>
                           </div>
                        </div>

                        <!-- Tipo de negocio -->
                        <div class="lg:col-span-2 col-span-1">
                           <label for="tipo" class="block text-sm/6 font-medium">Tipo de negocio</label>
                           <div class="mt-2">

                              @php
                                 $tipos = ['otros', 'barbería', 'psicología', 'spa', 'clínica', 'gimnasio', 'consultoría'];
                              @endphp

                              <el-select id="tipo" name="tipo" value="{{ $negocio->tipo }}" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
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

                        <!-- Moneda -->
                        <div class="lg:col-span-2 col-span-1">
                           <label for="moneda" class="block text-sm/6 font-medium">Moneda</label>
                           <div class="mt-2">

                              @php
                                 $monedas = ['EUR', 'USD', 'COP', 'GBP'];
                              @endphp

                              <el-select id="moneda" name="moneda" value="{{ $negocio->moneda }}" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @foreach ($monedas as $moneda)
                                       <el-option value="{{ $moneda }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($moneda) }}</span>
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

                        <!-- Toggle online -->
                        <div class="col-span-full">
                           <div class="flex items-center gap-3">
                              <label class="inline-flex items-center cursor-pointer">
                                 <input id="editar_online" type="checkbox" name="online" value="1" @if ($negocio->online) checked @endif class="sr-only peer" />
                                 <div
                                    class="relative w-11 h-6 rounded-full bg-base-content/20 peer-checked:bg-indigo-500 peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-indigo-500 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                                 </div>
                                 <span class="ms-3 text-sm font-medium">Negocio online</span>
                              </label>
                              <span class="text-xs text-base-content/50">(sin local fisico)</span>
                           </div>
                        </div>

                        <!-- Dirección postal -->
                        <div id="editar_campos_direccion" class="col-span-full grid lg:grid-cols-4 grid-cols-1 gap-3" @if ($negocio->online) style="display:none" @endif>
                           <div class="lg:col-span-full col-span-full">
                              <label for="postal_direccion" class="block text-sm/6 font-medium">Dirección</label>
                              <div class="mt-2">
                                 <input id="postal_direccion" type="text" name="postal_direccion" value="{{ $negocio->postal_direccion }}"
                                    class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                              </div>
                           </div>

                           <div class="lg:col-span-2 col-span-full">
                              <label for="postal_codigo" class="block text-sm/6 font-medium">Código postal</label>
                              <div class="mt-2">
                                 <input id="postal_codigo" type="text" name="postal_codigo" value="{{ $negocio->postal_codigo }}"
                                    class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                              </div>
                           </div>

                           <div class="lg:col-span-2 col-span-full">
                              <label for="postal_ciudad" class="block text-sm/6 font-medium">Ciudad</label>
                              <div class="mt-2">
                                 <input id="postal_ciudad" type="text" name="postal_ciudad" value="{{ $negocio->postal_ciudad }}"
                                    class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                              </div>
                           </div>

                           <div class="lg:col-span-full col-span-full">
                              <label for="postal_pais" class="block text-sm/6 font-medium">País</label>
                              <div class="mt-2">
                                 <input id="postal_pais" type="text" name="postal_pais" value="{{ $negocio->postal_pais }}"
                                    class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                              </div>
                           </div>
                        </div>

                        <!-- Email -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="info_email" class="block text-sm/6 font-medium">Email de contacto</label>
                           <div class="mt-2">
                              <input id="info_email" type="email" name="info_email" value="{{ $negocio->info_email }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="info_telefono" class="block text-sm/6 font-medium">Teléfono de contacto</label>
                           <div class="mt-2">
                              <input id="info_telefono" type="tel" name="info_telefono" value="{{ $negocio->info_telefono }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Icono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="icono" class="block text-sm/6 font-medium">Icono del negocio</label>
                           @if ($negocio->icono)
                              <div class="mt-2 mb-2">
                                 <img src="{{ asset('storage/' . $negocio->icono) }}" alt="Icono actual" class="size-20 rounded-full object-cover border border-base-content/20">
                              </div>
                           @endif
                           <div class="mt-2">
                              <input id="icono" type="file" name="icono" accept="image/*"
                                 class="block w-full text-sm text-base-content file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                              <p class="mt-1 text-xs text-base-content/70">PNG, JPG, GIF (máx. 2MB)</p>
                           </div>
                        </div>

                        <!-- Banner -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="banner" class="block text-sm/6 font-medium">Banner del negocio</label>
                           @if ($negocio->banner)
                              <div class="mt-2 mb-2">
                                 <img src="{{ asset('storage/' . $negocio->banner) }}" alt="Banner actual" class="w-full h-32 rounded-md object-cover border border-base-content/20">
                              </div>
                           @endif
                           <div class="mt-2">
                              <input id="banner" type="file" name="banner" accept="image/*"
                                 class="block w-full text-sm text-base-content file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                              <p class="mt-1 text-xs text-base-content/70">PNG, JPG, GIF (máx. 5MB) - Recomendado: 1920x400px</p>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">Actualizar negocio</button>
                        </div>
                     </form>

                     <script>
                        const editarNegocioForm = document.getElementById('editarNegocio');
                        const editarOnlineToggle = document.getElementById('editar_online');
                        const editarCamposDireccion = document.getElementById('editar_campos_direccion');

                        editarOnlineToggle.addEventListener('change', () => {
                           editarCamposDireccion.style.display = editarOnlineToggle.checked ? 'none' : '';
                        });

                        editarNegocioForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(editarNegocioForm, {
                              resetForm: false,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: false,
                              reload: true,
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
            url: "{{ route('negocio.show', ['negocio' => $negocio->uuid]) }}",
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#load_lista_servicios').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               document.getElementById('modal_crear_servicio').hide()
               $('#load_lista_servicios').empty().append(r.lista_servicios)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      window.addEventListener('load', function() {
         // document.getElementById('modal_crear_servicio').show()
         llamadaLista()
      });
   </script>

   <script>
      function llamadaHorario() {

         let id = "{{ $negocio->uuid }}";

         let urlBase = "{{ route('negocio.show', ['negocio' => '__ID__']) }}";
         let url = urlBase.replace('__ID__', id);

         $.ajax({
            type: "GET",
            url: url,
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            beforeSend: function() {
               $('#load_horarios_recurrente').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)

               $('#load_clientes_habituales').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               $('#load_horarios_recurrente').empty().append(r.lista_horario_recurrente)
               $('#load_clientes_habituales').empty().append(r.lita_clientes)

               // Actualizar estadísticas
               if (r.estadisticas) {
                  $('#reservas_finalizadas').text(r.estadisticas.reservas_finalizadas)
                  $('#reservas_este_mes').text(r.estadisticas.reservas_este_mes)
                  $('#ingresos_estimados').html(r.estadisticas.ingresos_estimados + ' <span class="text-base font-normal">€</span>')
               }
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      document.addEventListener('submit', async function(e) {
         const form = e.target;
         if (!form.classList.contains('elim_horario')) return;
         e.preventDefault();

         if (!confirm('¿Eliminar este horario?')) return;

         try {
            await axios.post(form.action, new FormData(form), {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               }
            });

            // 👉 Recargar listas
            if (typeof llamadaHorario === "function") {
               llamadaHorario();
            }

         } catch (err) {
            alert('Error eliminando horario');
            console.error(err.response?.data);
         }
      });

      window.addEventListener('load', function() {
         // document.getElementById('modal_o').show()
         llamadaHorario()
      });
   </script>

   <script>
      // Stripe Connect
      const negocioId = {{ $negocio->id }};
      const stripeStatusUrl = "{{ route('stripe.connect.status', $negocio) }}";
      const stripeOnboardingUrl = "{{ route('stripe.connect.onboarding', $negocio) }}";
      const stripeDashboardUrl = "{{ route('stripe.connect.dashboard', $negocio) }}";
      const stripeDisconnectUrl = "{{ route('stripe.connect.disconnect', $negocio) }}";

      async function checkStripeStatus() {
         try {
            const response = await axios.get(stripeStatusUrl, {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               }
            });

            const data = response.data;
            const statusText = document.getElementById('stripe_status_text');
            const buttonsDiv = document.getElementById('stripe_connect_buttons');

            if (!data.connected) {
               statusText.textContent = 'Conecta tu cuenta de Stripe para recibir pagos online';
               buttonsDiv.innerHTML = `
                  <button onclick="connectStripe()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
                     Conectar Stripe
                  </button>
               `;
            } else if (!data.charges_enabled || !data.payouts_enabled) {
               statusText.innerHTML = '<span class="text-amber-600">Completa la configuración de tu cuenta</span>';
               buttonsDiv.innerHTML = `
                  <button onclick="connectStripe()" class="rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-amber-500">
                     Completar configuración
                  </button>
               `;
            } else {
               statusText.innerHTML = '<span class="text-green-600">Cuenta conectada y activa</span>';
               buttonsDiv.innerHTML = `
                  <div class="flex gap-2">
                     <button onclick="openStripeDashboard()" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                        Ver dashboard
                     </button>
                     <button onclick="disconnectStripe()" class="rounded-md bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 shadow-xs hover:bg-red-100">
                        Desconectar
                     </button>
                  </div>
               `;
            }
         } catch (error) {
            console.error('Error checking Stripe status:', error);
            document.getElementById('stripe_status_text').textContent = 'Error al verificar estado';
         }
      }

      async function connectStripe() {
         try {
            const response = await axios.post(stripeOnboardingUrl, {}, {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
               }
            });

            if (response.data.redirect) {
               window.location.href = response.data.redirect;
            }
         } catch (error) {
            console.error('Error connecting Stripe:', error);
            alert('Error al conectar con Stripe');
         }
      }

      async function openStripeDashboard() {
         try {
            const response = await axios.post(stripeDashboardUrl, {}, {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
               }
            });

            if (response.data.redirect) {
               window.open(response.data.redirect, '_blank');
            }
         } catch (error) {
            console.error('Error opening dashboard:', error);
            alert('Error al abrir el dashboard');
         }
      }

      async function disconnectStripe() {
         if (!confirm('¿Estás seguro de que quieres desconectar tu cuenta de Stripe? No podrás recibir pagos online.')) {
            return;
         }

         try {
            await axios.delete(stripeDisconnectUrl, {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
               }
            });

            checkStripeStatus();
         } catch (error) {
            console.error('Error disconnecting Stripe:', error);
            alert('Error al desconectar Stripe');
         }
      }

      window.addEventListener('load', function() {
         checkStripeStatus();
      });
   </script>
@endsection

@extends('components.html.plantilla.fullbody')

@section('contenido')
   <section class="grid h-full lg:grid-cols-[auto_1fr_1fr] grid-cols-1 lg:grid-rows-[auto_1fr] grid-rows-[auto_auto_1fr] gap-2 grid-rows-1">

      <div class="bg-base-200 flex flex-col lg:flex-row lg:items-center lg:justify-between col-span-full gap-2 p-0 rounded-lg">
         <!--SELECTS-->
         <div class="flex flex-col sm:flex-row gap-2">
            <!--SELECT NEGOCIO-->
            <el-select name="negocio_id" id="negocio_id" value="{{ Auth::user()->negocios->first()->uuid }}" class="sm:min-w-[150px] w-full sm:w-auto">
               <button type="button"
                  class="grid w-full cursor-default grid-cols-1 rounded-md bg-base-100 py-1.5 px-2 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/10 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                  <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Selecciona una</el-selectedcontent>
                  <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-base-content sm:size-4">
                     <path
                        d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                        clip-rule="evenodd" fill-rule="evenodd" />
                  </svg>
               </button>

               <el-options anchor="bottom start" popover
                  class="max-h-60 w-(--button-width) rounded-md bg-base-100 p-1 text-base-content shadow-lg outline-1 outline-base-content/10 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                  @foreach (Auth::user()->negocios as $negocio)
                     <!-- Opción -->
                     <el-option value="{{ $negocio->uuid }}" class="group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden rounded">
                        <span class="flex items-center gap-2 block truncate font-normal group-aria-selected/option:font-semibold">
                           <span>{{ $negocio->nombre }}</span>
                        </span>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                           <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                              <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                           </svg>
                        </span>
                     </el-option>
                  @endforeach
               </el-options>

            </el-select>

            <!--SELECT TIPO VISTA-->
            <el-select name="tipo_vista" id="tipo_vista" value="lista_grande" class="sm:min-w-[150px] w-full sm:w-auto">
               <button type="button"
                  class="grid w-full cursor-default grid-cols-1 rounded-md bg-base-100 py-1.5 px-2 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/10 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                  <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Lista</el-selectedcontent>
                  <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-base-content sm:size-4">
                     <path
                        d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                        clip-rule="evenodd" fill-rule="evenodd" />
                  </svg>
               </button>

               <el-options anchor="bottom start" popover
                  class="max-h-60 w-(--button-width) rounded-md bg-base-100 p-1 text-base-content shadow-lg outline-1 outline-base-content/10 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                  <el-option value="lista_grande" class="group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden rounded">
                     <span class="flex items-center gap-2 block truncate font-normal group-aria-selected/option:font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <span>Lista</span>
                     </span>
                     <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                           <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                     </span>
                  </el-option>

                  <el-option value="franjas" class="group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden rounded">
                     <span class="flex items-center gap-2 block truncate font-normal group-aria-selected/option:font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Franjas</span>
                     </span>
                     <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                           <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                     </span>
                  </el-option>

               </el-options>
            </el-select>
         </div>

         <!--BOTON-->
         <button command="show-modal" commandfor="drawer_crear_reserva" class="rounded-md bg-base-100 px-3 py-1.5 text-sm font-semibold text-base-content shadow-xs inset-ring inset-ring-base-content/10 hover:bg-base-200 w-full sm:w-auto whitespace-nowrap">
            Añadir reserva
         </button>
      </div>

      <div class="lg:bg-base-100 lg:p-2 rounded-lg relative box lg:border border-base-content/10 lg:overflow-y-auto lg:min-w-[15vw] w-auto">
         <!-- Calendario -->
         <div class="calendai lg:bg-base-100 lg:p-2 lg:border border-base-content/10 rounded-md">

            <!-- Desktop -->
            <div class="lg:block hidden caja max-w-xs mx-auto">

               <!-- Selectores -->
               <div class="flex items-center justify-center text-base-content">
                  <div class="flex w-full items-center justify-between bg-base-100 ring ring-base-content/10 rounded-md">
                     <button type="button" id="btn-prev-month" class="hover:bg-base-200 duration-300 border-r border-base-content/10 flex flex-none items-center justify-center p-1.5 text-base-content hover:text-base-content/70">
                        <span class="sr-only">Mes anterior</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                           <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                     </button>

                     <div class="flex-auto text-sm font-semibold text-center titulo-mes">-</div>

                     <button type="button" id="btn-next-month" class="hover:bg-base-200 duration-300 border-l border-base-content/10 flex flex-none items-center justify-center p-1.5 text-base-content hover:text-base-content/70">
                        <span class="sr-only">Mes siguiente</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                           <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                     </button>
                  </div>
               </div>

               <!-- Calendario DESK -->
               <div class="mt-3 grid grid-cols-7 text-xs/6 text-base-content/70 text-center border-b border-base-content/10 pb-2">
                  <div>Lu</div>
                  <div>Ma</div>
                  <div>Mi</div>
                  <div>Ju</div>
                  <div>Vi</div>
                  <div>Sa</div>
                  <div>Do</div>
               </div>

               <div class="grilla-calendario gap-[1px] grid grid-cols-7 overflow-hidden pt-2"></div>
            </div>

            <!-- Móvil -->
            <div class="space-y-4 lg:hidden block">
               <!-- Controles -->
               <div class="flex items-center justify-between">
                  <button id="btn-prev" class="p-2 rounded-full hover:bg-base-200">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                     </svg>
                  </button>

                  <h2 id="mes-actual-mobile" class="text-md font-semibold text-base-content text-center">*</h2>

                  <button id="btn-next" class="p-2 rounded-full hover:bg-base-200">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                     </svg>
                  </button>
               </div>

               <!-- Carrusel -->
               <div id="calendario-horizontal" class="grid grid-cols-7 gap-2"></div>
            </div>

         </div>
      </div>

      <div class="relative lg:col-start-2 lg:col-span-2 bg-base-100 rounded-lg relative box border border-base-content/10 overflow-y-auto">

         <!-- Alerta de servicios -->
         @if (Auth::user()->negocios->pluck('servicios')->flatten()->count() == 0)
            <div class="p-3">
               <div class="rounded-md border border-yellow-200 bg-yellow-50 p-4">
                  <div class="flex">
                     <div class="shrink-0">
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-yellow-400">
                           <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"
                              fill-rule="evenodd" />
                        </svg>
                     </div>
                     <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                           No hay servicios registrados
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                           <p>
                              Para crear reservas y que tus clientes puedan reservarte debes primero crear al menos un servicio. Puedes hacerlo <a class="text-blue-500 hover:underline" href="{{ route('servicios') }}">haciendo clic aquí</a>.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endif

         <!-- Tabla de reservas -->
         <ul id="load_ajax_reservas" role="list" disabled class="relative divide-y divide-base-content/10 h-full">

         </ul>
      </div>
   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_crear_reserva">
      <dialog id="drawer_crear_reserva" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/15 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Añadir reserva</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_reserva" class="relative rounded-md text-gray-400 hover:text-base-content/70 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
                     <div class="alerta col-span-full p-3 rounded-md"></div>

                     <form id="formuCrearReserva" action="{{ route('reserva.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf

                        <div class="col-span-full alerta"></div>

                        <!-- Tipo de negocio -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="negocio_id" class="block text-sm/6 font-medium">Negocio</label>
                           @php
                              $negocios = Auth::user()->negocios;
                           @endphp

                           <div class="mt-2">
                              <el-select id="negocio_id_select" name="negocio_id" value="{{ $negocios[0]->uuid }}" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">No tienes ningún negocio</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-base-content/70 sm:size-4">
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

                        <!-- Servicios -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="servicio_id" class="block text-sm/6 font-medium">Servicio</label>

                           <div class="mt-2">
                              <el-select id="servicio_id_select" name="servicio_id" value="" class="mt-2 block">
                                 <button disabled type="button" id="btn_select_servicio"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Selecciona un servicio</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-base-content/70 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover id="servicios_select"
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <!-- Fecha -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>
                           <div class="mt-2">
                              <input id="fecha" type="datetime-local" value="{{ Carbon\Carbon::now()->translatedFormat('Y-m-d H:i') }}" name="fecha" autocomplete="fecha"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Nombre -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="cliente_nombre" type="text" name="cliente_nombre" autocomplete="cliente_nombre"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Apellido -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="cliente_apellido" class="block text-sm/6 font-medium">Apellido</label>
                           <div class="mt-2">
                              <input id="cliente_apellido" type="text" name="cliente_apellido" autocomplete="cliente_apellido"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Email -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="cliente_email" class="block text-sm/6 font-medium">Email cliente</label>
                           <div class="mt-2">
                              <input id="cliente_email" type="email" name="cliente_email" autocomplete="cliente_email"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="cliente_telefono" class="block text-sm/6 font-medium">Teléfono cliente</label>
                           <div class="mt-2">
                              <input id="cliente_telefono" type="text" name="cliente_telefono" autocomplete="cliente_telefono"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Estado -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="estado" class="block text-sm/6 font-medium">Estado</label>
                           @php
                              $estados = ['pendiente', 'confirmado', 'cancelado', 'completado'];
                           @endphp

                           <div class="mt-2">
                              <el-select id="estado" name="estado" value="{{ $estados[0] }}" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-200 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-base-content/70 sm:size-4">
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

                        <div class="col-span-full mt-6">
                           <button type="submit" class="rounded-md bg-base-100 p-2 px-3 text-sm font-semibold text-base-content hover:text-base-content/70 shadow-xs inset-ring inset-ring-base-content/20 hover:bg-base-200">Crear reserva</button>
                        </div>
                     </form>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
@endsection

@section('scripts')
   <script>
      function llamarServicios() {

         let id = $('#negocio_id_select').val();

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
               $('#servicio_id_select').val('');
               $('#servicios_select').empty();
               $('#servicio_id_select el-selectedcontent').text('Selecciona un servicio');
               $('#btn_select_servicio').attr('disabled', true);
            },
            success: function(r) {
               // Limpiar y agregar los nuevos servicios
               $('#servicios_select').empty().append(r.lista_servicios_select);

               // Detectar si hay servicios disponibles
               let primeraOpcion = $('#servicios_select el-option').first();

               if (primeraOpcion.length > 0) {
                  // Hay servicios: seleccionar el primero automáticamente
                  let valorPrimero = primeraOpcion.attr('value');
                  let textoPrimero = primeraOpcion.find('span').first().text();

                  $('#servicio_id_select').val(valorPrimero);
                  $('#servicio_id_select el-selectedcontent').text(textoPrimero);
                  $('#btn_select_servicio').attr('disabled', false);
               } else {
                  // No hay servicios disponibles
                  $('#servicio_id_select').val('');
                  $('#servicio_id_select el-selectedcontent').text('No hay servicios disponibles');
                  $('#btn_select_servicio').attr('disabled', true);
               }
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      function llamarReservas() {
         // Obtener el negocio seleccionado
         let negocioUuid = $('#negocio_id').val();

         // Obtener el tipo de vista seleccionado
         let tipoVista = $('#tipo_vista').val() || 'lista_grande';

         // Buscar el elemento con clase "active" (día seleccionado)
         let diaActivo = document.querySelector('.dia.active');
         let fecha;

         if (diaActivo && diaActivo.dataset.date) {
            // Usar la fecha del elemento activo
            fecha = diaActivo.dataset.date;
         } else {
            // Si no hay día activo, usar la fecha actual
            let fechaActual = new Date();
            fecha = `${fechaActual.getFullYear()}-${String(fechaActual.getMonth() + 1).padStart(2, '0')}-${String(fechaActual.getDate()).padStart(2, '0')}`;
         }

         document.getElementById('modal_crear_reserva').hide()

         // URL del endpoint de reservas
         let url = "/api/v1/reserva/buscar";

         setTimeout(function() {
            $.ajax({
               type: "GET",
               url: url,
               data: {
                  "negocio": negocioUuid,
                  "fecha": fecha,
                  "lista": tipoVista
               },
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               },
               beforeSend: function() {
                  $('#load_ajax_reservas').empty().append(`<div class="absolute h-full w-full flex items-center justify-center"><span class="loading loading-spinner loading-md"></span></div>`);
               },
               success: function(response) {
                  $('#load_ajax_reservas').empty().append(response.html);

                  console.log(response)
               },
               error: function(error) {
                  console.error('Error al obtener reservas:', error);
                  $('#load_ajax_reservas').html('<li class="px-4 py-3 text-center text-red-500">Error al cargar las reservas</li>');
               }
            });
         }, 100)
      }

      document.addEventListener('DOMContentLoaded', function() {
         // Recuperar la vista guardada en localStorage
         const vistaGuardada = localStorage.getItem('reservas_tipo_vista');
         if (vistaGuardada) {
            $('#tipo_vista').val(vistaGuardada);
            // Actualizar el texto mostrado en el select
            const opcionSeleccionada = $(`#tipo_vista el-option[value="${vistaGuardada}"]`);
            if (opcionSeleccionada.length) {
               const textoOpcion = opcionSeleccionada.find('span span').last().text();
               $('#tipo_vista el-selectedcontent').text(textoOpcion);
            }
         }

         // Esperar un momento para asegurar que el calendario esté inicializado
         setTimeout(function() {
            // Cargar reservas iniciales
            llamarReservas();
         }, 100);

         // Llamar servicios cuando cambia el negocio en el drawer
         $('#negocio_id_select').on('change', function() {
            llamarServicios();
         });

         // Llamar reservas cuando cambia el negocio principal
         $('#negocio_id').on('change', function() {
            llamarReservas();
         });

         // Llamar reservas cuando cambia el tipo de vista
         $('#tipo_vista').on('change', function() {
            // Guardar la preferencia en localStorage
            localStorage.setItem('reservas_tipo_vista', $(this).val());
            llamarReservas();
         });


         const formuCrearReserva = document.getElementById('formuCrearReserva');

         formuCrearReserva.addEventListener('submit', (e) => {
            e.preventDefault();
            peticion(formuCrearReserva, {
               resetForm: true,
               highlightInputs: true,
               showAlert: false,
               reciclar: true,
               funcion: llamarReservas
            });

         });
      });
   </script>
@endsection

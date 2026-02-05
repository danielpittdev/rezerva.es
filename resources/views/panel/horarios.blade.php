@extends('components.html.plantilla.center')

@section('contenido')
   <section class="rounded-md flex justify-between items-center">
      <div class="caja">

         <!-- Negocio -->
         <div class="caja">
            @php
               $negocios = Auth::user()->negocios;
            @endphp

            <div class="caja">
               <el-select id="negocio_id" name="negocio_id" value="{{ $negocios[0]->uuid }}" class="block">
                  <button type="button"
                     class="bg-base-100 min-w-[150px] grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/10 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                     <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
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

      </div>
   </section>

   <section class="mt-3">
      <div class="grid lg:grid-cols-12 grid-cols-1 items-start gap-3">

         <!-- Izquierda -->
         <section class="lg:col-span-6 col-span-full space-y-3">
            <!-- Horarios -->
            <div class="border border-base-content/10 bg-base-100 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
               <div class="p-4 border-b border-base-content/10">
                  <div class="flex items-center justify-between min-h-8">
                     <div class="flex-1 caja flex flex-col">
                        <span class="font-medium text-md">
                           Horario recurrente
                        </span>

                        <small class="text-base-content/70">
                           Horario habitual para recibir reservas
                        </small>
                     </div>

                     <button command="show-modal" commandfor="drawer_crear_horario" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white hover:bg-indigo-500">
                        Añadir
                     </button>
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
            <!-- Horarios -->
            <div class="border border-base-content/10 bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
               <div class="p-4 border-b border-base-content/10">
                  <div class="flex items-center justify-between min-h-8">
                     <div class="flex-1 caja flex flex-col">
                        <span class="font-medium text-md">
                           Días concretos
                        </span>

                        <small class="text-base-content/70">
                           Franjas en días concretos sin afectar a tu horario recurrente
                        </small>
                     </div>

                     <button command="show-modal" commandfor="drawer_crear_horario_concreto" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white hover:bg-indigo-500">
                        Añadir
                     </button>
                  </div>
               </div>

               <div class="material">
                  <div class="overflow-x-auto">
                     <table id="load_horarios_puntual" class="table">

                     </table>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </section>
@endsection

@section('drawers')

   <!-- Franja recurrente -->
   <el-dialog id="modal_o">
      <dialog id="drawer_crear_horario" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-lg transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/10 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Crear horarios</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_horario" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="crearHorario" action="{{ route('horario.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3 gap-y-7">
                        @csrf

                        <!-- Negocio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="negocio_id" class="block text-sm/6 font-medium">Negocio</label>

                           <div class="mt-2">
                              @php
                                 $negocios = Auth::user()->negocios;
                              @endphp

                              @if ($negocios->count() > 0)
                                 <el-select id="negocio_id" name="negocio_id" value="{{ $negocios[0]->uuid }}" class="mt-2 block">
                                    <button type="button"
                                       class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                       <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6"></el-selectedcontent>
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
                                             <div class="flex gap-2 items-center">
                                                <span>
                                                   <img class="size-5 rounded-full" src="@if ($negocio->icono) {{ Storage::url($negocio->icono) }}
                                                @else
                                                   /media/logo/brand.png @endif"
                                                      alt="">
                                                </span>
                                                <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($negocio->nombre) }}</span>
                                             </div>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endforeach
                                    </el-options>
                                 </el-select>
                              @else
                                 No existen negocios, por favor registra uno primero.
                              @endif
                           </div>
                        </div>

                        <!-- Selector de días -->
                        <div class="col-span-full">
                           <fieldset aria-label="Elige un día">
                              <div class="flex items-center justify-between">
                                 <div class="text-sm/6 font-medium text-gray-900">Elige los días</div>
                              </div>
                              <div class="mt-2 grid grid-cols-2 gap-3 sm:grid-cols-4">
                                 <label aria-label="Lunes"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="monday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Lunes</span>
                                 </label>
                                 <label aria-label="Martes"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="tuesday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Martes</span>
                                 </label>
                                 <label aria-label="Miércoles"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="wednesday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Miércoles</span>
                                 </label>
                                 <label aria-label="Jueves"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="thursday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Jueves</span>
                                 </label>
                                 <label aria-label="Viernes"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="friday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Viernes</span>
                                 </label>
                                 <label aria-label="Sábado"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="saturday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Sábado</span>
                                 </label>
                                 <label aria-label="Domingo"
                                    class="group relative flex items-center justify-center rounded-md border border-base-content/10 bg-base-100 p-3 has-checked:border-indigo-600 has-checked:bg-indigo-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-indigo-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                    <input type="checkbox" name="dia[]" value="sunday" class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" />
                                    <span class="text-sm font-medium text-gray-900 uppercase group-has-checked:text-white">Domingo</span>
                                 </label>
                              </div>
                           </fieldset>
                        </div>

                        <!-- Tipo de horario -->
                        <input type="text" hidden name="tipo_horario" value="recurrente">

                        <!-- Franja inicio -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Franja inicio</label>

                           <div class="mt-2">
                              <el-select id="select" name="franja_inicio" value="08:00" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">


                                    @for ($h = 0; $h < 24; $h++)
                                       @for ($m = 0; $m < 60; $m += 15)
                                          @php
                                             $hora = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad($m, 2, '0', STR_PAD_LEFT);
                                          @endphp

                                          <el-option value="{{ $hora }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ $hora }}</span>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endfor
                                    @endfor


                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <!-- Franja final -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Franja final</label>

                           <div class="mt-2">
                              <el-select id="select" name="franja_final" value="18:00" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">


                                    @for ($h = 0; $h < 24; $h++)
                                       @for ($m = 0; $m < 60; $m += 15)
                                          @php
                                             $hora = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad($m, 2, '0', STR_PAD_LEFT);
                                          @endphp

                                          <el-option value="{{ $hora }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ $hora }}</span>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endfor
                                    @endfor


                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear
                              horario</button>
                        </div>
                     </form>

                     <script>
                        const crearHorarioForm = document.getElementById('crearHorario');

                        crearHorarioForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearHorarioForm, {
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

   <!-- Franja concreta -->
   <el-dialog id="modal_o2">
      <dialog id="drawer_crear_horario_concreto" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-lg transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/10 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Fecha concreta</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_crear_horario_concreto" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

                     <form id="crearHorarioConcreto" action="{{ route('horario.store') }}" method="POST" class="grid lg:grid-cols-4 grid-cols-1 gap-3 gap-y-7">
                        @csrf

                        <!-- Negocio -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="negocio_id" class="block text-sm/6 font-medium">Negocio</label>

                           <div class="mt-2">
                              @php
                                 $negocios = Auth::user()->negocios;
                              @endphp

                              @if ($negocios->count() > 0)
                                 <el-select id="negocio_id" name="negocio_id" value="{{ $negocios[0]->uuid }}" class="mt-2 block">
                                    <button type="button"
                                       class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                       <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6"></el-selectedcontent>
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
                                             <div class="flex gap-2 items-center">
                                                <span>
                                                   <img class="size-5 rounded-full" src="@if ($negocio->icono) {{ Storage::url($negocio->icono) }}
                                                @else
                                                   /media/logo/brand.png @endif"
                                                      alt="">
                                                </span>
                                                <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($negocio->nombre) }}</span>
                                             </div>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endforeach
                                    </el-options>
                                 </el-select>
                              @else
                                 No existen negocios, por favor registra uno primero.
                              @endif
                           </div>
                        </div>

                        <!-- Tipo de horario -->
                        <input type="text" hidden name="tipo_horario" value="puntutal">

                        <!-- Fecha concreta -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="fecha" class="block text-sm/6 font-medium">Fecha concreta</label>
                           <div class="mt-2">
                              <input id="fecha" type="date" value="{{ Carbon\Carbon::now()->translatedFormat('Y-m-d') }}" name="fecha" autocomplete="fecha"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-100 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 appearance-none sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Franja inicio -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Franja inicio</label>

                           <div class="mt-2">
                              <el-select id="select" name="franja_inicio" value="08:00" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">


                                    @for ($h = 0; $h < 24; $h++)
                                       @for ($m = 0; $m < 60; $m += 15)
                                          @php
                                             $hora = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad($m, 2, '0', STR_PAD_LEFT);
                                          @endphp

                                          <el-option value="{{ $hora }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ $hora }}</span>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endfor
                                    @endfor


                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <!-- Franja final -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="descripcion" class="block text-sm/6 font-medium">Franja final</label>

                           <div class="mt-2">
                              <el-select id="select" name="franja_final" value="18:00" class="mt-2 block">
                                 <button type="button"
                                    class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Tom Cook</el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">


                                    @for ($h = 0; $h < 24; $h++)
                                       @for ($m = 0; $m < 60; $m += 15)
                                          @php
                                             $hora = str_pad($h, 2, '0', STR_PAD_LEFT) . ':' . str_pad($m, 2, '0', STR_PAD_LEFT);
                                          @endphp

                                          <el-option value="{{ $hora }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ $hora }}</span>
                                             <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                   <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                                </svg>
                                             </span>
                                          </el-option>
                                       @endfor
                                    @endfor


                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-4 py-1.5 text-sm/6 font-semibold hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear
                              horario</button>
                        </div>
                     </form>

                     <script>
                        const crearHorarioConcretoForm = document.getElementById('crearHorarioConcreto');

                        crearHorarioConcretoForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(crearHorarioConcretoForm, {
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

         let id = $('#negocio_id').val();

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

               $('#load_horarios_puntual').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               document.getElementById('modal_o').hide()
               document.getElementById('modal_o2').hide()
               $('#load_horarios_recurrente').empty().append(r.lista_horario_recurrente)
               $('#load_horarios_puntual').empty().append(r.lista_horario_puntual)
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
            if (typeof llamadaLista === "function") {
               llamadaLista();
            }

         } catch (err) {
            alert('Error eliminando horario');
            console.error(err.response?.data);
         }
      });

      window.addEventListener('load', function() {
         // document.getElementById('modal_o').show()
         llamadaLista()

         $('#negocio_id').on('change', function() {
            llamadaLista();
         })
      });
   </script>
@endsection

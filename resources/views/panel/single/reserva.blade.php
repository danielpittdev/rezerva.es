@extends('components.html.plantilla.center')

@section('contenido')
   <section class="bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex items-center gap-5">

         <div class="caja">
            <h1 class="text-md font-medium">
               Información de la reserva
            </h1>
         </div>
      </div>

   </section>

   <section class="grid lg:grid-cols-[auto_1fr] grid-cols-1 items-start gap-3">

      <!-- Izquierda -->
      <section class="col-span-1 lg:col-span-auto space-y-3">
         <!-- Servicios -->
         <div class="min-w-[330px] bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Edición de reserva
                  </span>
               </div>
            </div>

            <div class="material p-4">
               <div class="overflow-x-auto">
                  <form id="reserva_actualizar" action="{{ route('reserva.update', ['reserva' => $reserva->uuid]) }}" method="POST" class="space-y-3 grid lg:grid-cols-4 grid-cols-1 gap-3">
                     @csrf
                     @method('PUT')

                     <div class="lg:col-span-full col-span-1">
                        <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                        <div class="mt-2">
                           <el-select id="estado" name="estado" value="{{ $reserva->estado }}" class="mt-2 block">
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

                                 @php
                                    $estados = ['pendiente', 'confirmado', 'cancelado', 'finalizado'];
                                 @endphp

                                 @foreach ($estados as $estado)
                                    <el-option value="{{ $estado }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <div class="flex gap-2 items-center">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($estado) }}</span>
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
                        </div>
                     </div>

                     <div class="lg:col-span-full col-span-1">
                        <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>
                        <div class="mt-2">
                           <input id="fecha" type="datetime-local" name="fecha" autocomplete="fecha" value="{{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('Y-m-d H:i') }}"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="col-span-full">
                        <button type="submit" class="text-base-100 flex justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Actualizar</button>
                     </div>
                  </form>

                  <script>
                     const reserva_actualizarForm = document.getElementById('reserva_actualizar');

                     reserva_actualizarForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        peticion(reserva_actualizarForm, {
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
      <section class="lg:col-span-1 col-span-full space-y-3">
         <!-- Datos del cliente -->
         <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 col-span-full">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Datos del cliente
                  </span>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">
                  <table class="table">
                     <tbody id="load_datos_cliente">
                        <tr>
                           <td>
                              <div class="caja">
                                 {{ $reserva->cliente->nombre . ' ' . $reserva->cliente->apellido }}
                              </div>

                              <div class="caja">
                                 {{ $reserva->cliente->email . ' ' . $reserva->cliente->telefono }}
                              </div>
                           </td>
                           <td class="text-end">
                              <span class="text-base-content/70">
                                 Veces recurrente: {{ $reserva->cliente->reservas->count() }}
                              </span>
                           </td>
                        </tr>
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


@section('scripts')
@endsection

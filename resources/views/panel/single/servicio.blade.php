@extends('components.html.plantilla.center')

@section('contenido')
   <section class="bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex items-center gap-5">

         <div class="caja">
            <h1 class="text-md font-medium">
               Información de la servicio
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
                     <div class="lg:col-span-full col-span-1">
                        <label for="precio" class="block text-sm/6 font-medium">Nombre</label>
                        <div class="mt-2">
                           <input id="precio" type="number" min="0" step="0.01" name="precio" autocomplete="precio" value="{{ $servicio->precio }}"
                              class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

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

   </section>
@endsection


@section('scripts')
@endsection

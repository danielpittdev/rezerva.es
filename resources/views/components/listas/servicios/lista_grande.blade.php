@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <li class="flex items-center justify-between py-4">
         <div class="flex flex-col justify-between">
            <!-- Caja -->
            <div class="font-medium">
               {{ $servicio->nombre }}
            </div>

            <!-- Caja -->
            <div class="caja text-sm text-base-content/70">
               {{ number_format($servicio->precio, 2, ',', '.') }}
            </div>
         </div>

         <div class="caja">
            <a href="{{ route('servicio', ['id' => $servicio->uuid]) }}">
               <button class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-3 py-1.5 text-sm font-medium hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                  Ver servicio
               </button>
            </a>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="px-4 text-base-content/70">
         No tienes ningún servicio creado
   </li>
@endif

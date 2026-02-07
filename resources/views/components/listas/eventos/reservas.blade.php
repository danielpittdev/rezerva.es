@if ($reservas->count() > 0)
   @foreach ($reservas as $evento)
      <li class="flex items-center justify-between gap-x-6 pb-2">
         <div class="min-w-full">
            <div class="gap-1 w-full">
               @if ($evento->pagado)
                  <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">Pagado</span>
               @endif

               <div class="flex items-start justify-between gap-x-3">
                  <p class="text-sm/6 font-semibold text-base-content/90">{{ $evento->cliente->nombre . ' ' . $evento->cliente->apellido }}</p>
                  <p class="mt-0.5 rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 inset-ring inset-ring-gray-600/20">{{ $evento->cantidad }} unidades</p>
               </div>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
               <p class="whitespace-nowrap"><time>{{ Carbon\Carbon::parse($evento->created_at)->translatedFormat('l d M') }}</time></p>
            </div>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="min-w-0">
         <div class="flex items-start gap-x-3">
            <p class="text-sm/6 font-normal text-base-content/90">No hay reservas</p>
         </div>
      </div>
   </li>
@endif

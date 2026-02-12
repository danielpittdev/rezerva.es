@if ($toppings->count() > 0)
   @foreach ($toppings as $topping)
      <li class="relative flex items-center p-3 hover:bg-base-content/2">
         @if ($topping->icono)
            <img src="{{ Storage::url($topping->icono) }}" alt="{{ $topping->nombre }}" class="size-10 rounded-md object-cover flex-none" />
         @else
            <div class="size-10 rounded-md bg-indigo-100 flex items-center justify-center flex-none">
               <svg class="size-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
               </svg>
            </div>
         @endif
         <div class="ml-3 min-w-0 flex-auto">
            <h2 class="text-sm/6 font-semibold text-base-content truncate">{{ $topping->nombre }}</h2>
            @if ($topping->descripcion)
               <p class="mt-0.5 text-xs text-base-content/50 truncate">{{ $topping->descripcion }}</p>
            @endif
         </div>
         <div class="flex items-center gap-2 flex-none">
            <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-600">{{ number_format($topping->precio, 2, ',', '.') }} &euro;</span>
            <button type="button" onclick="eliminarTopping('{{ $topping->uuid }}')" class="text-red-400 hover:text-red-600 cursor-pointer">
               <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
               </svg>
            </button>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-3">
      <div class="min-w-0 px-3">
         <div class="flex items-start gap-x-3">
            <p class="text-sm/6 font-normal text-base-content/90">No hay toppings</p>
         </div>
      </div>
   </li>
@endif

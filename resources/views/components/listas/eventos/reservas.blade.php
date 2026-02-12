@if ($reservas->count() > 0)
   @foreach ($reservas as $reserva)
      <li target="{{ $reserva->uuid }}" class="caption_reserva cursor-pointer relative flex items-center p-3 hover:bg-base-content/2">
         <div class="min-w-0 flex-auto">
            <div class="flex items-center gap-x-3">

               <h2 class="min-w-0 text-sm/6 font-semibold text-gray-900">
                  <a href="#" class="flex gap-x-2">
                     <span class="truncate">{{ $reserva->cliente->nombre . ' ' . $reserva->cliente->apellido }}</span>
                  </a>
               </h2>
            </div>
            <div class="mt-1 flex items-center gap-x-2.5 text-xs/5 text-gray-500">
               <p class="truncate">{{ $reserva->created_at }}</p>
            </div>
         </div>
         <div class="flex-none rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10 mr-2">
            {{ ucfirst($reserva->metodo_pago) }}
         </div>
         <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 flex-none text-gray-400">
            <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
         </svg>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-3">
      <div class="min-w-0 px-3">
         <div class="flex items-start gap-x-3">
            <p class="text-sm/6 font-normal text-base-content/90">No hay reservas</p>
         </div>
      </div>
   </li>
@endif

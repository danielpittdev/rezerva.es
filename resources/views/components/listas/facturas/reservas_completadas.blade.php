@if ($reservasCompletadas->count() > 0)
   @foreach ($reservasCompletadas as $reserva)
      <li class="flex items-center justify-between gap-x-6 p-3 px-5 hover:bg-base-200/50">
         <div class="flex items-center gap-3 min-w-0 pl-4 border-l-4" style="border-color: {{ $reserva->servicio->color ?? 'gray' }}">
            <span class="inline-flex items-center rounded-md bg-base-300 px-2 py-1 text-xs font-medium text-base-content">
               {{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('d M Y - H:i') }}
            </span>

            <div class="min-w-0">
               <a class="hover:underline" href="{{ route('reserva', ['id' => $reserva->uuid]) }}">
                  <p class="text-sm font-medium text-base-content truncate">
                     {{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}
                  </p>
                  <p class="text-xs text-base-content/70 truncate">
                     {{ $reserva->servicio->nombre }}
                  </p>
               </a>
            </div>
         </div>

         <div class="flex items-center gap-3">
            <span class="text-sm font-medium text-base-content">
               {{ number_format($reserva->servicio->precio, 2, ',', '.') }} {{ $reserva->servicio->negocio->moneda ?? 'EUR' }}
            </span>
            <span class="rounded-full bg-blue-500/20 px-2 py-0.5 text-xs font-medium text-blue-600">
               Completado
            </span>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 p-3">
      <div class="min-w-0">
         <div class="mt-1 flex items-center gap-x-2">
            <p class="truncate text-base-content/70">No hay reservas completadas</p>
         </div>
      </div>
   </li>
@endif
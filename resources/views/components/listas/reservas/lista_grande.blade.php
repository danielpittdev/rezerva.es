<div class="divide-y divide-base-content/10">
   @foreach ($reservas as $reserva)
      <li class="flex items-center bg-base-100 hover:bg-base-200/50 justify-between gap-x-4 p-4">

         <div class="flex items-center gap-3 min-w-0">
            <span class="inline-flex items-center rounded-md bg-base-300 px-2 py-1 text-xs font-medium text-base-content">
               {{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('H:i') }}
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

         <div class="flex items-center gap-2">
            @switch($reserva->estado)
               @case('pendiente')
                  <span class="rounded-full bg-yellow-500/20 px-2 py-0.5 text-xs font-medium text-yellow-600">{{ ucfirst($reserva->estado) }}</span>
               @break

               @case('confirmado')
                  <span class="rounded-full bg-green-500/20 px-2 py-0.5 text-xs font-medium text-green-600">{{ ucfirst($reserva->estado) }}</span>
               @break

               @case('cancelado')
                  <span class="rounded-full bg-red-500/20 px-2 py-0.5 text-xs font-medium text-red-600">{{ ucfirst($reserva->estado) }}</span>
               @break

               @case('completado')
                  <span class="rounded-full bg-blue-500/20 px-2 py-0.5 text-xs font-medium text-blue-600">{{ ucfirst($reserva->estado) }}</span>
               @break
            @endswitch
         </div>

      </li>
   @endforeach
</div>

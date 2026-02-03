@php
   // Agrupar reservas por franjas horarias
   $franjas = [
       'manana' => ['nombre' => 'Mañana', 'inicio' => 6, 'fin' => 12, 'reservas' => collect()],
       'mediodia' => ['nombre' => 'Mediodía', 'inicio' => 12, 'fin' => 15, 'reservas' => collect()],
       'tarde' => ['nombre' => 'Tarde', 'inicio' => 15, 'fin' => 20, 'reservas' => collect()],
       'noche' => ['nombre' => 'Noche', 'inicio' => 20, 'fin' => 24, 'reservas' => collect()],
   ];

   foreach ($reservas as $reserva) {
       $hora = Carbon\Carbon::parse($reserva->fecha)->hour;

       if ($hora >= 6 && $hora < 12) {
           $franjas['manana']['reservas']->push($reserva);
       } elseif ($hora >= 12 && $hora < 15) {
           $franjas['mediodia']['reservas']->push($reserva);
       } elseif ($hora >= 15 && $hora < 20) {
           $franjas['tarde']['reservas']->push($reserva);
       } else {
           $franjas['noche']['reservas']->push($reserva);
       }
   }
@endphp

<div class="space-y-2">
   @foreach ($franjas as $key => $franja)
      @if ($franja['reservas']->count() > 0)
         <div class="bg-base-100 rounded-lg overflow-hidden">
            <div class="bg-base-100 px-4 py-4 border-b border-base-content/10">
               <h3 class="text-sm font-semibold text-base-content flex items-center gap-2">
                  @switch($key)
                     @case('manana')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                     @break

                     @case('mediodia')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                     @break

                     @case('tarde')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                     @break

                     @case('noche')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                     @break
                  @endswitch
                  {{ $franja['nombre'] }}
                  <span class="text-xs text-base-content/50">({{ $franja['reservas']->count() }})</span>
               </h3>
            </div>

            <ul class="divide-y divide-base-content/10">
               @foreach ($franja['reservas'] as $reserva)
                  <li class="flex items-center justify-between gap-x-4 px-4 py-3 hover:bg-base-100/50">
                     <div class="flex items-center gap-3 min-w-0">
                        <span class="inline-flex items-center rounded-md bg-base-300 px-2 py-1 text-xs font-medium text-base-content">
                           {{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('H:i') }}
                        </span>

                        <div class="min-w-0">
                           <p class="text-sm font-medium text-base-content truncate">
                              {{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}
                           </p>
                           <p class="text-xs text-base-content/70 truncate">
                              {{ $reserva->servicio->nombre }}
                           </p>
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

                        <a href="{{ route('reserva', ['id' => $reserva->uuid]) }}" class="text-base-content/50 hover:text-base-content">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                           </svg>
                        </a>
                     </div>
                  </li>
               @endforeach
            </ul>
         </div>
      @endif
   @endforeach

   @if ($reservas->count() === 0)
      <div class="flex flex-col items-center justify-center py-12 text-base-content/50">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
         </svg>
         <p class="text-sm">No hay reservas para este día</p>
      </div>
   @endif
</div>

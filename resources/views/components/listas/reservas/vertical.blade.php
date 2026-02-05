@php
   // Generar horas del día (de 7:00 a 22:00)
   $horasDelDia = [];
   for ($i = 7; $i <= 22; $i++) {
       $horasDelDia[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
   }

   // Agrupar reservas por hora
   $reservasPorHora = [];
   foreach ($reservas as $reserva) {
       $hora = Carbon\Carbon::parse($reserva->fecha)->format('H:00');
       if (!isset($reservasPorHora[$hora])) {
           $reservasPorHora[$hora] = collect();
       }
       $reservasPorHora[$hora]->push($reserva);
   }

   // Hora actual para resaltar
   $horaActual = Carbon\Carbon::now()->format('H:00');
@endphp

<style>
   @keyframes pulseGlow {

      0%,
      100% {
         box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
      }

      50% {
         box-shadow: 0 0 0 8px rgba(99, 102, 241, 0);
      }
   }

   .timeline-dot-active {
      animation: pulseGlow 2s ease-in-out infinite;
   }

   @keyframes slideIn {
      from {
         opacity: 0;
         transform: translateX(-10px);
      }

      to {
         opacity: 1;
         transform: translateX(0);
      }
   }

   .timeline-card {
      animation: slideIn 0.3s ease-out forwards;
   }

   .timeline-card:hover {
      transform: translateX(4px);
   }
</style>

<div class="relative p-4 pb-8">
   <!-- Línea principal del timeline -->
   <div class="absolute left-[67px] top-6 bottom-6 w-0.5 bg-gradient-to-b from-primary/50 via-base-content/20 to-base-content/10 rounded-full"></div>

   <div class="space-y-1">
      @foreach ($horasDelDia as $index => $hora)
         @php
            $tieneReservas = isset($reservasPorHora[$hora]) && $reservasPorHora[$hora]->count() > 0;
            $esHoraActual = $hora === $horaActual;
            $cantidadReservas = $tieneReservas ? $reservasPorHora[$hora]->count() : 0;
         @endphp

         <div class="relative flex gap-4 group {{ $tieneReservas ? 'pb-3' : 'pb-1' }}">
            <!-- Hora y punto del timeline -->
            <div class="relative z-10 flex items-center gap-2 min-w-[70px]">
               <span class="text-xs font-semibold w-10 text-right transition-colors duration-200
                  {{ $esHoraActual ? 'text-primary' : ($tieneReservas ? 'text-base-content' : 'text-base-content/40') }}
                  group-hover:text-base-content">
                  {{ $hora }}
               </span>

               <!-- Punto del timeline -->
               <div class="relative">
                  @if ($esHoraActual)
                     <div class="w-3 h-3 rounded-full bg-primary timeline-dot-active"></div>
                     <div class="absolute inset-0 w-3 h-3 rounded-full bg-primary/30 animate-ping"></div>
                  @elseif ($tieneReservas)
                     <div class="w-3 h-3 rounded-full bg-primary transition-transform duration-200 group-hover:scale-125"></div>
                  @else
                     <div class="w-2 h-2 rounded-full bg-base-content/20 transition-all duration-200 group-hover:bg-base-content/40 group-hover:scale-110"></div>
                  @endif

                  <!-- Badge de cantidad -->
                  @if ($cantidadReservas > 1)
                     <span class="absolute -top-1 -right-1 w-4 h-4 flex items-center justify-center text-[10px] font-bold text-white bg-primary rounded-full">
                        {{ $cantidadReservas }}
                     </span>
                  @endif
               </div>
            </div>

            <!-- Contenido de reservas -->
            <div class="flex-1 min-w-0 pt-0.5">
               @if ($tieneReservas)
                  <div class="space-y-2">
                     @foreach ($reservasPorHora[$hora] as $reservaIndex => $reserva)
                        @php
                           $estadoConfig = match ($reserva->estado) {
                               'pendiente' => [
                                   'border' => 'border-l-yellow-500',
                                   'bg' => 'bg-yellow-500/10',
                                   'text' => 'text-yellow-600',
                                   'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                   'badge' => 'bg-yellow-500/20 text-yellow-700 ring-yellow-500/30',
                               ],
                               'confirmado' => [
                                   'border' => 'border-l-green-500',
                                   'bg' => 'bg-green-500/10',
                                   'text' => 'text-green-600',
                                   'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                   'badge' => 'bg-green-500/20 text-green-700 ring-green-500/30',
                               ],
                               'cancelado' => [
                                   'border' => 'border-l-red-500',
                                   'bg' => 'bg-red-500/10',
                                   'text' => 'text-red-600',
                                   'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                                   'badge' => 'bg-red-500/20 text-red-700 ring-red-500/30',
                               ],
                               'completado' => [
                                   'border' => 'border-l-blue-500',
                                   'bg' => 'bg-blue-500/10',
                                   'text' => 'text-blue-600',
                                   'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                                   'badge' => 'bg-blue-500/20 text-blue-700 ring-blue-500/30',
                               ],
                               default => [
                                   'border' => 'border-l-base-content/30',
                                   'bg' => 'bg-base-200',
                                   'text' => 'text-base-content',
                                   'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                                   'badge' => 'bg-base-300 text-base-content ring-base-content/20',
                               ],
                           };
                        @endphp

                        <a href="{{ route('reserva', ['id' => $reserva->uuid]) }}"
                           class="timeline-card block rounded-xl border-l-4 {{ $estadoConfig['border'] }} {{ $estadoConfig['bg'] }} p-4 transition-all duration-300 hover:shadow-lg hover:shadow-base-content/5"
                           style="animation-delay: {{ $reservaIndex * 50 }}ms;">

                           <!-- Header de la tarjeta -->
                           <div class="flex items-start justify-between gap-3 mb-3">
                              <div class="flex items-center gap-2">
                                 <!-- Icono de hora -->
                                 <div class="flex items-center gap-1.5 px-2 py-1 rounded-lg bg-base-100/80 border border-base-content/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-xs font-bold text-base-content">
                                       {{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('H:i') }}
                                    </span>
                                 </div>

                                 <!-- Badge de estado -->
                                 <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-medium ring-1 ring-inset {{ $estadoConfig['badge'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $estadoConfig['icon'] }}" />
                                    </svg>
                                    {{ ucfirst($reserva->estado) }}
                                 </span>
                              </div>

                              <!-- Flecha -->
                              <div class="flex-shrink-0 p-1.5 rounded-lg bg-base-100/50 text-base-content/40 group-hover:text-base-content transition-colors">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                 </svg>
                              </div>
                           </div>

                           <!-- Información del cliente -->
                           <div class="flex items-center gap-3 mb-3">
                              <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center border border-primary/20">
                                 <span class="text-sm font-bold text-primary">
                                    {{ strtoupper(substr($reserva->cliente->nombre, 0, 1)) }}{{ strtoupper(substr($reserva->cliente->apellido, 0, 1)) }}
                                 </span>
                              </div>
                              <div class="min-w-0 flex-1">
                                 <p class="text-sm font-semibold text-base-content truncate">
                                    {{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}
                                 </p>
                                 @if ($reserva->cliente->telefono)
                                    <p class="text-xs text-base-content/50 truncate flex items-center gap-1">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                       </svg>
                                       {{ $reserva->cliente->telefono }}
                                    </p>
                                 @endif
                              </div>
                           </div>

                           <!-- Información del servicio -->
                           <div class="flex items-center justify-between p-2.5 rounded-lg bg-base-100/60 border border-base-content/5">
                              <div class="flex items-center gap-2 min-w-0">
                                 <div class="p-1.5 rounded-md" style="background-color: {{ $reserva->servicio->color ?? '#e5e7eb' }}20;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" style="color: {{ $reserva->servicio->color ?? '#6b7280' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                 </div>
                                 <span class="text-sm text-base-content/80 truncate">{{ $reserva->servicio->nombre }}</span>
                              </div>
                              <span class="flex-shrink-0 text-sm font-bold text-primary">
                                 {{ number_format($reserva->servicio->precio, 2, ',', '.') }} EUR
                              </span>
                           </div>
                        </a>
                     @endforeach
                  </div>
               @else
                  <!-- Línea de hora vacía con hover sutil -->
                  <div class="h-6 flex items-center">
                     <div class="w-full h-px bg-base-content/5 group-hover:bg-base-content/10 transition-colors duration-200"></div>
                  </div>
               @endif
            </div>
         </div>
      @endforeach
   </div>

   <!-- Mensaje cuando no hay reservas -->
   @if ($reservas->count() === 0)
      <div class="absolute inset-0 flex flex-col items-center justify-center bg-base-100/80 backdrop-blur-sm rounded-xl">
         <div class="text-center p-8">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-base-200 flex items-center justify-center">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
               </svg>
            </div>
            <h3 class="text-lg font-semibold text-base-content mb-1">Sin reservas</h3>
            <p class="text-sm text-base-content/50">No hay reservas programadas para este día</p>
         </div>
      </div>
   @endif
</div>

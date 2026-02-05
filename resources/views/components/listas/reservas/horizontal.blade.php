@php
   use Carbon\Carbon;

   // Obtener el día de la semana de la fecha (1=lunes, 7=domingo)
   $fechaCarbon = Carbon::parse($fecha);
   $diaSemana = $fechaCarbon->dayOfWeekIso;

   // Obtener los horarios del negocio para ese día
   $horariosDelDia = $negocio->horarios_recurrentes()->where('dia', $diaSemana)->orderBy('franja_inicio')->get();

   // También verificar si hay horario excepcional para esa fecha específica
   $horarioExcepcional = $negocio->horarios_puntuales()->whereDate('fecha', $fecha)->first();

   // Determinar las horas de inicio y fin
   if ($horarioExcepcional) {
       // Si hay horario excepcional, usarlo
       if ($horarioExcepcional->cerrado) {
           $horaInicio = 0;
           $horaFin = 0;
           $negocioCerrado = true;
       } else {
           $horaInicio = (int) Carbon::parse($horarioExcepcional->franja_inicio)->format('H');
           $horaFin = (int) Carbon::parse($horarioExcepcional->franja_final)->format('H');
           $negocioCerrado = false;
       }
   } elseif ($horariosDelDia->isNotEmpty()) {
       // Usar el horario recurrente del día
       $primeraFranja = $horariosDelDia->first();
       $ultimaFranja = $horariosDelDia->last();

       $horaInicio = (int) Carbon::parse($primeraFranja->franja_inicio)->format('H');
       $horaFin = (int) Carbon::parse($ultimaFranja->franja_final)->format('H');
       $negocioCerrado = false;
   } else {
       // Si no hay horario definido, usar valores por defecto
       $horaInicio = 8;
       $horaFin = 20;
       $negocioCerrado = false;
   }

   // Asegurar que horaFin sea mayor que horaInicio
   if ($horaFin <= $horaInicio) {
       $horaFin = $horaInicio + 1;
   }

   // Generar las horas del día según el horario del negocio
   $horasDelDia = [];
   for ($i = $horaInicio; $i <= $horaFin; $i++) {
       $horasDelDia[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
   }

   $totalHoras = $horaFin - $horaInicio;

   // Hora actual para resaltar
   $horaActual = Carbon::now()->format('H');
   $esHoy = $fechaCarbon->isToday();

   // Nombre del día
   $nombreDia = $fechaCarbon->translatedFormat('l, j F Y');
@endphp

<style>
   @keyframes slideInHorizontal {
      from {
         opacity: 0;
         transform: translateY(-5px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   .reserva-card {
      animation: slideInHorizontal 0.3s ease-out forwards;
   }

   .reserva-card:hover {
      transform: scale(1.02);
      z-index: 10;
   }

   .hora-actual-linea {
      animation: pulse 2s ease-in-out infinite;
   }

   @keyframes pulse {

      0%,
      100% {
         opacity: 1;
      }

      50% {
         opacity: 0.5;
      }
   }
</style>

<div class="p-4 overflow-x-auto">
   @if ($negocioCerrado ?? false)
      <!-- Negocio cerrado -->
      <div class="flex flex-col items-center justify-center py-16 text-base-content/50">
         <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-red-500/10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
         </div>
         <h3 class="text-lg font-semibold text-base-content mb-1">Negocio cerrado</h3>
         <p class="text-sm text-base-content/50">El negocio no tiene horario para este día</p>
      </div>
   @else
      <div class="min-w-[800px]">
         <!-- Cabecera con fecha y horario -->
         <div class="flex items-center justify-between mb-4 pb-3 border-b border-base-content/10">
            <div>
               <h3 class="text-sm font-semibold text-base-content capitalize">{{ $nombreDia }}</h3>
               <p class="text-xs text-base-content/50">
                  Horario: {{ str_pad($horaInicio, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($horaFin, 2, '0', STR_PAD_LEFT) }}:00
                  @if ($horariosDelDia->count() > 1)
                     <span class="text-primary">({{ $horariosDelDia->count() }} franjas)</span>
                  @endif
               </p>
            </div>
            <div class="flex items-center gap-2 text-xs text-base-content/50">
               <span class="flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  {{ $reservas->count() }} reserva{{ $reservas->count() !== 1 ? 's' : '' }}
               </span>
            </div>
         </div>

         <!-- Línea de horas -->
         <div class="flex border-b border-base-content/20 mb-3">
            @foreach ($horasDelDia as $index => $hora)
               @php
                  $esHoraActualItem = $esHoy && (int) substr($hora, 0, 2) === (int) $horaActual;
               @endphp
               <div class="flex-1 text-center text-xs pb-2 border-l border-base-content/10 first:border-l-0 relative
                  {{ $esHoraActualItem ? 'text-primary font-bold' : 'text-base-content/50' }}">
                  {{ $hora }}
                  @if ($esHoraActualItem)
                     <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-2 h-2 bg-primary rounded-full"></div>
                  @endif
               </div>
            @endforeach
         </div>

         <!-- Timeline container -->
         <div class="relative bg-base-200/30 rounded-lg overflow-hidden" style="height: {{ max($reservas->count() * 70 + 30, 120) }}px;">
            <!-- Grid de fondo -->
            <div class="absolute inset-0 flex">
               @foreach ($horasDelDia as $index => $hora)
                  @php
                     $esHoraActualItem = $esHoy && (int) substr($hora, 0, 2) === (int) $horaActual;
                  @endphp
                  <div class="flex-1 border-l {{ $index === 0 ? 'border-l-0' : '' }}
                     {{ $esHoraActualItem ? 'border-primary/30 bg-primary/5' : 'border-base-content/5' }}"></div>
               @endforeach
            </div>

            <!-- Línea de hora actual -->
            @if ($esHoy && $horaActual >= $horaInicio && $horaActual <= $horaFin)
               @php
                  $minutoActual = (int) Carbon::now()->format('i');
                  $posicionHoraActual = (((int) $horaActual - $horaInicio + $minutoActual / 60) / $totalHoras) * 100;
               @endphp
               <div class="absolute top-0 bottom-0 w-0.5 bg-primary hora-actual-linea z-20" style="left: {{ $posicionHoraActual }}%;">
                  <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-3 h-3 bg-primary rounded-full"></div>
               </div>
            @endif

            <!-- Reservas -->
            @php $yOffset = 15; @endphp
            @foreach ($reservas as $reservaIndex => $reserva)
               @php
                  $reservaHora = Carbon::parse($reserva->fecha);
                  $horaDecimal = $reservaHora->hour + $reservaHora->minute / 60;

                  // Calcular posición desde el inicio
                  $posicionInicio = (($horaDecimal - $horaInicio) / $totalHoras) * 100;

                  // Duración del servicio
                  $duracion = $reserva->servicio->duracion ?? 60;
                  $anchoReserva = ($duracion / 60 / $totalHoras) * 100;

                  // Asegurar que no se salga del contenedor
                  $posicionInicio = max(0, min($posicionInicio, 100 - 1));
                  $anchoReserva = min($anchoReserva, 100 - $posicionInicio);

                  // Configuración de colores según estado
                  $estadoConfig = match ($reserva->estado) {
                      'pendiente' => [
                          'bg' => 'bg-gradient-to-r from-yellow-500 to-yellow-400',
                          'border' => 'border-yellow-600',
                          'shadow' => 'shadow-yellow-500/20',
                      ],
                      'confirmado' => [
                          'bg' => 'bg-gradient-to-r from-green-500 to-green-400',
                          'border' => 'border-green-600',
                          'shadow' => 'shadow-green-500/20',
                      ],
                      'cancelado' => [
                          'bg' => 'bg-gradient-to-r from-red-500 to-red-400',
                          'border' => 'border-red-600',
                          'shadow' => 'shadow-red-500/20',
                      ],
                      'completado' => [
                          'bg' => 'bg-gradient-to-r from-blue-500 to-blue-400',
                          'border' => 'border-blue-600',
                          'shadow' => 'shadow-blue-500/20',
                      ],
                      default => [
                          'bg' => 'bg-gradient-to-r from-base-300 to-base-200',
                          'border' => 'border-base-content/20',
                          'shadow' => 'shadow-base-content/10',
                      ],
                  };
               @endphp

               <a href="{{ route('reserva', ['id' => $reserva->uuid]) }}"
                  class="reserva-card absolute rounded-lg px-3 py-2 text-white text-xs border-l-4 shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer overflow-hidden {{ $estadoConfig['bg'] }} {{ $estadoConfig['border'] }} {{ $estadoConfig['shadow'] }}"
                  style="left: {{ $posicionInicio }}%; width: {{ max($anchoReserva, 10) }}%; top: {{ $yOffset }}px; min-height: 50px; animation-delay: {{ $reservaIndex * 50 }}ms;"
                  title="{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }} - {{ $reserva->servicio->nombre }} ({{ Carbon::parse($reserva->fecha)->translatedFormat('H:i') }})">

                  <div class="flex items-center gap-1.5 mb-1">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                     <span class="font-bold">{{ Carbon::parse($reserva->fecha)->translatedFormat('H:i') }}</span>
                  </div>
                  <div class="font-medium truncate">
                     {{ $reserva->cliente->nombre }} {{ substr($reserva->cliente->apellido, 0, 1) }}.
                  </div>
                  <div class="truncate text-[10px] opacity-80 flex items-center gap-1">
                     <span class="w-2 h-2 rounded-full flex-shrink-0" style="background-color: {{ $reserva->servicio->color ?? '#9ca3af' }}"></span>
                     {{ $reserva->servicio->nombre }}
                  </div>
               </a>

               @php $yOffset += 60; @endphp
            @endforeach
         </div>

         <!-- Leyenda -->
         <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-base-content/70">
            <div class="flex items-center gap-1.5">
               <span class="w-4 h-4 rounded bg-gradient-to-r from-yellow-500 to-yellow-400"></span>
               <span>Pendiente</span>
            </div>
            <div class="flex items-center gap-1.5">
               <span class="w-4 h-4 rounded bg-gradient-to-r from-green-500 to-green-400"></span>
               <span>Confirmado</span>
            </div>
            <div class="flex items-center gap-1.5">
               <span class="w-4 h-4 rounded bg-gradient-to-r from-red-500 to-red-400"></span>
               <span>Cancelado</span>
            </div>
            <div class="flex items-center gap-1.5">
               <span class="w-4 h-4 rounded bg-gradient-to-r from-blue-500 to-blue-400"></span>
               <span>Completado</span>
            </div>
            @if ($esHoy)
               <div class="flex items-center gap-1.5 ml-auto">
                  <span class="w-4 h-0.5 bg-primary"></span>
                  <span class="text-primary">Hora actual</span>
               </div>
            @endif
         </div>
      </div>

      <!-- Mensaje cuando no hay reservas -->
      @if ($reservas->count() === 0)
         <div class="flex flex-col items-center justify-center py-12 text-base-content/50">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-base-200 flex items-center justify-center">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
               </svg>
            </div>
            <p class="text-sm font-medium text-base-content">Sin reservas</p>
            <p class="text-xs text-base-content/50">No hay reservas programadas para este día</p>
         </div>
      @endif
   @endif
</div>

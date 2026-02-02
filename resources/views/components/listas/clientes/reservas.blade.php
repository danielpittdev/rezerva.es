@if ($reservas->count() > 0)
   @foreach ($reservas as $reserva)
      <tr>
         <td>
            <div class="flex flex-col">
               <span class="font-medium text-sm">{{ $reserva->servicio->nombre }}</span>
               <span class="text-xs text-base-content/70">{{ $reserva->fecha->format('d/m/Y H:i') }}</span>
            </div>
         </td>
         <td>
            @php
               $estadoClases = [
                   'completado' => 'bg-green-300/20 text-black/50 ring-green-300/30',
                   'pendiente' => 'bg-yellow-300/20 text-black/50 ring-yellow-300/30',
                   'cancelado' => 'bg-red-300/20 text-black/50 ring-red-300/30',
                   'confirmado' => 'bg-green-300/20 text-black/50 ring-green-300/30',
               ];
               $estadoTexto = [
                   'completado' => 'Completada',
                   'pendiente' => 'Pendiente',
                   'cancelado' => 'Cancelada',
                   'Confirmado' => 'Cancelada',
               ];
            @endphp
            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 inset-ring {{ $estadoClases[$reserva->estado] }}">
               {{ $estadoTexto[$reserva->estado] ?? ucfirst($reserva->estado) }}
            </span>
         </td>
         <td class="text-end">
            <span class="font-medium">{{ number_format($reserva->servicio->precio, 2, ',', '.') }} €</span>
         </td>
      </tr>
   @endforeach
@else
   <tr>
      <td colspan="3" class="text-center py-4 text-base-content/70">
         No hay reservas registradas
      </td>
   </tr>
@endif

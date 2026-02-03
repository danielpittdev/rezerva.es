@if ($ultimasReservas->count() > 0)
   <thead>
      <tr>
         <th>Cliente</th>
         <th>Servicio</th>
         <th>Fecha</th>
         <th>Estado</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($ultimasReservas as $reserva)
         <tr>
            <td>
               @if ($reserva->cliente)
                  {{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}
               @else
                  <span class="text-base-content/50">Sin cliente</span>
               @endif
            </td>
            <td>
               @if ($reserva->servicio)
                  {{ $reserva->servicio->nombre }}
               @else
                  <span class="text-base-content/50">-</span>
               @endif
            </td>
            <td>
               {{ \Carbon\Carbon::parse($reserva->fecha)->translatedFormat('d M Y') }}
               <span class="text-base-content/50">{{ $reserva->hora }}</span>
            </td>
            <td>
               @if ($reserva->estado === 'completado')
                  <span class="badge badge-success badge-sm">Completado</span>
               @elseif ($reserva->estado === 'pendiente')
                  <span class="badge badge-warning badge-sm">Pendiente</span>
               @elseif ($reserva->estado === 'cancelado')
                  <span class="badge badge-error badge-sm">Cancelado</span>
               @else
                  <span class="badge badge-ghost badge-sm">{{ ucfirst($reserva->estado) }}</span>
               @endif
            </td>
         </tr>
      @endforeach
   </tbody>
@else
   <tbody>
      <tr>
         <td colspan="4" class="text-center text-base-content/70 py-8">
            No hay reservas registradas
         </td>
      </tr>
   </tbody>
@endif

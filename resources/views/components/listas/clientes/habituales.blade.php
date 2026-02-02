@if ($clientes->count() > 0)
   @foreach ($clientes as $cliente)
      <tr>
         <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
         <td class="text-end">
            <span class="text-base-content/70">
               Veces recurrente: {{ $cliente->reservas->count() }}
            </span>
         </td>
      </tr>
   @endforeach
@else
   <tr>
      <td colspan="2">
         No hay clientes registrados
      </td>
   </tr>
@endif

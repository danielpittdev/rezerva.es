@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <tr>
         <td>
            <a class="hover:underline" href="{{ route('servicio', ['id' => $servicio->uuid]) }}">
               {{ $servicio->nombre }}
            </a>
         </td>
         <td class="text-end">{{ number_format($servicio->precio, 2, ',', '.') }}</td>
      </tr>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="px-4 text-base-content/70">
         No tienes ningún servicio creado
   </li>
@endif

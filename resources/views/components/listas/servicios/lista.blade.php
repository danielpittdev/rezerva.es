@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <tr>
         <td>
            <a class="hover:underline" href="{{ route('servicio', ['id' => $servicio->uuid]) }}">
               {{ $servicio->nombre }}
            </a>
         </td>
         <td class="text-end">{{ number_format($servicio->precio, 2, ',', '.') }}</td>
         <td class="text-end">
            <button type="button" onclick="eliminarServicio('{{ $servicio->uuid }}')" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-xs inset-ring inset-ring-red-300 hover:bg-red-100">
               Eliminar
            </button>
         </td>
      </tr>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="px-4 text-base-content/70">
         No tienes ningún servicio creado
      </div>
   </li>
@endif

<script>
   function eliminarServicio(uuid) {
      if (!confirm('¿Estás seguro de que deseas eliminar este servicio?')) return;

      $.ajax({
         type: "DELETE",
         url: `/api/v1/servicio/${uuid}`,
         headers: {
            "Authorization": "Bearer " + localStorage.getItem('token'),
            "Accept": "application/json"
         },
         success: function(r) {
            llamadaLista();
         },
         error: function(e) {
            console.log(e.responseJSON);
            alert('Error al eliminar el servicio');
         }
      });
   }
</script>

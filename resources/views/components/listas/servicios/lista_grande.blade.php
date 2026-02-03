@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <li class="flex items-center justify-between py-4">
         <div class="flex flex-col justify-between">
            <!-- Caja -->
            <div class="font-medium">
               {{ $servicio->nombre }}
            </div>

            <!-- Caja -->
            <div class="caja text-sm text-base-content/70">
               {{ number_format($servicio->precio, 2, ',', '.') }}
            </div>
         </div>

         <div class="flex gap-1">
            <a href="{{ route('servicio', ['id' => $servicio->uuid]) }}">
               <button class="cursor-pointer flex ml-auto justify-center rounded-md bg-indigo-600 text-white px-3 py-1.5 text-sm font-medium hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                  Ver servicio
               </button>
            </a>

            <button type="button" onclick="eliminarServicio('{{ $servicio->uuid }}')" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-xs inset-ring inset-ring-red-300 hover:bg-red-100">
               Eliminar
            </button>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="px-4 text-base-content/70">
         No tienes ningún servicio creado
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

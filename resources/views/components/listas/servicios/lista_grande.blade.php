@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <li class="flex items-center justify-between gap-x-6 py-5">
         <div class="min-w-0">
            <div class="flex items-start gap-x-3">
               <p class="text-sm/6 font-semibold text-gray-900">{{ $servicio->nombre }}</p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
               <p class="whitespace-nowrap">Creado el: <time datetime="2023-06-10T00:00Z">{{ Carbon\Carbon::parse($servicio->created_at)->translatedFormat('l d M') }}</time></p>
               <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                  <circle r="1" cx="1" cy="1" />
               </svg>
               <p class="truncate">{{ number_format($servicio->precio, 2, ',', '.') }}</p>
            </div>
         </div>
         <div class="flex flex-none items-center gap-x-4">
            <a href="{{ route('servicio', ['id' => $servicio->uuid]) }}" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">Ver servicio<span class="sr-only">, {{ $servicio->nombre }}</span></a>
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

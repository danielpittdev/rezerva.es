@if ($empleados->count() > 0)
   @foreach ($empleados as $empleado)
      <li class="flex items-center justify-between gap-x-6 py-5">
         <div class="flex items-center gap-x-4 min-w-0">
            <div class="bg-indigo-500 rounded-full size-10 flex items-center justify-center text-white text-sm font-bold shrink-0">
               {{ strtoupper(substr($empleado->nombre, 0, 1) . substr($empleado->apellido, 0, 1)) }}
            </div>
            <div class="min-w-0">
               <div class="flex items-start gap-x-3">
                  <p class="text-sm/6 font-semibold">
                     <a class="hover:underline" href="{{ route('empleado', ['id' => $empleado->uuid]) }}">
                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                     </a>
                  </p>
                  @if ($empleado->estado === 'activo')
                     <p class="mt-0.5 rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">Activo</p>
                  @else
                     <p class="mt-0.5 rounded-md bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 inset-ring inset-ring-red-600/20">Inactivo</p>
                  @endif
               </div>
               <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                  <p class="truncate">{{ ucfirst($empleado->tipo) }}</p>
                  <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                     <circle r="1" cx="1" cy="1" />
                  </svg>
                  @if ($empleado->email)
                     <p class="truncate">{{ $empleado->email }}</p>
                  @elseif ($empleado->telefono)
                     <p class="truncate">{{ $empleado->telefono }}</p>
                  @endif
               </div>
            </div>
         </div>
         <div class="flex flex-none items-center gap-x-4">
            <a href="{{ route('empleado', ['id' => $empleado->uuid]) }}" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">Ver empleado</a>
            <button type="button" onclick="eliminarEmpleado('{{ $empleado->uuid }}')" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-xs inset-ring inset-ring-red-300 hover:bg-red-100">
               Eliminar
            </button>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="p-2 text-base-content/70">
         No tienes ningún empleado creado
      </div>
   </li>
@endif

<script>
   function eliminarEmpleado(uuid) {
      if (!confirm('¿Estás seguro de que deseas eliminar este empleado?')) return;

      $.ajax({
         type: "DELETE",
         url: `/api/v1/empleado/${uuid}`,
         headers: {
            "Authorization": "Bearer " + localStorage.getItem('token'),
            "Accept": "application/json"
         },
         success: function(r) {
            llamadaLista();
         },
         error: function(e) {
            console.log(e.responseJSON);
            alert('Error al eliminar el empleado');
         }
      });
   }
</script>

@if ($clientes->count() > 0)
   @foreach ($clientes as $cliente)
      <li class="flex items-center justify-between gap-x-6 py-5">
         <div class="flex min-w-0 lg:gap-x-4 gap-x-3">
            <a href="{{ route('cliente', ['id' => $cliente->uuid]) }}" class="size-12 flex-none rounded-full bg-indigo-500 flex items-center justify-center text-white font-semibold hover:bg-indigo-600 transition-colors">
               {{ strtoupper(substr($cliente->nombre, 0, 1)) }}{{ strtoupper(substr($cliente->apellido, 0, 1)) }}
            </a>
            <div class="min-w-0 flex-auto">
               <p class="text-sm/6 font-semibold text-base-content">
                  <a href="{{ route('cliente', ['id' => $cliente->uuid]) }}" class="hover:underline">
                     {{ $cliente->nombre . ' ' . $cliente->apellido }}
                  </a>
               </p>
               <p class="mt-1 truncate text-xs/5 text-base-content/70">
                  {{ $cliente->email }}
               </p>
               <p class="mt-0.5 text-xs/5 text-base-content/70">
                  {{ $cliente->telefono }}
               </p>
            </div>
         </div>
         <div class="flex shrink-0 items-center gap-x-6">
            <div class="hidden sm:flex sm:flex-col sm:items-end">
               <p class="text-sm/6 text-base-content">
                  {{ $cliente->negocio->nombre }}
               </p>
               <p class="mt-1 text-xs/5 text-base-content/70">
                  {{ $cliente->reservas->count() }} reserva{{ $cliente->reservas->count() !== 1 ? 's' : '' }}
               </p>
            </div>
            <div class="flex gap-2">
               <a href="{{ route('cliente', ['id' => $cliente->uuid]) }}">
                  <button type="button" class="lg:block hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
                     Editar
                  </button>
               </a>
               <button type="button" onclick="eliminarCliente('{{ $cliente->uuid }}')" class="lg:block hidden rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-xs inset-ring inset-ring-red-300 hover:bg-red-100">
                  Eliminar
               </button>
            </div>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="px-4 text-base-content/70">
         No tienes ningún cliente registrado
      </div>
   </li>
@endif

<script>
   function eliminarCliente(uuid) {
      if (!confirm('¿Estás seguro de que deseas eliminar este cliente?')) return;

      $.ajax({
         type: "DELETE",
         url: `/api/v1/cliente/${uuid}`,
         headers: {
            "Authorization": "Bearer " + localStorage.getItem('token'),
            "Accept": "application/json"
         },
         success: function(r) {
            llamadaLista();
         },
         error: function(e) {
            console.log(e.responseJSON);
            alert('Error al eliminar el cliente');
         }
      });
   }

   function editarCliente(uuid) {
      // Por ahora solo mostramos un mensaje, puedes implementar un modal de edición
      alert('Función de edición en desarrollo');
   }
</script>

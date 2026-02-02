@extends('components.html.plantilla.center')

@section('contenido')
   <section class="bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
      <div class="flex items-start gap-5">
         <div class="icono">
            <div class="bg-indigo-500 rounded-full size-15 flex items-center justify-center text-white text-2xl font-bold">
               {{ strtoupper(substr($cliente->nombre, 0, 1)) }}{{ strtoupper(substr($cliente->apellido, 0, 1)) }}
            </div>
         </div>

         <div class="caja">
            <h1 class="text-md font-light">
               Información del cliente
            </h1>

            <p class="text-xl font-medium">
               {{ $cliente->nombre . ' ' . $cliente->apellido }}
            </p>

            <div class="mt-2 space-y-1">
               <p class="text-sm text-base-content/70">
                  <span class="font-medium">Email:</span> {{ $cliente->email }}
               </p>
               <p class="text-sm text-base-content/70">
                  <span class="font-medium">Teléfono:</span> {{ $cliente->telefono }}
               </p>
               <p class="text-sm text-base-content/70">
                  <span class="font-medium">Negocio:</span> {{ $cliente->negocio->nombre }}
               </p>
            </div>
         </div>
      </div>

      <button command="show-modal" commandfor="drawer_editar_cliente" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
         Editar cliente
      </button>
   </section>

   <section class="grid lg:grid-cols-12 grid-cols-1 items-start gap-3">

      <!-- Estadísticas -->
      <section class="col-span-full grid lg:grid-cols-4 grid-cols-1 gap-3">

         <!-- Reservas completadas -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas completadas
            </span>
            <span id="reservas_completadas" class="font-medium text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Reservas este mes -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Reservas este mes
            </span>
            <span id="reservas_este_mes" class="font-medium text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Gasto total -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Gasto total
            </span>
            <span id="gasto_total" class="font-medium text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>

         <!-- Última reserva -->
         <div class="flex flex-col gap-0.5 bg-base-100 rounded-md p-4 border border-base-content/10">
            <span class="font-normal text-sm text-base-content/70">
               Última reserva
            </span>
            <span id="ultima_reserva" class="font-medium text-xl">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </div>
      </section>

      <!-- Gráfica de reservas -->
      <section class="lg:col-span-6 col-span-full">
         <div class="bg-base-100 border border-base-content/10 rounded-md">
            <div class="p-4 border-b border-base-content/10">
               <span class="font-medium text-md">
                  Reservas por mes
               </span>
            </div>
            <div class="p-4">
               <canvas id="grafica_reservas" height="200"></canvas>
            </div>
         </div>
      </section>

      <!-- Estado de reservas -->
      <section class="lg:col-span-6 col-span-full">
         <div class="bg-base-100 border border-base-content/10 rounded-md">
            <div class="p-4 border-b border-base-content/10">
               <span class="font-medium text-md">
                  Estado de reservas
               </span>
            </div>
            <div class="p-4">
               <canvas id="grafica_estados" height="200"></canvas>
            </div>
         </div>
      </section>

      <!-- Historial de reservas -->
      <section class="col-span-full">
         <div class="bg-base-100 border border-base-content/10 rounded-md">
            <div class="p-4 border-b border-base-content/10">
               <div class="flex items-center justify-between min-h-8">
                  <span class="font-medium text-md">
                     Historial de reservas
                  </span>
               </div>
            </div>

            <div class="material">
               <div class="overflow-x-auto">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Servicio y Fecha</th>
                           <th>Estado</th>
                           <th class="text-end">Precio</th>
                        </tr>
                     </thead>
                     <tbody id="load_lista_reservas">
                        <tr>
                           <td colspan="3" class="text-center py-8">
                              <span class="loading loading-spinner loading-md"></span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </section>

   </section>
@endsection

@section('drawers')
   <el-dialog id="modal_editar_cliente">
      <dialog id="drawer_editar_cliente" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
         <el-dialog-backdrop class="absolute inset-0 bg-base-100/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

         <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
               <div class="relative flex h-full flex-col overflow-y-auto bg-base-100 border-l border-base-content/20 py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                     <div class="flex items-start justify-between">
                        <h2 id="drawer-title" class="text-base font-semibold text-base-content">Editar cliente</h2>
                        <div class="ml-3 flex h-7 items-center">
                           <button type="button" command="close" commandfor="drawer_editar_cliente" class="relative rounded-md text-gray-400 hover:text-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                              <span class="absolute -inset-2.5"></span>
                              <span class="sr-only">Close panel</span>
                              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">

                     <form id="editarCliente" action="{{ route('cliente.update', ['cliente' => $cliente->uuid]) }}" method="PUT" class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                           <div class="mt-2">
                              <input id="nombre" type="text" name="nombre" value="{{ $cliente->nombre }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Apellido -->
                        <div class="lg:col-span-2 col-span-full">
                           <label for="apellido" class="block text-sm/6 font-medium">Apellido</label>
                           <div class="mt-2">
                              <input id="apellido" type="text" name="apellido" value="{{ $cliente->apellido }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Email -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="email" class="block text-sm/6 font-medium">Email</label>
                           <div class="mt-2">
                              <input id="email" type="email" name="email" value="{{ $cliente->email }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="lg:col-span-full col-span-full">
                           <label for="telefono" class="block text-sm/6 font-medium">Teléfono</label>
                           <div class="mt-2">
                              <input id="telefono" type="tel" name="telefono" value="{{ $cliente->telefono }}"
                                 class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <div class="col-span-full mt-6">
                           <button type="submit" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">Actualizar cliente</button>
                        </div>
                     </form>

                     <script>
                        const editarClienteForm = document.getElementById('editarCliente');

                        editarClienteForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(editarClienteForm, {
                              resetForm: false,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: false,
                              reload: true,
                           });
                        });
                     </script>

                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
@endsection

@section('scripts')
   <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

   <script>
      let chartReservas, chartEstados;

      function cargarDatosCliente() {
         let id = "{{ $cliente->uuid }}";
         let url = `/api/v1/cliente/${id}`;

         $.ajax({
            type: "GET",
            url: url,
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            success: function(r) {
               // Actualizar estadísticas
               $('#reservas_completadas').text(r.estadisticas.reservas_completadas);
               $('#reservas_este_mes').text(r.estadisticas.reservas_este_mes);
               $('#gasto_total').html(r.estadisticas.gasto_total + ' <span class="text-base font-normal">€</span>');
               $('#ultima_reserva').text(r.estadisticas.ultima_reserva);

               // Actualizar lista de reservas
               $('#load_lista_reservas').empty().append(r.lista_reservas);

               // Crear gráfica de reservas por mes
               crearGraficaReservas(r.grafica_reservas);

               // Crear gráfica de estados
               crearGraficaEstados(r.estadisticas);
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      function crearGraficaReservas(datos) {
         const ctx = document.getElementById('grafica_reservas');

         if (chartReservas) {
            chartReservas.destroy();
         }

         chartReservas = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: datos.map(d => d.mes),
               datasets: [{
                  label: 'Reservas',
                  data: datos.map(d => d.count),
                  backgroundColor: 'rgba(99, 102, 241, 0.5)',
                  borderColor: 'rgba(99, 102, 241, 1)',
                  borderWidth: 1
               }]
            },
            options: {
               responsive: true,
               maintainAspectRatio: false,
               scales: {
                  y: {
                     beginAtZero: true,
                     ticks: {
                        stepSize: 1
                     }
                  }
               }
            }
         });
      }

      function crearGraficaEstados(estadisticas) {
         const ctx = document.getElementById('grafica_estados');

         if (chartEstados) {
            chartEstados.destroy();
         }

         chartEstados = new Chart(ctx, {
            type: 'doughnut',
            data: {
               labels: ['Completadas', 'Pendientes', 'Canceladas'],
               datasets: [{
                  data: [
                     estadisticas.reservas_completadas,
                     estadisticas.reservas_pendientes,
                     estadisticas.reservas_canceladas
                  ],
                  backgroundColor: [
                     'rgba(34, 197, 94, 0.5)',
                     'rgba(234, 179, 8, 0.5)',
                     'rgba(239, 68, 68, 0.5)'
                  ],
                  borderColor: [
                     'rgba(34, 197, 94, 1)',
                     'rgba(234, 179, 8, 1)',
                     'rgba(239, 68, 68, 1)'
                  ],
                  borderWidth: 1
               }]
            },
            options: {
               responsive: true,
               maintainAspectRatio: false,
               plugins: {
                  legend: {
                     position: 'bottom'
                  }
               }
            }
         });
      }

      window.addEventListener('load', function() {
         cargarDatosCliente();
      });
   </script>
@endsection

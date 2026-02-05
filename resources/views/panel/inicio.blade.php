@extends('components.html.plantilla.fullbody')

@section('contenido')
   <div class="lg:p-4 p-1 space-y-2 max-w-7xl mx-auto">
      <!-- Header -->
      <section class="flex justify-between items-start mb-5">
         <div class="space-y-1 flex-1">
            <h1 class="text-xl font-semibold">
               Bienvenido, {{ Auth::user()->nombre }}
            </h1>
            <p class="text-sm text-base-content/70">
               Resumen de tu actividad y estadísticas
            </p>
         </div>
         <a href="{{ route('reservas') }}" class="lg:block hidden rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
            Nueva reserva
         </a>
      </section>

      <!-- Estadísticas principales -->
      <section class="lg:grid hidden grid-cols-1 lg:grid-cols-3 gap-2">

         <!-- Servicios -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <div class="flex items-center gap-3">
               <div class="p-2 bg-emerald-100 rounded-lg">
                  <svg class="size-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                  </svg>
               </div>
               <div>
                  <p class="text-xl font-medium">{{ $totalServicios }}</p>
                  <p class="text-xs text-base-content/60">Servicios</p>
               </div>
            </div>
         </div>

         <!-- Clientes -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <div class="flex items-center gap-3">
               <div class="p-2 bg-sky-100 rounded-lg">
                  <svg class="size-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                  </svg>
               </div>
               <div>
                  <p class="text-xl font-medium">{{ $totalClientes }}</p>
                  <p class="text-xs text-base-content/60">Clientes</p>
               </div>
            </div>
         </div>

         <!-- Reservas totales -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <div class="flex items-center gap-3">
               <div class="p-2 bg-rose-100 rounded-lg">
                  <svg class="size-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                  </svg>
               </div>
               <div>
                  <p class="text-xl font-medium">{{ $totalReservas }}</p>
                  <p class="text-xs text-base-content/60">Reservas totales</p>
               </div>
            </div>
         </div>
      </section>

      <!-- Resumen de reservas (tiempo) -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-2">
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4 flex items-center justify-between">
            <div>
               <p class="text-sm text-base-content/60">Reservas hoy</p>
               <p class="text-xl font-medium text-indigo-600">{{ $reservasHoy }}</p>
            </div>
            <div class="p-3 bg-indigo-50 rounded-full">
               <svg class="size-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
            </div>
         </div>

         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4 flex items-center justify-between">
            <div>
               <p class="text-sm text-base-content/60">Esta semana</p>
               <p class="text-xl font-medium text-emerald-600">{{ $reservasSemana }}</p>
            </div>
            <div class="p-3 bg-emerald-50 rounded-full">
               <svg class="size-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
               </svg>
            </div>
         </div>

         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4 flex items-center justify-between">
            <div>
               <p class="text-sm text-base-content/60">Este mes</p>
               <p class="text-xl font-medium text-amber-600">{{ $reservasMes }}</p>
            </div>
            <div class="p-3 bg-amber-50 rounded-full">
               <svg class="size-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                     d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
               </svg>
            </div>
         </div>
      </section>

      <!-- Gráfico y estado de reservas -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-2">
         <!-- Gráfico de reservas por día -->
         <div class="lg:col-span-2 bg-base-100 rounded-xl border border-base-content/10 p-4">
            <h3 class="text-sm font-semibold mb-4">Reservas esta semana</h3>
            <div id="chart-reservas-semana"></div>
         </div>

         <!-- Estado de reservas -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <h3 class="text-sm font-semibold mb-4">Estado de reservas</h3>
            <div class="space-y-4">
               <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                     <span class="size-3 rounded-full bg-amber-500"></span>
                     <span class="text-sm">Pendientes</span>
                  </div>
                  <span class="text-sm font-semibold">{{ $reservasPendientes }}</span>
               </div>
               <div class="w-full bg-base-200 rounded-full h-2">
                  <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $totalReservas > 0 ? ($reservasPendientes / $totalReservas) * 100 : 0 }}%"></div>
               </div>

               <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                     <span class="size-3 rounded-full bg-sky-500"></span>
                     <span class="text-sm">Confirmadas</span>
                  </div>
                  <span class="text-sm font-semibold">{{ $reservasConfirmadas }}</span>
               </div>
               <div class="w-full bg-base-200 rounded-full h-2">
                  <div class="bg-sky-500 h-2 rounded-full" style="width: {{ $totalReservas > 0 ? ($reservasConfirmadas / $totalReservas) * 100 : 0 }}%"></div>
               </div>

               <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                     <span class="size-3 rounded-full bg-emerald-500"></span>
                     <span class="text-sm">Completadas</span>
                  </div>
                  <span class="text-sm font-semibold">{{ $reservasCompletadas }}</span>
               </div>
               <div class="w-full bg-base-200 rounded-full h-2">
                  <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $totalReservas > 0 ? ($reservasCompletadas / $totalReservas) * 100 : 0 }}%"></div>
               </div>
            </div>

            @if ($ingresosMes > 0)
               <div class="mt-6 pt-4 border-t border-base-content/10">
                  <p class="text-xs text-base-content/60">Ingresos este mes</p>
                  <p class="text-xl font-medium text-emerald-600">{{ number_format($ingresosMes, 2) }} &euro;</p>
               </div>
            @endif
         </div>
      </section>

      <!-- Próximas reservas y clientes recientes -->
      <section class="grid items-start grid-cols-1 lg:grid-cols-2 gap-4">
         <!-- Próximas reservas -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <div class="flex items-center justify-between mb-4">
               <h3 class="text-sm font-semibold">Próximas reservas</h3>
               <a href="{{ route('reservas') }}" class="text-xs text-indigo-600 hover:text-indigo-500">Ver todas</a>
            </div>

            @if ($proximasReservas->count() > 0)
               <ul class="divide-y divide-base-content/10">
                  @foreach ($proximasReservas as $reserva)
                     <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                           <div class="size-10 rounded-full bg-indigo-100 flex items-center justify-center">
                              <span class="text-sm font-semibold text-indigo-600">
                                 {{ strtoupper(substr($reserva->cliente->nombre ?? 'N', 0, 1)) }}{{ strtoupper(substr($reserva->cliente->apellido ?? 'A', 0, 1)) }}
                              </span>
                           </div>
                           <div>
                              <p class="text-sm font-medium">{{ $reserva->cliente->nombre ?? 'Sin nombre' }} {{ $reserva->cliente->apellido ?? '' }}</p>
                              <p class="text-xs text-base-content/60">{{ $reserva->servicio->nombre ?? 'Servicio' }}</p>
                           </div>
                        </div>
                        <div class="text-right">
                           <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($reserva->fecha)->format('d M') }}</p>
                           <p class="text-xs text-base-content/60">{{ \Carbon\Carbon::parse($reserva->fecha)->format('H:i') }}</p>
                        </div>
                     </li>
                  @endforeach
               </ul>
            @else
               <div class="py-8 text-center">
                  <svg class="size-12 mx-auto text-base-content/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                  </svg>
                  <p class="mt-2 text-sm text-base-content/60">No hay reservas próximas</p>
                  <a href="{{ route('reservas') }}" class="mt-2 inline-block text-sm text-indigo-600 hover:text-indigo-500">Crear una reserva</a>
               </div>
            @endif
         </div>

         <!-- Clientes recientes -->
         <div class="bg-base-100 rounded-xl border border-base-content/10 p-4">
            <div class="flex items-center justify-between mb-4">
               <h3 class="text-sm font-semibold">Clientes recientes</h3>
               <a href="{{ route('clientes') }}" class="text-xs text-indigo-600 hover:text-indigo-500">Ver todos</a>
            </div>

            @if ($clientesRecientes->count() > 0)
               <ul class="divide-y divide-base-content/10">
                  @foreach ($clientesRecientes as $cliente)
                     <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                           <div class="size-10 rounded-full bg-sky-100 flex items-center justify-center">
                              <span class="text-sm font-semibold text-sky-600">
                                 {{ strtoupper(substr($cliente->nombre ?? 'N', 0, 1)) }}{{ strtoupper(substr($cliente->apellido ?? 'A', 0, 1)) }}
                              </span>
                           </div>
                           <div>
                              <p class="text-sm font-medium">{{ $cliente->nombre }} {{ $cliente->apellido }}</p>
                              <p class="text-xs text-base-content/60">{{ $cliente->email ?? ($cliente->telefono ?? 'Sin contacto') }}</p>
                           </div>
                        </div>
                        <div class="text-right">
                           <span class="text-xs px-2 py-1 rounded-full bg-base-200 text-base-content/70">
                              {{ $cliente->negocio->nombre ?? 'Sin negocio' }}
                           </span>
                        </div>
                     </li>
                  @endforeach
               </ul>
            @else
               <div class="py-8 text-center">
                  <svg class="size-12 mx-auto text-base-content/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                  </svg>
                  <p class="mt-2 text-sm text-base-content/60">No hay clientes registrados</p>
                  <a href="{{ route('clientes') }}" class="mt-2 inline-block text-sm text-indigo-600 hover:text-indigo-500">Añadir cliente</a>
               </div>
            @endif
         </div>
      </section>

   </div>
@endsection

@section('scripts')
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         // Datos de reservas por día
         const reservasPorDia = @json($reservasPorDia);
         const diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

         // Configuración del gráfico
         const options = {
            series: [{
               name: 'Reservas',
               data: reservasPorDia
            }],
            chart: {
               type: 'bar',
               height: 250,
               toolbar: {
                  show: false
               },
               fontFamily: 'inherit'
            },
            plotOptions: {
               bar: {
                  borderRadius: 6,
                  columnWidth: '50%',
               }
            },
            dataLabels: {
               enabled: false
            },
            xaxis: {
               categories: diasSemana,
               axisBorder: {
                  show: false
               },
               axisTicks: {
                  show: false
               }
            },
            yaxis: {
               labels: {
                  formatter: function(val) {
                     return Math.floor(val);
                  }
               }
            },
            fill: {
               colors: ['#4f46e5']
            },
            grid: {
               borderColor: '#e5e7eb',
               strokeDashArray: 4,
            },
            tooltip: {
               y: {
                  formatter: function(val) {
                     return val + ' reservas';
                  }
               }
            }
         };

         const chart = new ApexCharts(document.querySelector("#chart-reservas-semana"), options);
         chart.render();
      });
   </script>
@endsection

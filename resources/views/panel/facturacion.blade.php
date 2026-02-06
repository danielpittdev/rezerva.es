@extends('components.html.plantilla.center')

@section('contenido')
   <section class="py-4 flex justify-between items-start">
      <div class="caja space-y-2">
         <h1 class="text-xl font-medium">
            Facturación
         </h1>

         <p class="text-xs text-base-content/70">
            Controla las facturas que se han generado
         </p>
      </div>
   </section>

   <section class="grid lg:grid-cols-3 items-center gap-3">
      <!-- aa -->
      <div class="p-4 bg-base-100 rounded-lg border border-base-content/10">
         <small class="flex flex-col gap-1">
            <span class="text-base-content/70">Actual:</span>
            <span class="font-medium text-lg" id="sld_diario">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </small>
      </div>

      <!-- aa -->
      <div class="p-4 bg-base-100 rounded-lg border border-base-content/10">
         <small class="flex flex-col gap-1">
            <span class="text-base-content/70">Semanal:</span>
            <span class="font-medium text-lg" id="sld_semanal">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </small>
      </div>

      <!-- aa -->
      <div class="p-4 bg-base-100 rounded-lg border border-base-content/10">
         <small class="flex flex-col gap-1">
            <span class="text-base-content/70">Mensual:</span>
            <span class="font-medium text-lg" id="sld_mensual">
               <span class="loading loading-spinner loading-sm"></span>
            </span>
         </small>
      </div>
   </section>

   <section class="sec">
      <div class="mb-3">
         <h2 class="text-lg font-medium">Facturas</h2>
      </div>
      <ul id="load_lista_facturas" role="list" class="divide-y divide-base-content/10 border border-base-content/10 rounded-lg bg-base-100">
         <li class="flex py-8">
            <span class="mx-auto loading loading-spinner loading-md"></span>
         </li>
      </ul>
   </section>

   <section class="sec">
      <div class="mb-3 flex items-center justify-between">
         <div>
            <h2 class="text-lg font-medium">Pagos online</h2>
            <p class="text-xs text-base-content/70">Reservas pagadas a través de Stripe</p>
         </div>
         <div class="flex items-center gap-3">
            <span id="pagos_online_count" class="text-sm text-base-content/70">
               <span class="loading loading-spinner loading-xs"></span>
            </span>
            <button onclick="abrirStripeDashboard()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
               Ver en Stripe
            </button>
         </div>
      </div>
      <ul id="load_pagos_online" role="list" class="divide-y divide-base-content/10 border border-base-content/10 rounded-lg bg-base-100">
         <li class="flex py-8">
            <span class="mx-auto loading loading-spinner loading-md"></span>
         </li>
      </ul>
   </section>

   <section class="sec">
      <div class="mb-3">
         <h2 class="text-lg font-medium">Reservas completadas</h2>
         <p class="text-xs text-base-content/70">Historial de reservas que han sido finalizadas (sin pago online)</p>
      </div>
      <ul id="load_reservas_completadas" role="list" class="divide-y divide-base-content/10 border border-base-content/10 rounded-lg bg-base-100">
         <li class="flex py-8">
            <span class="mx-auto loading loading-spinner loading-md"></span>
         </li>
      </ul>
   </section>
@endsection

@section('scripts')
   <script>
      function llamadaLista() {
         $.ajax({
            type: "GET",
            url: "{{ route('factura.index') }}",
            headers: {
               "Authorization": "Bearer " + localStorage.getItem('token'),
               "Accept": "application/json"
            },
            data: {
               "lista": true
            },
            beforeSend: function() {
               $('#load_lista_facturas').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
               $('#load_reservas_completadas').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
               $('#load_pagos_online').empty().append(`
                  <li class="flex py-8">
                     <span class="mx-auto loading loading-spinner loading-md"></span>
                  </li>
               `)
            },
            success: function(r) {
               $('#load_lista_facturas').empty().append(r.html.lista);
               $('#load_reservas_completadas').empty().append(r.html.reservas_completadas);
               $('#load_pagos_online').empty().append(r.html.pagos_online);
               $('#pagos_online_count').text(r.pagos_online_count + ' pagos');
               $('#sld_diario').text(r.resumen.diario)
               $('#sld_semanal').text(r.resumen.semanal)
               $('#sld_mensual').text(r.resumen.mensual)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      async function abrirStripeDashboard() {
         try {
            // Obtener el primer negocio con Stripe Connect
            const response = await axios.get("{{ route('factura.index') }}", {
               headers: {
                  "Authorization": "Bearer " + localStorage.getItem('token'),
                  "Accept": "application/json"
               }
            });

            if (response.data.stripe_dashboard_url) {
               window.open(response.data.stripe_dashboard_url, '_blank');
            } else {
               alert('No hay cuenta de Stripe conectada');
            }
         } catch (error) {
            console.error('Error:', error);
            alert('Error al abrir el dashboard de Stripe');
         }
      }

      document.addEventListener('DOMContentLoaded', function() {
         llamadaLista()
      });
   </script>
@endsection

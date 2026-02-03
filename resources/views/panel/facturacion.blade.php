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
      <ul id="load_lista_facturas" role="list" class="divide-y divide-base-content/10 border border-base-content/10 rounded-lg bg-base-100">
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
            },
            success: function(r) {
               $('#load_lista_facturas').empty().append(r.html.lista);
               $('#sld_diario').text(r.resumen.diario)
               $('#sld_semanal').text(r.resumen.semanal)
               $('#sld_mensual').text(r.resumen.mensual)
            },
            error: function(e) {
               console.log(e.responseJSON);
            }
         });
      }

      document.addEventListener('DOMContentLoaded', function() {
         // document.getElementById('modal_o').show()
         llamadaLista()
      });
   </script>
@endsection

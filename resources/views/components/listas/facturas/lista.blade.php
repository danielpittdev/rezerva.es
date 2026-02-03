@if ($facturas->count() > 0)
   @foreach ($facturas as $factura)
      <li class="flex items-center justify-between gap-x-6 p-3 px-5">
         <!-- Datos -->
         <div class="caja">
            <span class="text-base-content/70">
               {{ number_format($factura->entrante, 2, ',', '.') }}
            </span>
         </div>

         <!-- Datos -->
         <div class="caja">
            <span class="text-base-content/70">
               {{ number_format($factura->comision, 2, ',', '.') }}
            </span>
         </div>

         <!-- Datos -->
         <div class="caja">
            <span class="text-base-content/70">
               {{ number_format($factura->total, 2, ',', '.') }}
            </span>
         </div>

         <!-- Datos -->
         <div class="caja">
            <span class="text-base-content/70">
               {{ $factura->negocio_data['nombre'] ?? 'No encontrado' }}
            </span>
         </div>

         <!-- Datos -->
         <div class="caja">
            <span class="text-base-content/70">
               {{ $factura->negocio_data['nombre'] ?? 'No encontrado' }}
            </span>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 p-3">
      <div class="min-w-0">
         <div class="mt-1 flex items-center gap-x-2">
            <p class="truncate">No hay</p>
         </div>
      </div>
   </li>
@endif

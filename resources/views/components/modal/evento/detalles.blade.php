<div class="caja">
   <h6 class="font-medium">
      Información del ticket
   </h6>

   <small class="text-base-content/60">
      Edite la información de la entrada acontinuación
   </small>
</div>

<div class="grid grid-cols-[auto_1fr] gap-8">
   <!-- aaa -->
   <div class="caja space-y-1">
      <div class="lista">
         <ul class="space-y-3">
            <li>
               <div class="caja">
                  <div class="info">
                     <h6 class="font-medium text-sm">
                        Datos cliente
                     </h6>
                  </div>
                  <span class="text-sm text-base-content/70">{{ ucfirst($reserva->cliente->nombre) . ' ' . ucfirst($reserva->cliente->apellido) }}</span>
               </div>
            </li>
            <li>
               <div class="caja">
                  <div class="info">
                     <h6 class="font-medium text-sm">
                        Correo electrónico
                     </h6>
                  </div>
                  <span class="text-sm text-base-content/70">{{ $reserva->cliente->email }}</span>
               </div>
            </li>
            <li>
               <div class="caja">
                  <div class="info">
                     <h6 class="font-medium text-sm">
                        Teléfono
                     </h6>
                  </div>
                  <span class="text-sm text-base-content/70">{{ $reserva->cliente->telefono ?? 'Sin teléfono' }}</span>
               </div>
            </li>
         </ul>
      </div>
   </div>

   <!-- aaa -->
   <div class="caja space-y-1">
      <div class="lista">
         <ul class="space-y-3">
            <li>
               <div class="caja">
                  <div class="info">
                     <h6 class="font-medium text-sm">
                        Precio de entrada
                     </h6>
                  </div>
                  <span class="text-sm text-base-content/70">
                     {{ number_format($reserva->evento->precio, 2, ',', '.') }}
                  </span>
               </div>
            </li>
            <li>
               <div class="caja">
                  <div class="info">
                     <h6 class="font-medium text-sm">
                        Total gastado
                     </h6>
                  </div>
                  <span class="text-sm text-base-content/70">
                     @php
                        $relacionados = $reserva->relacionados()->sum('total');
                     @endphp
                     {{ number_format($relacionados + $reserva->total * $reserva->cantidad, 2, ',', '.') }}
                  </span>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>

<!-- aaa -->
<div class="caja mt-7">
   <button type="button" target="doda93" class="fn_alertar_usuario rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
      Enviar aviso
   </button>

   <button type="button" target="doda93" class="fn_emitir_rembolso rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400">
      Emitir reembolso
   </button>
</div>

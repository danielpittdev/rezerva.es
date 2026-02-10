<div class="space-y-3">
   <h3 id="dialog-title" class="text-base font-semibold text-gray-900">{{ $reserva->cliente->nombre . ' ' . $reserva->cliente->apellido }}</h3>

   <div class="px-0">
      <ul>
         <li>
            <small>
               Email: {{ $reserva->cliente->email }}
            </small>
         </li>

         <li>
            <small>
               Teléfono: {{ $reserva->cliente->telefono ?? 'No proporcionado' }}
            </small>
         </li>
      </ul>
   </div>

   <div class="mt-2">
      @if ($relacionados->count() > 0)
         <div class="border border-base-content/15 rounded-box">
            <div class="py-2 px-3 border-b border-base-content/15">
               <h6 class="font-medium text-sm">
                  Compras simultáneas
               </h6>
            </div>

            <div class="px-2">
               <ul role="list" class="divide-y divide-gray-100">

                  @foreach ($relacionados as $relacion)
                     <li class="flex items-center justify-between gap-x-6 py-2">
                        <div class="min-w-0">
                           <div class="flex items-start gap-x-3">
                              <p class="text-sm/6 font-semibold text-gray-900">{{ Carbon\Carbon::parse($relacion->created_at)->translatedFormat('l d M') }}</p>

                              @if ($relacion->pagado)
                                 <p class="mt-0.5 rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 inset-ring inset-ring-yellow-600/20">Pagado</p>
                              @endif
                           </div>
                           <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                              <p class="truncate">{{ $relacion->metodo_pago }}</p>
                           </div>
                        </div>
                        <div class="caja text-sm">
                           {{ number_format($relacion->total, 2, ',', '.') }}
                        </div>
                     </li>
                  @endforeach

               </ul>
            </div>
         </div>
      @endif
   </div>

   <div class="caja">
      <small>
         Total:
      </small>
      <h6 class="font-medium">
         {{ number_format($reserva->total + $relacionados->sum('total'), 2, ',', '.') }}
      </h6>
   </div>

</div>

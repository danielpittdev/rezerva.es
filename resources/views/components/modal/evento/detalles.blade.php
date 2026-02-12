<div class="caja mb-5">
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
                        $todasReservas = collect([$reserva])->merge($relacionados);
                        $totalGastado = $todasReservas->sum('total');
                     @endphp
                     {{ number_format($totalGastado, 2, ',', '.') }}
                  </span>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>

<!-- Entradas del cliente -->
@if ($relacionados->count() > 0)
   <div class="caja mt-7">
      <h6 class="font-medium text-sm mb-3">
         Entradas de este cliente ({{ $relacionados->count() + 1 }})
      </h6>
      <ul class="divide-y divide-base-content/10 rounded-md border border-base-content/10">
         @foreach (collect([$reserva])->merge($relacionados) as $entrada)
            <li class="flex items-center justify-between px-3 py-2.5">
               <div class="flex items-center gap-x-3">
                  <span class="text-sm text-base-content/80">{{ $entrada->cantidad }} {{ $entrada->cantidad == 1 ? 'entrada' : 'entradas' }}</span>
                  <span class="text-xs text-base-content/50">{{ $entrada->created_at->format('d/m/Y H:i') }}</span>
               </div>
               <div class="flex items-center gap-x-2">
                  <span class="flex-none rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">
                     {{ ucfirst($entrada->metodo_pago) }}
                  </span>
                  <span class="text-sm font-medium text-base-content/80">
                     {{ number_format($entrada->total, 2, ',', '.') }}
                  </span>
               </div>
            </li>
         @endforeach
      </ul>
   </div>
@endif

<!-- Acciones -->
<div class="caja mt-7">
   <button type="button" class="fn_alertar_usuario rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
      Enviar aviso
   </button>

   <button type="button" data-negocio="{{ $reserva->evento->negocio_id }}" class="fn_emitir_rembolso rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400">
      Consultar en Stripe
   </button>
</div>

<!-- Formulario email individual -->
<div class="fn_form_email hidden mt-5">
   <form class="formEmailIndividual" action="{{ route('evento.avisar.individual') }}" method="POST" class="space-y-3">
      @csrf
      <input type="hidden" name="reserva" value="{{ $reserva->uuid }}">

      <div>
         <label for="asunto_individual" class="block text-sm/6 font-medium">Asunto</label>
         <div class="mt-2">
            <input id="asunto_individual" type="text" name="asunto" maxlength="100" placeholder="Asunto del correo"
               class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
         </div>
      </div>

      <div class="mt-3">
         <label for="cuerpo_individual" class="block text-sm/6 font-medium">Mensaje</label>
         <div class="mt-2">
            <textarea id="cuerpo_individual" name="cuerpo" maxlength="1000" rows="4" placeholder="Escribe tu mensaje..."
               class="block w-full rounded-md px-3 py-1.5 bg-base-200 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
         </div>
      </div>

      <div class="mt-4 flex justify-end gap-2">
         <button type="button" class="fn_cancelar_email rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">
            Cancelar
         </button>
         <button type="submit" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
            Enviar correo
         </button>
      </div>
   </form>
</div>

@extends('components.html.plantilla.center')

@section('contenido')
   <section class="grid gap-2 lg:grid-cols-2 grid-rows-[auto_1fr]">

      <!-- barra superior -->
      <section class="col-span-2 row-span-1 bg-base-100 p-5 border border-base-content/10 rounded-md flex justify-between items-start">
         <div class="flex items-center gap-5">

            <div class="caja">
               <h1 class="text-md font-medium">
                  Información de la reserva
               </h1>
            </div>
         </div>
      </section>

      <!-- secciones -->
      <section class="col-span-2 grid lg:grid-cols-[.4fr_1fr] grid-cols-1 items-start gap-2">

         <!-- Izquierda -->
         <section class="col-span-1 lg:col-span-auto space-y-2">
            <!-- Servicios -->
            <div class="min-w-[330px] bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
               <div class="p-4 border-b border-base-content/10">
                  <div class="flex items-center justify-between min-h-8">
                     <span class="font-medium text-md">
                        Edición de reserva
                     </span>
                  </div>
               </div>

               <div class="material p-4">
                  <div class="overflow-x-auto">
                     <form id="reserva_actualizar" action="{{ route('reserva.update', ['reserva' => $reserva->uuid]) }}" method="POST" class="space-y-3 grid lg:grid-cols-4 grid-cols-1 gap-3">
                        @csrf
                        @method('PUT')

                        <!-- Estado -->
                        <div class="lg:col-span-full col-span-1">
                           <label for="estado" class="block text-sm/6 font-medium">Estado</label>
                           <div class="mt-2">
                              <el-select id="estado" name="estado" value="{{ $reserva->estado }}" class="mt-2 block">
                                 <button type="button"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6"></el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    @php
                                       $estados = ['pendiente', 'confirmado', 'cancelado', 'completado'];
                                    @endphp

                                    @foreach ($estados as $estado)
                                       <el-option value="{{ $estado }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <div class="flex gap-2 items-center">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($estado) }}</span>
                                          </div>
                                          <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                             <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                             </svg>
                                          </span>
                                       </el-option>
                                    @endforeach
                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <!-- Fecha -->
                        <div class="lg:col-span-full col-span-1">
                           <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>
                           <div class="mt-2">
                              <input id="fecha" type="datetime-local" name="fecha" autocomplete="fecha" value="{{ Carbon\Carbon::parse($reserva->fecha)->translatedFormat('Y-m-d H:i') }}"
                                 class="block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/20 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <!-- Empleados -->
                        <div class="lg:col-span-full col-span-1">
                           <label for="empleado_id" class="block text-sm/6 font-medium">Empleado</label>
                           <div class="mt-2">
                              <el-select id="empleado_id" name="empleado_id" value="{{ $reserva->empleado_id }}" class="mt-2 block">
                                 <button type="button"
                                    class="grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/20 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                    <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6"></el-selectedcontent>
                                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                       <path
                                          d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                 </button>

                                 <el-options anchor="bottom start" popover
                                    class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                    <el-option value="" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <div class="flex gap-2 items-center">
                                          <span class="block truncate font-normal group-aria-selected/option:font-semibold">Ninguno</span>
                                       </div>
                                       <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                          <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                             <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                          </svg>
                                       </span>
                                    </el-option>

                                    @foreach ($reserva->negocio->empleados as $empleado)
                                       <el-option value="{{ $empleado->id }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                          <div class="flex gap-2 items-center">
                                             <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($empleado->nombre) }}</span>
                                          </div>
                                          <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                                             <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                                <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                                             </svg>
                                          </span>
                                       </el-option>
                                    @endforeach
                                 </el-options>
                              </el-select>
                           </div>
                        </div>

                        <div class="col-span-full mt-5">
                           <button type="submit" class="text-base-100 flex justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Actualizar</button>
                        </div>
                     </form>

                     <script>
                        const reserva_actualizarForm = document.getElementById('reserva_actualizar');

                        reserva_actualizarForm.addEventListener('submit', (e) => {
                           e.preventDefault();
                           peticion(reserva_actualizarForm, {
                              resetForm: false,
                              highlightInputs: true,
                              showAlert: false,
                              reciclar: true,
                           });
                        });
                     </script>
                  </div>
               </div>
            </div>

            <!-- Generar link de pago presencial -->
            <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full divide-y divide-base-content/10">

               <div class="caja space-y-1 p-4">
                  <h2 class="font-medium text-md">
                     Link de pago
                  </h2>
                  <small class="text-base-content/70">
                     Crea un enlace de pago presencial para que tu cliente pueda pagarte.
                  </small>
               </div>

               <div class="caja p-4 space-y-4">
                  @if($reserva->pagado)
                     <div class="flex items-center gap-2 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Pagado</span>
                     </div>
                  @else
                     @if($reserva->servicio->negocio->stripe_account_id)
                        <button id="btn-generar-qr" class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-600">
                           Generar QR de pago
                        </button>

                        <!-- Contenedor del QR -->
                        <div id="qr-container" class="hidden">
                           <div class="flex flex-col items-center gap-3">
                              <img id="qr-image" src="" alt="QR de pago" class="w-48 h-48 border rounded-md" />
                              <p class="text-sm text-base-content/70">Escanea para pagar {{ number_format($reserva->servicio->precio, 2) }} {{ $reserva->servicio->negocio->moneda ?? 'EUR' }}</p>
                              <a id="qr-link" href="" target="_blank" class="text-indigo-500 hover:text-indigo-600 text-sm underline">
                                 Abrir enlace de pago
                              </a>
                           </div>
                        </div>

                        <script>
                           document.getElementById('btn-generar-qr').addEventListener('click', async function() {
                              const btn = this;
                              btn.disabled = true;
                              btn.textContent = 'Generando...';

                              try {
                                 const response = await fetch('{{ route('pago.checkout.create', ['reserva' => $reserva->uuid]) }}', {
                                    method: 'POST',
                                    headers: {
                                       'Content-Type': 'application/json',
                                       'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                       'Accept': 'application/json'
                                    }
                                 });

                                 const data = await response.json();

                                 if (data.checkout_url) {
                                    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(data.checkout_url)}`;
                                    document.getElementById('qr-image').src = qrUrl;
                                    document.getElementById('qr-link').href = data.checkout_url;
                                    document.getElementById('qr-container').classList.remove('hidden');
                                    btn.textContent = 'Regenerar QR';
                                 } else {
                                    alert(data.error || 'Error al generar el enlace de pago');
                                    btn.textContent = 'Generar QR de pago';
                                 }
                              } catch (error) {
                                 console.error('Error:', error);
                                 alert('Error al generar el enlace de pago');
                                 btn.textContent = 'Generar QR de pago';
                              }

                              btn.disabled = false;
                           });
                        </script>
                     @else
                        <p class="text-sm text-amber-600">
                           El negocio no tiene Stripe Connect configurado. Configura los pagos en los ajustes del negocio.
                        </p>
                     @endif
                  @endif
               </div>

            </div>
         </section>

         <!-- Derecha -->
         <section class="lg:col-span-1 col-span-full space-y-2">
            <!-- Datos del cliente -->
            <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 col-span-full">
               <div class="p-4 border-b border-base-content/10">
                  <div class="flex items-center justify-between min-h-8">
                     <span class="font-medium text-md">
                        Datos del cliente
                     </span>
                  </div>
               </div>

               <div class="material">
                  <div class="overflow-x-auto">

                     <ul role="list" id="load_datos_cliente" class="divide-y divide-gray-100">
                        <li class="flex items-center justify-between gap-x-6 p-5">
                           <div class="min-w-0">
                              <div class="flex items-start gap-x-3">
                                 <p class="text-sm/6 font-semibold text-gray-900">{{ $reserva->cliente->nombre . ' ' . $reserva->cliente->apellido }}</p>
                              </div>
                              <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                                 <p class="whitespace-nowrap">{{ $reserva->cliente->email ?? 'Sin email' }}</p>
                                 <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                                    <circle r="1" cx="1" cy="1" />
                                 </svg>
                                 <p class="truncate">{{ $reserva->cliente->telefono ?? 'Sin teléfono' }}</p>
                              </div>
                           </div>
                           <div class="flex flex-none items-center gap-x-4">
                              <a href="{{ route('cliente', ['id' => $reserva->cliente->uuid]) }}" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">Ver cliente<span class="sr-only">,
                                    {{ $reserva->cliente->nombre }}</span></a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>

            <!-- Preguntas -->
            <div class="bg-base-100 border border-base-content/10 rounded-md lg:col-span-6 lg:col-start-7 row-start-2 col-span-full">
               <div class="p-4 border-b border-base-content/10">
                  <div class="flex items-center justify-between min-h-8">
                     <div class="caja">
                        <h2 class="font-medium text-md">
                           Notas
                        </h2>
                        <small class="text-base-content/70">Consulta las preguntas de tu cliente</small>
                     </div>
                  </div>
               </div>

               <div class="material">
                  <div class="p-4">
                     @if ($reserva->nota)
                        {{ $reserva->nota }}
                     @else
                        <small class="text-base-content/70">No hay ninguna nota añadida en esta reserva.</small>
                     @endif
                  </div>
               </div>
            </div>
         </section>

      </section>

   </section>
@endsection


@section('scripts')
@endsection

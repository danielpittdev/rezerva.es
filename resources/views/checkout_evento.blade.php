@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] lg:pt-10 pb-30">
      <div class="relative lg:border border-base-content/10 shadow bg-base-100 mx-auto xl:max-w-3xl lg:max-w-2xl lg:rounded-3xl overflow-hidden">

         <!-- Cabecera del evento -->
         <div class="border-b border-base-content/10 bg-gradient-to-b from-indigo-50/50 to-base-100 px-6 pt-6 pb-5">
            <div class="flex items-start justify-between gap-4">
               <div class="space-y-1">
                  <h1 class="text-xl font-semibold text-base-content">
                     {{ $evento->nombre }}
                  </h1>
                  <p class="text-sm text-base-content/60 max-w-md">
                     {{ $evento->descripcion }}
                  </p>
               </div>
               <div class="shrink-0 rounded-lg bg-indigo-600 px-3 py-1.5">
                  <span class="text-sm font-semibold text-white">{{ number_format($evento->precio, 2, ',', '.') }}€</span>
               </div>
            </div>
         </div>

         <!-- Cuerpo -->
         <div class="px-5 py-6 sm:px-6">
            <form id="crearEventoForm" action="{{ route('api.evento.store') }}">
               @csrf
               <input type="text" hidden name="evento" value="{{ $evento->uuid }}">

               <!-- Avisos -->
               <div class="space-y-3 mb-6">
                  <div class="rounded-lg bg-amber-50 border border-amber-200 p-3.5">
                     <div class="flex gap-3">
                        <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5 shrink-0 text-amber-500 mt-0.5">
                           <path d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                              clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                        <div>
                           <p class="text-sm font-medium text-amber-800">Antes de continuar</p>
                           <p class="mt-1 text-sm text-amber-700">
                              Revisa muy bien los datos del evento antes de adquirir una entrada o pase. Las entradas no son reembolsables, debes hablar con el comerciante en caso de que haya algún problema.
                           </p>
                        </div>
                     </div>
                  </div>

                  @if ($evento->max_compra > 0)
                     <div class="rounded-lg bg-blue-50 border border-blue-200 p-3.5">
                        <div class="flex gap-3">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 shrink-0 text-blue-500 mt-0.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                           </svg>
                           <div>
                              <p class="text-sm font-medium text-blue-800">Plazas limitadas</p>
                              <p class="mt-1 text-sm text-blue-700">
                                 La organización ha limitado a <strong>{{ $evento->max_compra }} entradas</strong> por compra. Para conseguir más tendrás que volver a entrar para reservar más plazas.
                              </p>
                           </div>
                        </div>
                     </div>
                  @endif
               </div>

               <!-- Grid principal -->
               <div class="grid lg:grid-cols-6 grid-cols-1 gap-6">

                  <!-- Columna izquierda: Formulario -->
                  <div class="lg:col-span-3 space-y-6">

                     <!-- Método de pago -->
                     <div>
                        <h3 class="text-sm font-semibold text-base-content mb-3">Método de pago</h3>
                        <div class="space-y-2">
                           @if (!$evento->pago_efectivo && !$evento->pago_online)
                              <p class="text-sm text-base-content/60">Este evento aún no está activo</p>
                           @endif

                           @if ($evento->pago_efectivo)
                              <label class="group relative flex items-center gap-3 rounded-xl border border-base-content/15 bg-base-100 p-4 cursor-pointer transition-all duration-200 has-checked:border-indigo-500 has-checked:bg-indigo-50/50 has-checked:shadow-sm hover:border-base-content/30">
                                 <input checked type="radio" name="metodo_pago" value="efectivo" class="size-4 accent-indigo-600" />
                                 <div class="flex-1 min-w-0">
                                    <span class="block text-sm font-medium text-base-content">Pago en efectivo</span>
                                    <span class="block text-xs text-base-content/60 mt-0.5">Paga en efectivo al llegar al evento</span>
                                 </div>
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/30 group-has-checked:text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                 </svg>
                              </label>
                           @endif

                           @if ($evento->pago_online)
                              <label class="group relative flex items-center gap-3 rounded-xl border border-base-content/15 bg-base-100 p-4 cursor-pointer transition-all duration-200 has-checked:border-indigo-500 has-checked:bg-indigo-50/50 has-checked:shadow-sm hover:border-base-content/30">
                                 <input {{ !$evento->pago_efectivo ? 'checked' : '' }} type="radio" name="metodo_pago" value="tarjeta" class="size-4 accent-indigo-600" />
                                 <div class="flex-1 min-w-0">
                                    <span class="block text-sm font-medium text-base-content">Pago con tarjeta</span>
                                    <span class="block text-xs text-base-content/60 mt-0.5">Paga ahora de forma segura con tarjeta</span>
                                 </div>
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/30 group-has-checked:text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                 </svg>
                              </label>
                           @endif
                        </div>
                     </div>

                     <!-- Cantidad de entradas -->
                     <div>
                        <label for="cantidad" class="block text-sm font-semibold text-base-content mb-2">Cantidad de entradas</label>
                        <div class="relative">
                           <input id="cantidad" type="number" min="1" max="{{ $evento->max_compra > 0 ? $evento->max_compra : '' }}" name="cantidad" value="1"
                              class="block w-full rounded-xl border border-base-content/15 bg-base-100 px-4 py-3 text-base text-base-content placeholder:text-base-content/40 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 sm:text-sm">
                        </div>
                        @if ($evento->max_compra > 0)
                           <p class="mt-1.5 text-xs text-base-content/50">Máximo {{ $evento->max_compra }} entradas por compra</p>
                        @endif
                     </div>

                     <!-- Botón reservar (móvil abajo, desktop aquí) -->
                     <button type="submit" class="hidden lg:flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 active:bg-indigo-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                        Reservar entrada
                     </button>
                  </div>

                  <!-- Columna derecha: Sidebar -->
                  <div class="lg:col-span-3 space-y-4">

                     <!-- Campos especiales -->
                     <div class="rounded-xl border border-base-content/10 overflow-hidden">
                        <div class="bg-base-200/50 px-4 py-3 border-b border-base-content/10">
                           <h3 class="text-sm font-semibold text-base-content">Información adicional</h3>
                        </div>
                        <div class="p-4 space-y-4">
                           <!-- Checkboxes -->
                           <label class="flex items-center gap-3 cursor-pointer group">
                              <input type="checkbox" name="captions[pastor]" value="1" class="size-4 rounded border-base-content/30 accent-indigo-600">
                              <span class="text-sm text-base-content group-hover:text-indigo-600 transition-colors">¿Eres pastor?</span>
                           </label>
                           <label class="flex items-center gap-3 cursor-pointer group">
                              <input type="checkbox" name="captions[lider_jovenes]" value="1" class="size-4 rounded border-base-content/30 accent-indigo-600">
                              <span class="text-sm text-base-content group-hover:text-indigo-600 transition-colors">¿Eres líder de jóvenes?</span>
                           </label>

                           <!-- Campos de texto -->
                           <div>
                              <label for="captions_iglesia" class="block text-sm font-medium text-base-content mb-1.5">Iglesia</label>
                              <input id="captions_iglesia" type="text" name="captions[iglesia]" placeholder="Nombre de tu iglesia"
                                 class="block w-full rounded-lg border border-base-content/15 bg-base-100 px-3 py-2.5 text-sm text-base-content placeholder:text-base-content/40 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                           </div>
                           <div>
                              <label for="captions_ciudad" class="block text-sm font-medium text-base-content mb-1.5">Ciudad</label>
                              <input id="captions_ciudad" type="text" name="captions[ciudad]" placeholder="Tu ciudad"
                                 class="block w-full rounded-lg border border-base-content/15 bg-base-100 px-3 py-2.5 text-sm text-base-content placeholder:text-base-content/40 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                           </div>
                        </div>
                     </div>

                     <!-- Toppings -->
                     @if ($evento->toppings->count() > 0)
                        <div class="rounded-xl border border-base-content/10 overflow-hidden">
                           <div class="bg-base-200/50 px-4 py-3 border-b border-base-content/10">
                              <h3 class="text-sm font-semibold text-base-content">Mejora tu entrada</h3>
                              <p class="text-xs text-base-content/60 mt-0.5">Selecciona los extras que quieras añadir</p>
                           </div>
                           <div class="divide-y divide-base-content/10">
                              @foreach ($evento->toppings as $topping)
                                 <label class="group flex items-center gap-3 p-3 cursor-pointer transition-colors duration-200 hover:bg-base-200/30 has-checked:bg-indigo-50/50">
                                    <input type="checkbox" name="topping[]" value="{{ $topping->uuid }}"
                                       class="size-4 rounded border-base-content/30 accent-indigo-600 shrink-0" />
                                    <img class="size-10 rounded-lg object-cover border border-base-content/10 shrink-0"
                                       src="@if ($topping->icono) {{ Storage::url($topping->icono) }}@else/media/logo/brand.png @endif" alt="{{ $topping->nombre }}">
                                    <div class="flex-1 min-w-0">
                                       <div class="flex items-center justify-between gap-2">
                                          <span class="text-sm font-medium text-base-content truncate">{{ $topping->nombre }}</span>
                                          <span class="text-xs font-semibold text-indigo-600 shrink-0">+{{ number_format($topping->precio, 2, ',', '.') }}€</span>
                                       </div>
                                       <p class="text-xs text-base-content/60 truncate mt-0.5">{{ $topping->descripcion }}</p>
                                    </div>
                                 </label>
                              @endforeach
                           </div>
                        </div>
                     @endif

                     <!-- Datos del comprador -->
                     <div class="rounded-xl border border-base-content/10 overflow-hidden">
                        <div class="bg-base-200/50 px-4 py-3 border-b border-base-content/10">
                           <h3 class="text-sm font-semibold text-base-content">Tus datos</h3>
                        </div>
                        <div class="p-4 space-y-3">
                           <div class="flex items-center gap-3">
                              <div class="size-9 rounded-full bg-indigo-100 flex items-center justify-center shrink-0">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-indigo-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                 </svg>
                              </div>
                              <div class="min-w-0">
                                 <p class="text-sm font-medium text-base-content truncate">{{ ucfirst($cliente['nombre']) }} {{ ucfirst($cliente['apellido']) }}</p>
                                 <p class="text-xs text-base-content/60 truncate">{{ $cliente['email'] }}</p>
                              </div>
                           </div>
                           <div class="flex items-start gap-2 bg-base-200/50 rounded-lg p-2.5">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-base-content/50 shrink-0 mt-0.5">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                              </svg>
                              <span class="text-xs text-base-content/60">Las entradas se enviarán a tu correo electrónico</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Botón reservar móvil -->
                  <div class="lg:hidden col-span-full">
                     <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 active:bg-indigo-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                        Reservar entrada
                     </button>
                  </div>

               </div>
            </form>
         </div>

         <!-- Disclaimer -->
         <div class="px-6 py-8 border-t border-base-content/10 bg-base-200/30">
            <p class="text-base-content/50 text-xs text-center leading-relaxed max-w-lg mx-auto">
               Rezerva.es es una plataforma online para negocios en donde pueden crear su propio portal de reservas online y compartirla con todo el mundo de manera rápida y directa.
            </p>
            <div class="flex items-center justify-center gap-2 mt-4">
               <small class="text-base-content/40">Powered by</small>
               <img src="/media/logo/logo.png" class="h-5 w-auto" alt="Rezerva.es">
            </div>
            <p class="text-center mt-2">
               <a class="text-xs text-indigo-500 hover:text-indigo-600 hover:underline transition-colors" href="https://rezerva.es/registro">¿Quieres que tu negocio esté online?</a>
            </p>
         </div>
      </div>
   </section>
@endsection

@section('scripts')
   <script>
      const reservaFormCrear = document.getElementById('crearEventoForm');

      reservaFormCrear.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(reservaFormCrear, {
            // reload: true,
            resetForm: false,
            highlightInputs: true,
            showAlert: true,
            reciclar: true
         });
      });
   </script>
@endsection

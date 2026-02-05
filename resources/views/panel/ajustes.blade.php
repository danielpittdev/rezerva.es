@extends('components.html.plantilla.fullbody')

@section('contenido')
   <section class="overflow-hidden">
      <div class="grid max-w-xl p-7 overflow-y-auto space-y-10">
         <!-- Información personal -->
         <section>
            <div class="py-3">
               <h2 class="text-base/7 font-semibold text-gray-900">Información personal</h2>
               <p class="mt-1 text-sm/6 text-gray-500">Actualiza tu información personal y de contacto.</p>
            </div>

            <form id="actualizarDatosUsuario" action="{{ route('usuario.update', ['usuario' => Auth::user()->uuid]) }}" method="POST" class="lg:py-3 md:col-span-1">
               @method('PUT')
               @csrf
               <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
                  <div class="col-span-full flex items-center gap-x-8">
                     @if (auth()->user()->avatar)
                        <img id="avatarPreview" src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->nombre }}" class="size-22 rounded-full flex-none bg-gray-100 object-cover outline -outline-offset-1 outline-base-content/20" />
                     @else
                        <div id="avatarPlaceholder" class="size-24 flex-none bg-indigo-600 flex items-center justify-center outline -outline-offset-1 outline-base-content/20">
                           <span class="text-3xl font-semibold text-white">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}{{ strtoupper(substr(auth()->user()->apellido, 0, 1)) }}</span>
                        </div>
                        <img id="avatarPreview" src="" alt="{{ auth()->user()->nombre }}" class="size-22 rounded-full flex-none bg-gray-100 object-cover outline -outline-offset-1 outline-base-content/20 hidden" />
                     @endif
                     <div>
                        <input type="file" id="avatarInput" name="avatar" accept="image/jpeg,image/png,image/gif" class="hidden" />
                        <button type="button" id="avatarBtn" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-100">Cambiar avatar</button>
                        <p class="mt-2 text-xs/5 text-gray-500">JPG, GIF o PNG. Máximo 1MB.</p>
                     </div>
                  </div>

                  <div class="sm:col-span-3">
                     <label for="nombre" class="block text-sm/6 font-medium text-gray-900">Nombre</label>
                     <div class="mt-2">
                        <input id="nombre" type="text" name="nombre" autocomplete="given-name" value="{{ auth()->user()->nombre }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>

                  <div class="sm:col-span-3">
                     <label for="apellido" class="block text-sm/6 font-medium text-gray-900">Apellido</label>
                     <div class="mt-2">
                        <input id="apellido" type="text" name="apellido" autocomplete="family-name" value="{{ auth()->user()->apellido }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>

                  <div class="col-span-full">
                     <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo electrónico</label>
                     <div class="mt-2">
                        <input id="email" type="email" name="email" autocomplete="email" value="{{ auth()->user()->email }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>
               </div>

               <div class="mt-8 flex">
                  <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar cambios</button>
               </div>
            </form>
         </section>

         <!-- Cambiar contraseña -->
         <section>
            <div class="py-3">
               <h2 class="text-base/7 font-semibold text-gray-900">Contraseña</h2>
               <p class="mt-1 text-sm/6 text-gray-500">Cambia tu contraseña rápidamente.</p>
            </div>

            <form id="actualizarPass" action="{{ route('usuario.update', ['usuario' => Auth::user()->uuid]) }}" method="POST" class="lg:py-3 md:col-span-1">
               @method('PUT')
               @csrf
               <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">

                  <div class="col-span-full">
                     <label for="old_password" class="block text-sm/6 font-medium text-gray-900">Contraseña antigua</label>
                     <div class="mt-2">
                        <input id="old_password" type="password" name="old_password" autocomplete="off"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>

                  <div class="col-span-full">
                     <label for="password" class="block text-sm/6 font-medium text-gray-900">Nueva contraseña</label>
                     <div class="mt-2">
                        <input id="password" type="password" name="password" autocomplete="off"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>

                  <div class="col-span-full">
                     <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Repetir nueva contraseña</label>
                     <div class="mt-2">
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="off"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                     </div>
                  </div>
               </div>

               <div class="mt-8 flex">
                  <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar cambios</button>
               </div>
            </form>
         </section>

         <!-- Suscripción -->
         <section>
            <div class="py-3">
               <h2 class="text-base/7 font-semibold text-gray-900">Suscripción</h2>
               <p class="mt-1 text-sm/6 text-gray-500">Gestiona tu suscripción y facturación.</p>
            </div>

            @php
               $usuario = auth()->user();
               $suscripcionActiva = $usuario->subscriptions()->where('stripe_status', 'active')->first();
               $planes = App\Models\Planes::get();
            @endphp

            @if ($suscripcionActiva)
               {{-- Usuario con suscripción activa --}}
               <div class="rounded-lg border border-gray-200 bg-white p-6">
                  <div class="flex items-center justify-between">
                     <div>
                        <p class="text-sm font-medium text-gray-500">Plan actual</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ ucfirst($suscripcionActiva->type) }}</p>
                     </div>
                     <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                        Activa
                     </span>
                  </div>

                  <div class="mt-6 border-t border-gray-100 pt-6">
                     <form id="billingPortalForm" method="POST" action="{{ route('billing.portal') }}">
                        @csrf
                        <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                           Gestionar suscripción
                        </button>
                     </form>
                     <p class="mt-3 text-xs text-gray-500">Podrás cambiar de plan, actualizar tu método de pago, ver facturas o cancelar tu suscripción.</p>
                  </div>
               </div>
            @else
               {{-- Usuario sin suscripción --}}
               <div class="rounded-lg border border-gray-200 bg-white p-6">
                  <form id="suscripcionForm" method="POST" action="{{ route('checkout') }}">
                     @csrf
                     <fieldset>
                        <legend class="text-sm/6 font-semibold text-gray-900">Selecciona un plan</legend>
                        <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                           @foreach ($planes as $plan)
                              <label aria-label="{{ $plan->nombre }}" aria-description="{{ $plan->descripcion }}"
                                 class="group relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-indigo-600 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1">
                                 <input type="radio" name="plan" value="{{ $plan->slug }}" class="absolute inset-0 appearance-none focus:outline-none" />
                                 <div class="flex-1">
                                    <span class="block text-sm font-medium text-gray-900">{{ $plan->nombre }}</span>
                                    <span class="mt-1 block text-sm text-gray-500">{{ $plan->descripcion }}</span>
                                    <span class="mt-6 block text-sm font-medium text-gray-900">{{ number_format($plan->precio, 2, ',', '.') }} €/mes</span>
                                 </div>
                                 <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="invisible size-5 text-indigo-600 group-has-checked:visible">
                                    <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </label>
                           @endforeach
                        </div>
                     </fieldset>

                     <div class="mt-8 flex">
                        <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                           Suscribirse
                        </button>
                     </div>
                  </form>
               </div>
            @endif
         </section>
      </div>
   </section>
@endsection

@section('scripts')
   <script>
      const actualizarDatosUsuario = document.getElementById('actualizarDatosUsuario');
      const actualizarPass = document.getElementById('actualizarPass');
      const suscripcionForm = document.getElementById('suscripcionForm');
      const billingPortalForm = document.getElementById('billingPortalForm');
      const avatarBtn = document.getElementById('avatarBtn');
      const avatarInput = document.getElementById('avatarInput');
      const avatarPreview = document.getElementById('avatarPreview');
      const avatarPlaceholder = document.getElementById('avatarPlaceholder');

      avatarBtn.addEventListener('click', () => avatarInput.click());

      avatarInput.addEventListener('change', (e) => {
         const file = e.target.files[0];
         if (!file) return;

         const reader = new FileReader();
         reader.onload = (ev) => {
            avatarPreview.src = ev.target.result;
            avatarPreview.classList.remove('hidden');
            if (avatarPlaceholder) avatarPlaceholder.classList.add('hidden');
         };
         reader.readAsDataURL(file);
      });

      actualizarDatosUsuario.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(actualizarDatosUsuario, {
            resetForm: false,
            highlightInputs: true,
            showAlert: false,
            reciclar: true,
            reload: true
         });
      });

      actualizarPass.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(actualizarPass, {
            resetForm: false,
            highlightInputs: true,
            showAlert: false,
            reciclar: true,
            reload: true
         });
      });

      if (suscripcionForm) {
         suscripcionForm.addEventListener('submit', (e) => {
            e.preventDefault();
            peticion(suscripcionForm, {
               resetForm: false,
               highlightInputs: true,
               showAlert: false,
               reciclar: true,
               reload: false
            });
         });
      }

      if (billingPortalForm) {
         billingPortalForm.addEventListener('submit', (e) => {
            e.preventDefault();
            peticion(billingPortalForm, {
               resetForm: false,
               highlightInputs: false,
               showAlert: false,
               reciclar: false,
               reload: false
            });
         });
      }
   </script>
@endsection

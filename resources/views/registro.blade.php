@extends('components.html.plantilla.blank')

@section('contenido')
   <div class="flex min-h-full">
      <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 lg:px-24 overflow-y-auto">
         <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
               <img src="/media/logo/icon.png" alt="Your Company" class="h-10 w-auto" />
               <h2 class="mt-8 text-2lg/9 font-bold tracking-tight">Registrarse</h2>
               <p class="mt-2 text-sm/6 text-gray-400">
                  ¿Eres miembro?
                  <a href="{{ route('login') }}" class="font-semibold text-indigo-500 hover:text-indigo-300">Inicia sesión</a>
               </p>
            </div>

            <div class="mt-10">
               <div>
                  <form id="registro" action="{{ route('api_registro') }}" method="POST" class="space-y-6 grid lg:grid-cols-2 grid-cols-1 gap-2">
                     @csrf
                     <div class="lg:col-span-2 col-span-1">
                        <label for="email" class="block text-sm/6 font-medium">Correo electrónico</label>
                        <div class="mt-2">
                           <input id="email" type="email" name="email" autocomplete="email"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="lg:col-span-1 col-span-1">
                        <label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
                        <div class="mt-2">
                           <input id="nombre" type="text" name="nombre" autocomplete="nombre"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="lg:col-span-1 col-span-1">
                        <label for="apellido" class="block text-sm/6 font-medium">Apellido</label>
                        <div class="mt-2">
                           <input id="apellido" type="text" name="apellido" autocomplete="apellido"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="lg:col-span-full col-span-1">
                        <label for="password" class="block text-sm/6 font-medium">Contraseña</label>
                        <div class="mt-2">
                           <input id="password" type="password" name="password" autocomplete="current-password"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="lg:col-span-full col-span-1">
                        <label for="password_confirmation" class="block text-sm/6 font-medium">Confirma contraseña</label>
                        <div class="mt-2">
                           <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="current-password"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="divider col-span-full">
                        Datos de tu negocio
                     </div>

                     <!-- Tipo de negocio: Online o Presencial -->
                     <div class="col-span-full">
                        <div class="flex items-center gap-3">
                           <label class="inline-flex items-center cursor-pointer">
                              <input id="online" type="checkbox" name="online" value="1" class="sr-only peer" />
                              <div class="relative w-11 h-6 rounded-full bg-base-content/20 peer-checked:bg-indigo-500 peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-indigo-500 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                              <span class="ms-3 text-sm font-medium">Negocio online</span>
                           </label>
                           <span class="text-xs text-base-content/50">(sin local fisico)</span>
                        </div>
                     </div>

                     <!-- Negocio -->

                     <div class="lg:col-span-full col-span-1">
                        <label for="empresa_nombre" class="block text-sm/6 font-medium">Nombre de tu negocio</label>
                        <div class="mt-2">
                           <input id="empresa_nombre" type="text" name="empresa_nombre" autocomplete="empresa_nombre"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="lg:col-span-2 col-span-1">
                        <label for="descripcion" class="block text-sm/6 font-medium">Descripción <span class="text-base-content/50 text-xs" id="descripcion_opcional">(opcional)</span></label>
                        <div class="mt-2">
                           <textarea name="descripcion" id="descripcion" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" cols="30"
                              rows="5"></textarea>
                        </div>
                     </div>

                     <div class="lg:col-span-2 col-span-1">
                        <label for="tipo" class="block text-sm/6 font-medium">Tipo de negocio</label>
                        <div class="mt-2">

                           @php
                              $tipos = ['otros', 'barbería', 'psicología', 'spa', 'clínica', 'gimnasio', 'consultoría'];
                           @endphp

                           <el-select id="tipo" name="tipo" value="{{ $tipos[0] }}" class="mt-2 block">
                              <button type="button"
                                 class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/10 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                 <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
                                 <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                    <path
                                       d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                       clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </button>

                              <el-options anchor="bottom start" popover
                                 class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                 @foreach ($tipos as $tipo)
                                    <el-option value="{{ $tipo }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($tipo) }}</span>
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

                     <div class="lg:col-span-2 col-span-1">
                        <label for="moneda" class="block text-sm/6 font-medium">Moneda</label>
                        <div class="mt-2">

                           @php
                              $monedas = ['EUR', 'USD', 'COP', 'GBP'];
                           @endphp

                           <el-select id="moneda" name="moneda" value="{{ $monedas[0] }}" class="mt-2 block">
                              <button type="button"
                                 class="bg-base-100 grid w-full cursor-default grid-cols-1 rounded-md py-1.5 pr-2 pl-3 text-left text-base-content outline-1 -outline-offset-1 outline-base-content/10 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6">
                                 <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">Elige uno</el-selectedcontent>
                                 <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                    <path
                                       d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                       clip-rule="evenodd" fill-rule="evenodd" />
                                 </svg>
                              </button>

                              <el-options anchor="bottom start" popover
                                 class="max-h-60 w-(--button-width) overflow-auto rounded-md p-1 text-base shadow-lg outline-1 outline-base-content/20 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">

                                 @foreach ($monedas as $moneda)
                                    <el-option value="{{ $moneda }}" class="rounded-md group/option relative block cursor-default py-2 pr-9 pl-3 text-base-content select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                                       <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ ucfirst($moneda) }}</span>
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

                     <!-- Campos de dirección (solo para negocio presencial) -->
                     <div id="campos_direccion" class="col-span-full grid lg:grid-cols-2 grid-cols-1 gap-2">
                        <div class="lg:col-span-2 col-span-1">
                           <label for="postal_direccion" class="block text-sm/6 font-medium">Dirección</label>
                           <div class="mt-2">
                              <input id="postal_direccion" type="text" name="postal_direccion" placeholder="Calle y número" autocomplete="street-address"
                                 class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <div class="lg:col-span-1 col-span-1">
                           <label for="postal_codigo" class="block text-sm/6 font-medium">Código postal</label>
                           <div class="mt-2">
                              <input id="postal_codigo" type="text" name="postal_codigo" placeholder="00000" autocomplete="postal-code"
                                 class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <div class="lg:col-span-1 col-span-1">
                           <label for="postal_ciudad" class="block text-sm/6 font-medium">Ciudad</label>
                           <div class="mt-2">
                              <input id="postal_ciudad" type="text" name="postal_ciudad" placeholder="Ciudad" autocomplete="address-level2"
                                 class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>

                        <div class="lg:col-span-2 col-span-1">
                           <label for="postal_pais" class="block text-sm/6 font-medium">País</label>
                           <div class="mt-2">
                              <input id="postal_pais" type="text" name="postal_pais" placeholder="País" autocomplete="country-name"
                                 class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                           </div>
                        </div>
                     </div>

                     <div class="flex items-center justify-between col-span-full">
                        <div class="flex gap-3">
                           <div class="flex h-6 shrink-0 items-center">
                              <div class="group grid size-4 col-span-1">
                                 <input id="terminos_condiciones" type="checkbox" name="terminos_condiciones"
                                    class="col-start-1 row-start-1 appearance-none rounded-sm border border-base-content/10 bg-white/5 checked:border-indigo-500 checked:bg-indigo-500 indeterminate:border-indigo-500 indeterminate:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                 <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100" />
                                 </svg>
                              </div>
                           </div>
                           <label for="terminos_condiciones" class="block text-sm/6">
                              <a class="text-blue-500 hover:underline" href="https://rezerva.es/contrato">
                                 Términos y condiciones
                              </a>
                           </label>

                        </div>
                     </div>



                     <div class="col-span-full">
                        <button type="submit" class="text-base-100 flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Crear cuenta</button>
                     </div>
                  </form>
               </div>

            </div>
         </div>
      </div>
      <div class="relative hidden w-0 flex-1 lg:block sticky top-0">
         <img src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ilgib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="" class="absolute inset-0 size-full object-cover" />
      </div>
   </div>
@endsection

@section('scripts')
   <script>
      const registroForm = document.getElementById('registro');
      const onlineToggle = document.getElementById('online');
      const camposDireccion = document.getElementById('campos_direccion');
      const descripcionOpcional = document.getElementById('descripcion_opcional');

      onlineToggle.addEventListener('change', () => {
         if (onlineToggle.checked) {
            camposDireccion.style.display = 'none';
            descripcionOpcional.style.display = '';
         } else {
            camposDireccion.style.display = '';
            descripcionOpcional.style.display = 'none';
         }
      });

      // Estado inicial
      descripcionOpcional.style.display = 'none';

      registroForm.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(registroForm, {
            resetForm: true,
            highlightInputs: true,
            showAlert: false
         });
      });
   </script>
@endsection

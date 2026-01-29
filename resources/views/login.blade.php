@extends('html.plantilla.blank')

@section('contenido')
   <div class="flex min-h-full">
      <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
         <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
               <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="h-10 w-auto" />
               <h2 class="mt-8 text-2xl/9 font-bold tracking-tight">Iniciar sesión</h2>
               <p class="mt-2 text-sm/6 text-gray-400">
                  ¿No eres miembro?
                  <a href="{{ route('registro') }}" class="font-semibold text-indigo-500 hover:text-indigo-300">Empieza ahora</a>
               </p>
            </div>

            <div class="mt-10">
               <div>
                  <form id="login" action="{{ route('api_login') }}" method="POST" class="space-y-6">
                     @csrf
                     <div>
                        <label for="email" class="block text-sm/6 font-medium">Email address</label>
                        <div class="mt-2">
                           <input id="email" type="email" name="email" required autocomplete="email"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div>
                        <label for="password" class="block text-sm/6 font-medium">Password</label>
                        <div class="mt-2">
                           <input id="password" type="password" name="password" required autocomplete="current-password"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                           <div class="flex h-6 shrink-0 items-center">
                              <div class="group grid size-4 grid-cols-1">
                                 <input id="remember-me" type="checkbox" name="remember-me"
                                    class="col-start-1 row-start-1 appearance-none rounded-sm border border-base-content/10 bg-white/5 checked:border-indigo-500 checked:bg-indigo-500 indeterminate:border-indigo-500 indeterminate:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                 <svg viewBox="0 0 14 14" fill="none" class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 group-has-indeterminate:opacity-100" />
                                 </svg>
                              </div>
                           </div>
                           <label for="remember-me" class="block text-sm/6">Recordarme</label>
                        </div>

                        <div class="text-sm/6">
                           <a href="{{ route('recuperar') }}" class="font-semibold text-indigo-500 hover:text-indigo-400">Contraseña olvidada</a>
                        </div>
                     </div>

                     <div>
                        <button type="submit" class="text-base-100 flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Iniciar sesión</button>
                     </div>
                  </form>
               </div>

            </div>
         </div>
      </div>
      <div class="relative hidden w-0 flex-1 lg:block">
         <img src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="" class="absolute inset-0 size-full object-cover" />
      </div>
   </div>
@endsection

@section('scripts')
   <script>
      const loginForm = document.getElementById('login');

      loginForm.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(loginForm, {
            resetForm: true,
            highlightInputs: true,
            showAlert: false,
         });
      });
   </script>
@endsection

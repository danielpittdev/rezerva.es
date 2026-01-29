@extends('components.html.plantilla.blank')

@section('contenido')
   <div class="flex min-h-full">
      <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
         <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
               <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="h-10 w-auto" />
               <h2 class="mt-8 text-2xl/9 font-bold tracking-tight">Nueva contraseña</h2>
               <p class="mt-2 text-sm/6 text-gray-400">
                  Restablece tu contraseña de nuevo.
               </p>
            </div>

            <div class="mt-10">
               <div>
                  <form id="recuperacion" action="{{ route('api_restablecer') }}" method="POST" class="space-y-6">
                     @csrf
                     <input hidden type="text" name="token" value="{{ $token }}">
                     <div>
                        <label for="email" class="block text-sm/6 font-medium">Correo electrónico</label>
                        <div class="mt-2">
                           <input id="email" type="email" name="email" autocomplete="email"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div>
                        <label for="password" class="block text-sm/6 font-medium">Contraseña</label>
                        <div class="mt-2">
                           <input id="password" type="password" name="password" autocomplete="password"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div>
                        <label for="password_confirmation" class="block text-sm/6 font-medium">Repetir contraseña</label>
                        <div class="mt-2">
                           <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="password"
                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-content/10 placeholder:text-base-content/70 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                     </div>

                     <div>
                        <button type="submit" class="text-base-100 flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Enviar recuperación</button>
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
      const recuperacion_form = document.getElementById('recuperacion');

      recuperacion_form.addEventListener('submit', (e) => {
         e.preventDefault();
         peticion(recuperacion_form, {
            resetForm: true,
            highlightInputs: true,
            showAlert: false
         });
      });
   </script>
@endsection

@extends('components.html.plantilla.fullbody')

@section('contenido')
   <div class="grid max-w-7xl grid-cols-1 gap-1 px-4 sm:px-6 md:grid-cols-3 lg:px-8 h-full overflow-y-auto">
      <div class="py-3">
         <h2 class="text-base/7 font-semibold text-gray-900">Información Personal</h2>
         <p class="mt-1 text-sm/6 text-gray-500">Actualiza tu información personal y de contacto.</p>
      </div>

      <form id="actualizarDatosUsuario" action="{{ route('usuario.update', ['usuario' => Auth::user()->uuid]) }}" method="POST" class="lg:py-3 md:col-span-2">
         @method('PUT')
         @csrf
         <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
            <div class="col-span-full flex items-center gap-x-8">
               @if (auth()->user()->avatar)
                  <img id="avatarPreview" src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->nombre }}" class="size-24 flex-none rounded-lg bg-gray-100 object-cover outline -outline-offset-1 outline-black/5" />
               @else
                  <div id="avatarPlaceholder" class="size-24 flex-none rounded-lg bg-indigo-600 flex items-center justify-center outline -outline-offset-1 outline-black/5">
                     <span class="text-3xl font-semibold text-white">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}{{ strtoupper(substr(auth()->user()->apellido, 0, 1)) }}</span>
                  </div>
                  <img id="avatarPreview" src="" alt="{{ auth()->user()->nombre }}" class="size-24 flex-none rounded-lg bg-gray-100 object-cover outline -outline-offset-1 outline-black/5 hidden" />
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

            <div class="col-span-full">
               <label for="empresa_nombre" class="block text-sm/6 font-medium text-gray-900">Empresa</label>
               <div class="mt-2">
                  <input id="empresa_nombre" type="text" name="empresa_nombre" autocomplete="organization" value="{{ auth()->user()->empresa_nombre }}"
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
               </div>
            </div>
         </div>

         <div class="mt-8 flex">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar cambios</button>
         </div>
      </form>
   </div>
@endsection

@section('scripts')
   <script>
      const actualizarDatosUsuario = document.getElementById('actualizarDatosUsuario');
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
   </script>
@endsection

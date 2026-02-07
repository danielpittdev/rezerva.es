<header class="bg-white w-full z-100 fixed top-0 shadow">
   <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
      <div class="flex lg:flex-1">
         <a href="/" class="-m-1.5 p-1.5">
            <span class="sr-only">Rezerva.es</span>
            <img src="/media/logo/icon.png" alt="" class="h-8 w-auto" />
         </a>
      </div>
      <div class="flex lg:hidden">
         <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Abrir menú</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
               <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
         </button>
      </div>
      <el-popover-group class="hidden lg:flex lg:gap-x-12">
         <div class="relative">
            <button popovertarget="desktop-menu-product" class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
               Soluciones
               <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 flex-none text-gray-400">
                  <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
               </svg>
            </button>

            <el-popover id="desktop-menu-product" anchor="bottom" popover
               class="w-screen max-w-md overflow-hidden rounded-xl bg-white shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(3)] backdrop:bg-transparent open:block data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in">
               <div class="p-2">
                  <!-- Card -->
                  <div class="group relative flex items-center gap-x-4 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                     <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                     </div>
                     <div class="flex-auto">
                        <a href="{{ route('cat_reservas') }}" class="block font-semibold text-gray-900">
                           Reservas online
                           <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-0 text-gray-600">
                           Gestiona todas tus reservas de manera instantánea
                        </p>
                     </div>
                  </div>

                  <!-- Card -->
                  <div class="group relative flex items-center gap-x-4 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                     <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                     </div>
                     <div class="flex-auto">
                        <a href="{{ route('cat_empleados') }}" class="block font-semibold text-gray-900">
                           Empleados
                           <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-0 text-gray-600">
                           Controla empleados de forma rápida
                        </p>
                     </div>
                  </div>

                  <!-- Card -->
                  <div class="group relative flex items-center gap-x-4 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                     <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                        </svg>
                     </div>
                     <div class="flex-auto">
                        <a href="{{ route('cat_carta_qr') }}" class="block font-semibold text-gray-900 space-x-2">
                           Carta QR <div class="badge badge-soft badge-primary text-xs">Nuevo</div>
                           <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-0 text-gray-600">
                           Crea y gestiona cartas para restaurantes
                        </p>
                     </div>
                  </div>

                  <!-- Card -->
                  <div class="group relative flex items-center gap-x-4 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                     <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>

                     </div>
                     <div class="flex-auto">
                        <a href="{{ route('cat_horarios') }}" class="block font-semibold text-gray-900">
                           Control de horarios
                           <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-0 text-gray-600">
                           Ajusta los horarios de reservas
                        </p>
                     </div>
                  </div>

                  <!-- Card -->
                  <div class="group relative flex items-center gap-x-4 rounded-lg p-2 text-sm/6 hover:bg-gray-50">
                     <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>

                     </div>
                     <div class="flex-auto">
                        <a href="{{ route('cat_clientes') }}" class="block font-semibold text-gray-900">
                           Clientes internos
                           <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-0 text-gray-600">
                           Guarda y asigna clientes internos
                        </p>
                     </div>
                  </div>
               </div>
            </el-popover>
         </div>

         <a href="{{ route('psicologia') }}" class="text-sm/6 font-semibold text-gray-900">Psicología</a>
         <a href="{{ route('franquicias') }}" class="text-sm/6 font-semibold text-gray-900">Franquicias</a>
         <a href="{{ route('manager') }}" class="text-sm/6 font-semibold text-gray-900">Manager</a>
      </el-popover-group>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-3">
         <a href="{{ route('registro') }}" class="p-2 px-3 hover:bg-indigo-400 bg-indigo-500 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
         <a href="{{ route('contacto') }}" class="p-2 px-3 hover:bg-base-200 bg-base-100 ring ring-base-content/20 rounded-box text-sm/6 font-semibold text-black">Contactar</a>
      </div>
   </nav>
   <el-dialog>
      <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
         <div tabindex="0" class="fixed inset-0 focus:outline-none">
            <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
               <div class="flex items-center justify-between">
                  <a href="/" class="-m-1.5 p-1.5">
                     <span class="sr-only">Rezerva.es</span>
                     <img src="/media/logo/icon.png" alt="" class="h-8 w-auto" />
                  </a>
                  <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                     <span class="sr-only">Close menu</span>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </button>
               </div>
               <div class="mt-6 flow-root">
                  <div class="-my-6 divide-y divide-gray-500/10">
                     <div class="space-y-2 py-6">
                        <div class="-mx-3">
                           <button type="button" command="--toggle" commandfor="products" class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                              Soluciones
                              <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 flex-none in-aria-expanded:rotate-180">
                                 <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                              </svg>
                           </button>
                           <el-disclosure id="products" hidden class="mt-2 block space-y-2">
                              <a href="{{ route('cat_reservas') }}" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Reservas</a>
                              <a href="{{ route('cat_empleados') }}" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Empleados</a>
                              <a href="{{ route('cat_carta_qr') }}" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Carta QR</a>
                              <a href="{{ route('cat_horarios') }}" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Control de horarios</a>
                              <a href="{{ route('cat_clientes') }}" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">Clientes internos</a>
                           </el-disclosure>
                        </div>
                        <a href="{{ route('franquicias') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Franquicias</a>
                        <a href="{{ route('manager') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">manager</a>
                        <a href="{{ route('manager') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Manager</a>
                     </div>
                     <div class="py-6 flex flex-col items-start justify-start gap-3">
                        <a href="{{ route('registro') }}" class="p-2 px-3 hover:bg-indigo-400 bg-indigo-500 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
                        <a href="{{ route('contacto') }}" class="p-2 px-3 hover:bg-base-200 bg-base-100 ring ring-base-content/20 rounded-box text-sm/6 font-semibold text-black">Contactar</a>
                     </div>
                  </div>
               </div>
            </el-dialog-panel>
         </div>
      </dialog>
   </el-dialog>
</header>

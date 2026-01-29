@if ($servicios->count() > 0)
   @foreach ($servicios as $servicio)
      <li class="flex items-center justify-between gap-x-6 py-5">
         <div class="min-w-0">
            <div class="flex items-start gap-x-3">
               <p class="text-sm/6 font-semibold">
                  <a class="hover:underline" href="{{ route('servicio', ['id' => $servicio->uuid]) }}">
                     {{ $servicio->nombre }}
                  </a>
               </p>
               <p class="mt-0.5 rounded-md bg-base-100 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">Activo</p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
               <p class="whitespace-nowrap">Creado el: <time datetime="{{ Carbon\Carbon::parse($servicio->created_at) }}">{{ Carbon\Carbon::parse($servicio->created_at)->translatedFormat('M l d \d\e Y') }}</time></p>
               <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                  <circle r="1" cx="1" cy="1" />
               </svg>
               <p class="truncate">Creado por {{ $servicio->nombre }}</p>
            </div>
         </div>
         <div class="flex flex-none items-center gap-x-4">
            <a href="{{ route('servicio', ['id' => $servicio->uuid]) }}" class="hidden rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold shadow-xs inset-ring inset-ring-indigo-600 hover:bg-indigo-500 text-white sm:block">
               Entrar
               <span class="sr-only">, {{ $servicio->nombre }}</span></a>
            <el-dropdown class="relative flex-none">
               <button class="relative block text-gray-500 hover">
                  <span class="absolute -inset-2.5"></span>
                  <span class="sr-only">Open options</span>
                  <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                     <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                  </svg>
               </button>
               <el-menu anchor="bottom end" popover
                  class="w-35 origin-top-right rounded-md bg-base-100 p-1 shadow-lg outline-1 outline-base-content/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                  <a href="{{ route('servicio', ['id' => $servicio->uuid]) }}" class="block px-3 py-1 text-sm/6 rounded-sm focus:bg-indigo-500 focus:text-white focus:outline-hidden">Edit<span class="sr-only">, {{ $servicio->nombre }}</span></a>
                  <a href="#" class="block px-3 py-1 text-sm/6 rounded-sm focus:bg-red-500 focus:text-white focus:outline-hidden">Delete<span class="sr-only">, {{ $servicio->nombre }}</span></a>
               </el-menu>
            </el-dropdown>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="p-2 text-base-content/70">
         No tienes ningún servicio creado
   </li>
@endif

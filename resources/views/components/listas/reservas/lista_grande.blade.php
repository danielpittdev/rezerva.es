@foreach ($reservas as $reserva)
   <li class="flex items-center justify-between gap-x-6 px-5 py-5">
      <div class="min-w-0">
         <div class="flex items-start gap-x-3">
            <p class="text-sm/6 font-semibold text-base-content">{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}</p>

            @switch($reserva->estado)
               @case('pendiente')
                  <p class="mt-0.5 rounded-md bg-yellow-500/20 px-1.5 py-0.5 text-xs font-medium text-yellow inset-ring inset-ring-yellow-500/20">{{ ucfirst($reserva->estado) }}</p>
               @break

               @case('confirmado')
                  <p class="mt-0.5 rounded-md bg-green-500/20 px-1.5 py-0.5 text-xs font-medium text-green inset-ring inset-ring-green-500/20">{{ ucfirst($reserva->estado) }}</p>
               @break

               @case('cancelado')
                  <p class="mt-0.5 rounded-md bg-red-500/20 px-1.5 py-0.5 text-xs font-medium text-red inset-ring inset-ring-red-500/20">{{ ucfirst($reserva->estado) }}</p>
               @break

               @case('completado')
                  <p class="mt-0.5 rounded-md bg-blue-500/20 px-1.5 py-0.5 text-xs font-medium text-blue inset-ring inset-ring-blue-500/20">{{ ucfirst($reserva->estado) }}</p>
               @break


            @break

            @default
         @endswitch

      </div>
      <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-base-content/70">
         <p class="whitespace-nowrap"><time datetime="{{ $reserva->fecha }}">{{ $reserva->fecha }}</time></p>
         {{-- <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
               <circle r="1" cx="1" cy="1" />
            </svg> --}}
      </div>
   </div>
   <div class="flex flex-none items-center gap-x-4">
      <a href="#" class="hidden rounded-md bg-base-100 px-2.5 py-1.5 text-sm font-semibold text-base-content shadow-xs inset-ring inset-ring-base-content/10 hover:bg-base-200 sm:block">View project<span class="sr-only">, GraphQL API</span></a>
      {{-- <el-dropdown class="relative flex-none">
            <button class="relative block text-base-content/70 hover:text-base-content">
               <span class="absolute -inset-2.5"></span>
               <span class="sr-only">Open options</span>
               <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                  <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
               </svg>
            </button>
            <el-menu anchor="bottom end" popover
               class="w-32 origin-top-right rounded-md bg-base-100 py-2 shadow-lg outline-1 outline-base-content/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
               <a href="#" class="block px-3 py-1 text-sm/6 text-base-content focus:bg-base-200 focus:outline-hidden">Edit<span class="sr-only">, GraphQL API</span></a>
               <a href="#" class="block px-3 py-1 text-sm/6 text-base-content focus:bg-base-200 focus:outline-hidden">Move<span class="sr-only">, GraphQL API</span></a>
               <a href="#" class="block px-3 py-1 text-sm/6 text-base-content focus:bg-base-200 focus:outline-hidden">Delete<span class="sr-only">, GraphQL API</span></a>
            </el-menu>
         </el-dropdown> --}}
   </div>
</li>
@endforeach

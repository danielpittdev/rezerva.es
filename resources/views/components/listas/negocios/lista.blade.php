@if ($negocios->count() > 0)
   @foreach ($negocios as $negocio)
      <li class="flex items-center justify-between gap-x-6 py-5">
         <div class="min-w-0">
            <div class="flex items-start gap-x-3">
               <p class="text-sm/6 font-semibold">
                  <a class="hover:underline" href="{{ route('negocio', ['id' => $negocio->uuid]) }}">
                     {{ $negocio->nombre }}
                  </a>
               </p>
               <p class="mt-0.5 rounded-md bg-base-100 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">Activo</p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
               <p class="whitespace-nowrap">Creado el: <time datetime="{{ Carbon\Carbon::parse($negocio->created_at) }}">{{ Carbon\Carbon::parse($negocio->created_at)->translatedFormat('M l d \d\e Y') }}</time></p>
               <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                  <circle r="1" cx="1" cy="1" />
               </svg>
               <p class="truncate">Creado por {{ $negocio->usuario->nombre }}</p>
            </div>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 py-5">
      <div class="p-2 text-base-content/70">
         No tienes ningún negocio creado
   </li>
@endif

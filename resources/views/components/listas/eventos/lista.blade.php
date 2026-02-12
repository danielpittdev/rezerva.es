@if ($eventos->count() > 0)
   @foreach ($eventos as $evento)
      <li class="flex items-center justify-between gap-x-6 p-2">
         <div class="min-w-0">
            <div class="flex items-start gap-x-3">
               <p class="text-sm/6 font-semibold text-base-content/90">{{ $evento->nombre }}</p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
               <p class="whitespace-nowrap"><time>{{ Carbon\Carbon::parse($evento->created_at)->translatedFormat('l d M') }}</time></p>
            </div>
         </div>
         <div class="flex flex-none items-center gap-x-4">
            <a href="{{ route('evento', ['id' => $evento->uuid]) }}" class=" rounded-md bg-base-100 px-2.5 py-1.5 text-sm font-semibold text-base-content/90 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">
               Ver evento
               <span class="sr-only">, {{ $evento->nombre }}</span></a>
         </div>
      </li>
   @endforeach
@else
   <li class="flex items-center justify-between gap-x-6 p-2">
      <div class="min-w-0">
         <div class="flex items-start gap-x-3">
            <p class="text-sm/6 font-normal text-base-content/90">No hay eventos</p>
         </div>
      </div>
   </li>
@endif

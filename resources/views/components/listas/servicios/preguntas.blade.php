@if ($servicio->preguntas->count() > 0)
   @foreach ($servicio->preguntas as $pregunta)
      <tr>

         <td>
            <div class="caja">
               @switch($pregunta->tipo)
                  @case('text')
                     <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Texto</span>
                  @break

                  @case('textarea')
                     <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Texto grande</span>
                  @break

                  @case('checkbox')
                     <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Checkbox</span>
                  @break

                  @case('number')
                     <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Número</span>
                  @break

                  @default
               @endswitch
            </div>

            <div class="caja font-medium">
               {{ $pregunta->pregunta }}
            </div>
         </td>

         <td>
            @if ($pregunta->obligatorio)
               <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Obligatorio</span>
            @endif
         </td>

         <td class="text-end">
            <el-dropdown class="inline-block text-start">

               <button class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                  <span class="sr-only">Open options</span>
                  <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                     <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                  </svg>
               </button>

               <el-menu anchor="bottom end" popover class="w-42 rounded-md bg-base-100 shadow-lg outline-1 outline-base-content/10">
                  <div class="p-1">
                     <form class="elim_servicioConf" action="{{ route('servicioConf.destroy', $pregunta->uuid) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="block w-full px-3 py-1.5 text-left text-sm hover:bg-red-500 hover:text-white rounded-md">
                           Eliminar
                        </button>
                     </form>
                  </div>
               </el-menu>
            </el-dropdown>
         </td>
      </tr>
   @endforeach
@else
   <tr>
      <td class="3">
         No hay ninguno
      </td>
   </tr>
@endif

<tbody>
   @foreach ($horarios_puntuales as $fecha => $bloques)
      <tr>
         <td>
            {{ \Carbon\Carbon::parse($fecha)->translatedFormat('l j F Y') }}
         </td>

         <td class="text-end">
            @foreach ($bloques as $h)
               <div class="inline-block mb-1">
                  <el-dropdown class="inline-block text-start">
                     <button class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium bg-base-200 border border-base-content/10">
                        @if ($h->cerrado)
                           Cerrado
                        @else
                           {{ Carbon\Carbon::parse($h->franja_inicio)->translatedFormat('H:i') }}h a {{ Carbon\Carbon::parse($h->franja_final)->translatedFormat('H:i') }}h
                        @endif
                     </button>

                     <el-menu anchor="bottom end" popover class="w-42 rounded-md bg-base-100 shadow-lg outline-1 outline-base-content/10">
                        <div class="p-1">
                           <form class="elim_horario" action="{{ route('horario.destroy', $h->uuid) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="block w-full px-3 py-1.5 text-left text-sm hover:bg-red-500 hover:text-white rounded-md">
                                 Eliminar
                              </button>
                           </form>
                        </div>
                     </el-menu>
                  </el-dropdown>
               </div>
            @endforeach
         </td>
      </tr>
   @endforeach
</tbody>

@php
   $paginas = [
       'inicio' => ['ruta' => 'panel', 'icono' => 'house'],
       'negocios' => ['ruta' => 'negocios', 'icono' => 'briefcase'],
       'servicios' => ['ruta' => 'servicios', 'icono' => 'wrench'],
       'reservas' => ['ruta' => 'reservas', 'icono' => 'calendar'],
       'horarios' => ['ruta' => 'horarios', 'icono' => 'clock'],
   ];
@endphp

<el-dialog>
   <dialog id="sidebar" class="backdrop:bg-transparent lg:hidden">
      <el-dialog-backdrop class="fixed inset-0 bg-base-100/50 transition-opacity duration-500 ease-linear data-closed:opacity-0"></el-dialog-backdrop>

      <div tabindex="0" class="fixed inset-0 flex focus:outline-none">
         <el-dialog-panel class="border-r border-base-content/20 group/dialog-panel relative mr-16 flex w-full max-w-xs flex-1 transform transition duration-500 ease-in-out data-closed:-translate-x-full">
            <div class="absolute top-0 left-full flex w-16 justify-center pt-5 duration-500 ease-in-out group-data-closed/dialog-panel:opacity-0">
               <button type="button" command="close" commandfor="sidebar" class="-m-2.5 p-2.5">
                  <span class="sr-only">Close sidebar</span>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-base-content">
                     <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </button>
            </div>

            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-base-100 px-6 pb-2 ring-1 ring-white/10">
               <div class="relative flex h-16 shrink-0 items-center">
                  <img src="{{ asset('/media/logo/icon_blanco.svg') }}" alt="{{ env('APP_NAME') }}" class="h-8 w-auto" />
               </div>
               <nav class="flex flex-1 flex-col">
                  <ul role="list" class="flex flex-1 flex-col gap-y-7">
                     <li>
                        <ul role="list" class="-mx-2 space-y-1">
                           @foreach ($paginas as $pagina => $param)
                              <li>
                                 <a href="{{ route($param['ruta']) }}"
                                    class="{{ request()->routeIs($param['ruta']) ? 'bg-base-content/70 text-white text-base-content' : 'hover:bg-base-content/5' }} group flex gap-x-3 rounded-md p-2 text-md font-medium text-base-content">
                                    <div class="flex items-center gap-3">
                                       <span>
                                          @svg('gravityui-' . $param['icono'], 'size-6 items-center')
                                       </span>
                                       {{ ucfirst($pagina) }}
                                    </div>
                                 </a>
                              </li>
                           @endforeach
                        </ul>
                     </li>
                     {{-- <li class="hidden">
                        <div class="text-xs/6 font-medium text-gray-400">Tus negocios</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">

                           @foreach (Auth::user()->negocios as $negocio)
                              <li>
                                 <a href="{{ route('negocio', ['id' => $negocio->uuid]) }}" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-medium text-gray-400 hover:text-base-content">
                                    <img class="size-5 border border-base-content/20 rounded-md"
                                       src=" @if ($negocio->icono) {{ Storage::url($negocio->icono) }} @else /media/logo/brand.png @endif" alt="">
                                    <span class="truncate">{{ $negocio->nombre }}</span>
                                 </a>
                              </li>
                           @endforeach


                        </ul>
                     </li> --}}
                  </ul>
               </nav>
            </div>
         </el-dialog-panel>
      </div>
   </dialog>
</el-dialog>

<!-- Static sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-63 lg:flex-col bg-base-100">
   <!-- Sidebar component, swap this element with another sidebar if you like -->
   <div class="flex grow flex-col gap-y-5 overflow-y-auto px-6">
      <div class="flex h-16 shrink-0 items-center">
         <a href="{{ route('panel') }}">
            <img src="{{ asset('/media/logo/icon_blanco.svg') }}" alt="{{ env('APP_NAME') }}" class="h-8 w-auto" />
         </a>
      </div>
      <nav class="flex flex-1 flex-col">
         <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
               <ul role="list" class="-mx-2 space-y-0.5">
                  @foreach ($paginas as $pagina => $param)
                     <li>
                        <a href="{{ route($param['ruta']) }}"
                           class="flex items-center {{ request()->routeIs($param['ruta']) ? 'text-base-content/50 bg-base-300/70 hover:bg-base-300 ring ring-base-content/10 px-2' : 'text-base-content hover:bg-base-content/5' }} hover:pl-2 duration-200 group flex gap-x-3 rounded-md text-sm/6 py-1.5 px-1 font-medium">
                           <span>
                              @svg('gravityui-' . $param['icono'], 'size-4.5 items-center')
                           </span>
                           {{ ucfirst($pagina) }} @if (isset($param['nuevo']))
                              <span class="ml-auto inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 inset-ring inset-ring-gray-500/10">Nuevo</span>
                           @endif
                        </a>
                     </li>
                  @endforeach
               </ul>
            </li>
            {{-- <li class="block">
               <div class="text-xs/6 font-medium">Tus negocios</div>
               <ul role="list" class="-mx-2 mt-2 space-y-1">
                  @foreach (Auth::user()->negocios as $negocio)
                     <li class="hover:bg-base-content/5 rounded-md">
                        <a href="{{ route('negocio', ['id' => $negocio->uuid]) }}" class="group flex items-center gap-x-3 rounded-md p-1 text-xs font-medium text-base-content hover:text-base-content">
                           <img class="size-5 border border-base-content/20 rounded-md" src="@if ($negocio->icono) {{ Storage::url($negocio->icono) }}
                           @else
                              /media/logo/brand.png @endif" alt="">
                           <span class="truncate">{{ $negocio->nombre }}</span>
                        </a>
                     </li>
                  @endforeach
               </ul>
            </li> --}}
            <li class="-mx-6 mt-auto hover:bg-base-200 ">
               <a href="{{ route('ajustes') }}" class="flex items-center gap-x-3 px-6 py-3 text-sm font-semibold text-base-content">
                  <img src="
            @if (Auth::user()->avatar) {{ Storage::url(Auth::user()->avatar) }}
            @else /media/logo/brand.png @endif
            " alt=""
                     class="size-8 object-cover rounded-full bg-base-100 border border-base-content/20 outline -outline-offset-1 outline-white/10" />
                  <span class="sr-only">Tu perfil</span>
                  <span aria-hidden="true">{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</span>
               </a>
            </li>
         </ul>
      </nav>
   </div>
</div>

<div class="lg:sticky fixed w-full top-0 z-40 flex items-center gap-x-6 bg-base-100 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
   <button type="button" command="show-modal" commandfor="sidebar" class="-m-2.5 p-2.5 text-gray-400 hover:text-base-content/50 lg:hidden">
      <span class="sr-only">Open sidebar</span>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
         <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
   </button>
   <a href="{{ route('ajustes') }}" class="ml-auto">
      <span class="sr-only">Tu perfil</span>
      <img src="
            @if (Auth::user()->avatar) {{ Storage::url(Auth::user()->avatar) }}
            @else /media/logo/brand.png @endif
            " alt=""
         class="size-8 rounded-full bg-base-100 border border-base-content/20 outline -outline-offset-1 outline-white/10" />
   </a>
</div>

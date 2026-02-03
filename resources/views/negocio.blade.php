@extends('plantilla.web.blank')

@section('contenido')
   <section class="bg-base-100 min-h-[100vh] pt-30 pb-30">

      <div class="relative border border-base-content/10 shadow bg-base-100 mx-auto max-w-xl rounded-3xl min-h-[2000px] overflow-hidden">
         <!-- Imagen -->
         <div class="p-0 shadow overflow-hidden">
            <img class="w-full h-70 object-cover" src="/media/img/banner.png" alt="">
         </div>

         <!-- Título -->
         <div class="p-5 absolute left-25 top-50 rounded-md w-sm space-y-3">
            <div class="caja">
               <img class="rounded-full size-30 mx-auto border-7 border-base-100" src="/media/logo/brand.png" alt="">
            </div>
            <h1 class="text-2xl font-medium text-center">
               {{ $negocio->nombre }}
            </h1>
         </div>


         <!-- Cuerpo -->
         <div class="cuerpo translate-y-40">

            <!-- Servicios -->
            <section class="caja">
               <div class="p-3 px-5">
                  <h2 class="font-medium text-lg">
                     Servicios
                  </h2>
               </div>

               <div class="caja">
                  <ul role="list" class="divide-y divide-gray-100">
                     @if ($negocio->servicios->count() > 0)
                        @foreach ($negocio->servicios as $servicio)
                           <li class="flex items-center justify-between gap-x-6 py-5 px-5">
                              <div class="min-w-0">
                                 <div class="flex items-start gap-x-3">
                                    <p class="text-sm/6 font-semibold text-base-content/90">GraphQL API</p>
                                    <p class="mt-0.5 rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20">Complete</p>
                                 </div>
                                 <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                                    <p class="whitespace-nowrap">Due on <time datetime="2023-03-17T00:00Z">March 17, 2023</time></p>
                                    <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                                       <circle r="1" cx="1" cy="1" />
                                    </svg>
                                    <p class="truncate">Created by Leslie Alexander</p>
                                 </div>
                              </div>
                              <div class="flex flex-none items-center gap-x-4">
                                 <a href="#" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-base-content/90 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block">View project<span class="sr-only">, GraphQL API</span></a>
                                 <el-dropdown class="relative flex-none">
                                    <button class="relative block text-gray-500 hover:text-base-content/90">
                                       <span class="absolute -inset-2.5"></span>
                                       <span class="sr-only">Open options</span>
                                       <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                          <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                       </svg>
                                    </button>
                                    <el-menu anchor="bottom end" popover
                                       class="w-32 origin-top-right rounded-md bg-white p-1 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                       <a href="#" class="block px-3 py-1 text-sm/6 text-base-content/90 focus:bg-base-300 rounded-md focus:outline-hidden">Edit<span class="sr-only">, GraphQL API</span></a>
                                       <a href="#" class="block px-3 py-1 text-sm/6 text-base-content/90 focus:bg-base-300 rounded-md focus:outline-hidden">Move<span class="sr-only">, GraphQL API</span></a>
                                       <a href="#" class="block px-3 py-1 text-sm/6 text-base-content/90 focus:bg-base-300 rounded-md focus:outline-hidden">Delete<span class="sr-only">, GraphQL API</span></a>
                                    </el-menu>
                                 </el-dropdown>
                              </div>
                           </li>
                        @endforeach
                     @else
                        <li class="flex items-center justify-between gap-x-6 py-5 px-5">
                           <p class="text-base-content/70">
                              Aún no hay servicios registrados. Prueba a visitarnos más tarde.
                           </p>
                        </li>
                     @endif
                  </ul>
               </div>





            </section>

         </div>
      </div>

   </section>
@endsection

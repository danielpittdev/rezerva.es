@extends('plantilla.web.full')

@section('tituloSEO', 'Software de sistema de entradas y tickets online para eventos')
@section('descripcionSEO', 'Crea tu evento con Rezerva.es y olvídate de toda la burocracia de gestionar tus eventos. Con Rezerva.es puedes gestionar tus entradas y tickets sin preocuparte.')

@section('contenido')
   <section class="text-white bg-black min-h-[92vh] flex items-center w-full relative overflow-hidden">
      <div class="max-w-7xl mx-auto grid grid-cols-[auto_auto] items-center justify-center ">
         <section class="p-5 space-y-10 max-w-3xl relative text-left">
            <h2 class="font-medium text-5xl">
               <span>Gestiona eventos, fácil y rápido</span> <br>
               <span class="text-green-600">Olvídate del papeleo</span>
            </h2>

            <p class="text-2xl">
               Con Rezerva.es puedes gestionar eventos públicos y privados. Además de poder controlar la comunicación con tus clientes.
            </p>

            <a href="{{ route('registro') }}" class="p-3 hover:bg-indigo-500 bg-indigo-600 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
         </section>

         <!-- IMG -->
         <div class="caja">
            <img class="w-xs" src="/media/img/iphone10.png" alt="">
         </div>
      </div>
   </section>

   <!-- SEC -->
   <section class="text-white bg-black min-h-[92vh] flex items-center w-full relative overflow-hidden">
      <div class="max-w-7xl mx-auto grid grid-cols-[auto_auto] gap-9 items-center justify-center ">
         <!-- IMG -->
         <div class="caja">
            <img class="w-auto" src="/media/img/iphone11.png" alt="">
         </div>

         <section class="p-5 space-y-10 max-w-3xl relative text-left">
            <h2 class="font-medium text-5xl">
               <span>Envío automático de entradas</span> <br>
               <span class="text-green-600">Sin tener que moverte</span>
            </h2>

            <p class="text-2xl">
               Nos encargamos de poder comunicar a tus clientes directamente todos los movimientos para que puedan tener su entrada, con avisos automáticos y urgentes.
            </p>

            <a href="{{ route('registro') }}" class="p-3 hover:bg-indigo-500 bg-indigo-600 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
         </section>
      </div>
   </section>

   <!-- SEC -->
   <section class="text-white bg-black min-h-[92vh] flex items-center w-full relative overflow-hidden">
      <div class="max-w-7xl mx-auto grid grid-cols-[auto_auto] items-center justify-center ">
         <section class="p-5 space-y-10 max-w-3xl relative text-left">
            <h2 class="font-medium text-5xl">
               <span>En cualquier lugar</span> <br>
               <span class="text-green-600">En la palma de tu mano.</span>
            </h2>

            <p class="text-2xl">
               Gestiona tus eventos, analiza tu audiencia y tu público. Setea avisos por correo a tus clientes y mucho más.
            </p>

            <a href="{{ route('registro') }}" class="p-3 hover:bg-indigo-500 bg-indigo-600 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
         </section>

         <!-- IMG -->
         <div class="caja">
            <img class="w-auto" src="/media/img/iphone8.png" alt="">
         </div>
      </div>
   </section>


   <!-- SEC -->
   <section class="text-white bg-black min-h-[92vh] flex items-center w-full relative overflow-hidden">
      <div class="max-w-7xl mx-auto grid grid-cols-1 gap-20 items-center justify-center ">
         <section class="p-5 space-y-10 max-w-3xl relative text-center">
            <h2 class="font-medium text-5xl">
               <span>En cualquier lugar</span> <br>
               <span class="text-green-600">En la palma de tu mano.</span>
            </h2>

            <p class="text-2xl">
               Gestiona tus eventos, analiza tu audiencia y tu público. Setea avisos por correo a tus clientes y mucho más.
            </p>

            <a href="{{ route('registro') }}" class="p-3 hover:bg-indigo-500 bg-indigo-600 rounded-box text-sm/6 font-semibold text-gray-100">Empezar ahora <span aria-hidden="true">&rarr;</span></a>
         </section>

         <!-- IMG -->
         <div class="caja">
            <img class="w-3xl" src="/media/img/imac4.png" alt="">
         </div>
      </div>
   </section>


   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

   <!-- SEC -->

@endsection

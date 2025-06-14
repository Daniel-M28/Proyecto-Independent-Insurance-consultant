@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

@section('content')

<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">
    
    <!-- Sección de información -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
      <h1 class="text-4xl font-bold mb-6">Regulatorios</h1>
      <p class="text-lg leading-relaxed">
        Proporciona la siguiente información para solicitar informacion sobre los regulatorios especifica en las observaciones cual necesitas. Completa cada campo con los datos solicitados. Nos pondremos en contacto contigo lo antes posible.
      </p>
        <img src="{{ asset('imgs/blog-3.jpeg') }}" alt="Cotización" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
    </div>



    <div class="w-full max-w-2xl bg-[#121212] p-8 lg:p-16 rounded-lg text-white">
  <form action="#" method="post" class="space-y-6">
    
    <!-- Nombre y apellidos -->
    <div>
      <label class="block mb-1 font-semibold">Nombre y Apellidos</label>
      <input type="text" name="nombre" placeholder="Ejemplo: Juan Pérez"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Correo electrónico -->
    <div>
      <label class="block mb-1 font-semibold">Correo Electrónico</label>
      <input type="email" name="correo" placeholder="correo@ejemplo.com"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Teléfono -->
    <div>
      <label class="block mb-1 font-semibold">Teléfono</label>
      <input type="tel" name="telefono" placeholder="Ejemplo: 555-1234"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Observaciones o solicitud -->
    <div>
      <label class="block mb-1 font-semibold">Observaciones – Solicitud de permiso o trámite</label>
      <textarea name="observaciones" rows="4" placeholder="Describe aquí tu solicitud..."
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"></textarea>
    </div>

    <!-- Botón -->
    <div>
      <button type="submit"
        class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
        Enviar Solicitud
      </button>
    </div>

  </form>
</div>

@endsection
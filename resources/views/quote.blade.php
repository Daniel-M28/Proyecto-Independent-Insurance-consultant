@extends('layouts.app')

@section('content')
<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">

    <!-- Sección izquierda con info e imágenes -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
      <h1 class="text-4xl font-bold mb-6">Commercial Insurance Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to obtain your quote.
      </p>
      <img src="{{ asset('imgs/quote.png') }}" alt="Cotización Comercial" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('comercial')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Commercial Quote</button>
      </div>

      <h1 class="text-4xl font-bold mb-6 mt-32">Personal Car Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to quote your personal vehicle.
      </p>
      <img src="{{ asset('imgs/auto.png') }}" alt="Cotización Auto Personal" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('personal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Personal Car Quote</button>
      </div>
    </div>

    <!-- Sección derecha con formularios -->
    <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16">
      
      <!-- Formulario Comercial -->
      <form id="form-comercial" action="#" method="post" enctype="multipart/form-data" class="space-y-6">
        <h2 class="text-2xl font-bold mb-4">Formulario Comercial</h2>

        <div>
          <label for="usdot" class="block mb-1 font-semibold">USDOT</label>
          <input type="text" id="usdot" name="usdot" placeholder="Número de USDOT" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="nombre" class="block mb-1 font-semibold">Nombre y Apellidos</label>
          <input type="text" id="nombre" name="nombre" placeholder="Ejemplo: Juan Pérez" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="telefono" class="block mb-1 font-semibold">Teléfono</label>
          <input type="tel" id="telefono" name="telefono" placeholder="Ejemplo: 555-1234" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="correo" class="block mb-1 font-semibold">Correo Electrónico</label>
          <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="vin" class="block mb-1 font-semibold">VIN</label>
          <input type="text" id="vin" name="vin" placeholder="Si tienes más de uno, sepáralos con comas" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="yarda" class="block mb-1 font-semibold">Yarda de parqueo (opcional)</label>
          <input type="text" id="yarda" name="yarda" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="millas" class="block mb-1 font-semibold">Millas</label>
          <input type="number" id="millas" name="millas" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="tipo-carga" class="block mb-1 font-semibold">Tipo de carga</label>
          <select id="tipo-carga" name="tipo-carga" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
            <option value="dryvan">Dryvan</option>
            <option value="reefer">Reefer</option>
            <option value="flatbed">Flatbed</option>
            <option value="carhauler">Car Hauler</option>
            <option value="towing">Towing</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Coberturas</label>
          <div class="flex flex-col gap-2">
            <label class="inline-flex items-center">
              <input type="checkbox" name="coberturas[]" value="liability" class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded">
              <span class="ml-2">Liability $1M</span>
            </label>
            <label class="inline-flex items-center">
              <input type="checkbox" name="coberturas[]" value="cargo" class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded">
              <span class="ml-2">Cargo $100K</span>
            </label>
          </div>
        </div>

        <div>
          <label for="licencias" class="block mb-1 font-semibold">Licencias (PDF o imagen)</label>
          <input type="file" id="licencias" name="licencias[]" multiple class="block w-full text-gray-300 mt-2">
        </div>

        <div>
          <label for="comentarios" class="block mb-1 font-semibold">Comentarios adicionales</label>
          <textarea id="comentarios" name="comentarios" rows="4" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"></textarea>
        </div>

        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
          Request a Quote
        </button>
      </form>

      <!-- Formulario Auto Personal -->
      <form id="form-personal" action="#" method="post" enctype="multipart/form-data" class="space-y-6 hidden">
        <h2 class="text-2xl font-bold mb-4">Formulario Auto Personal</h2>

        <div>
          <label class="block mb-1 font-semibold">Nombre y Apellidos</label>
          <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">DL Licencia (Subir archivo)</label>
          <input type="file" class="block w-full text-gray-300 mt-2">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Fecha de nacimiento</label>
          <input type="date" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Correo electrónico</label>
          <input type="email" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Teléfono</label>
          <input type="tel" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Dirección</label>
          <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Fecha de emisión ISS</label>
          <input type="date" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Ocupación</label>
          <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Millas</label>
          <input type="number" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">VIN</label>
          <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Cobertura</label>
          <select class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
            <option>Básica</option>
            <option>Full Cover</option>
          </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-1 font-semibold">Uso</label>
            <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
          </div>
          <div>
            <label class="block mb-1 font-semibold">Vehicle Type</label>
            <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
          </div>
          <div>
            <label class="block mb-1 font-semibold">Make</label>
            <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
          </div>
          <div>
            <label class="block mb-1 font-semibold">Model</label>
            <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
          </div>
          <div>
            <label class="block mb-1 font-semibold">Body Class</label>
            <input type="text" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md">
          </div>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Observaciones</label>
          <textarea rows="4" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md"></textarea>
        </div>

        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
         Request a Quote
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  function mostrarFormulario(tipo) {
    const comercial = document.getElementById('form-comercial');
    const personal = document.getElementById('form-personal');

    if (tipo === 'comercial') {
      comercial.classList.remove('hidden');
      personal.classList.add('hidden');
    } else if (tipo === 'personal') {
      personal.classList.remove('hidden');
      comercial.classList.add('hidden');
    }
  }

  // Mostrar comercial al cargar
  document.addEventListener('DOMContentLoaded', () => {
    mostrarFormulario('comercial');
  });
</script>
@endsection

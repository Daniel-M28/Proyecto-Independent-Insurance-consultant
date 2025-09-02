

<?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <?php endif; ?>

<?php $__env->startSection('content'); ?>

<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">
    
    <!-- Sección de información -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
      <h1 class="text-4xl font-bold mb-6">Creación de nueva compañia</h1>
      <p class="text-lg leading-relaxed">
        Proporciona la siguiente información para crear tu nueva compañia. Completa cada campo con los datos solicitados. Nos pondremos en contacto contigo lo antes posible.
      </p>
        <img src="<?php echo e(asset('imgs/blog-2.jpeg')); ?>" alt="Cotización" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
    </div>



    <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16">
  <form action="#" method="post" enctype="multipart/form-data" class="space-y-6 text-white">
    
    <!-- Nombre de la Compañía (3 opciones) -->
    <div>
      <label class="block mb-1 font-semibold">Nombre de la Compañía</label>
      <div class="flex flex-col md:flex-row gap-4">
        <input type="text" placeholder="Opción 1"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        <input type="text" placeholder="Opción 2"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        <input type="text" placeholder="Opción 3"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
      </div>
    </div>

    <!-- Owner (nombre y apellido) -->
    <div>
      <label class="block mb-1 font-semibold">Owner</label>
      <div class="flex flex-col md:flex-row gap-4">
        <input type="text" placeholder="Nombres"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        <input type="text" placeholder="Apellidos"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
      </div>
    </div>

    <!-- SSN -->
    <div>
      <label class="block mb-1 font-semibold">SSN</label>
      <input type="text" placeholder="Ejemplo: 123-45-6789"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- DOB -->
    <div>
      <label class="block mb-1 font-semibold">DOB (Fecha de nacimiento)</label>
      <input type="date"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
    </div>

    <!-- Licencia: número, clase, ISS -->
    <div>
      <label class="block mb-1 font-semibold">Licencia</label>
      <div class="flex flex-col md:flex-row gap-4">
        <input type="text" placeholder="Número de licencia"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        <input type="text" placeholder="Clase"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        <input type="date"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
      </div>
    </div>

    <!-- Cargar licencia -->
    <div>
      <label class="block mb-1 font-semibold">Cargar Licencia (imagen o PDF)</label>
      <input type="file" accept="image/*,application/pdf"
        class="block w-full text-gray-300 mt-2">
    </div>

    <!-- Celular -->
    <div>
      <label class="block mb-1 font-semibold">Celular</label>
      <input type="tel" placeholder="Ejemplo: 555-1234"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Correo electrónico -->
    <div>
      <label class="block mb-1 font-semibold">Correo Electrónico</label>
      <input type="email" placeholder="correo@ejemplo.com"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Dirección del negocio -->
    <div>
      <label class="block mb-1 font-semibold">Dirección del Negocio</label>
      <input type="text" placeholder="Dirección completa"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Tipo de carga -->
    <div>
      <label class="block mb-1 font-semibold">Tipo de Carga</label>
      <select class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
        <option value="">Selecciona una opción</option>
        <option value="dryvan">Dryvan</option>
        <option value="reefer">Reefer</option>
        <option value="flatbed">Flatbed</option>
        <option value="carhauler">Car Hauler</option>
        <option value="towing">Towing</option>
      </select>
    </div>

    <!-- Tipo de operación -->
    <div>
      <label class="block mb-1 font-semibold">Tipo de Operación</label>
      <select class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
        <option value="">Selecciona una opción</option>
        <option value="interstate">Interstate</option>
        <option value="intrastate">Intrastate</option>
      </select>
    </div>

    <!-- Tipo de vehículo -->
    <div>
      <label class="block mb-1 font-semibold">Tipo de Vehículo</label>
      <input type="text" placeholder="Ejemplo: Truck, Van, Car"
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
    </div>

    <!-- Observaciones -->
    <div>
      <label class="block mb-1 font-semibold">Observaciones</label>
      <textarea rows="4" placeholder="Escribe aquí tus comentarios..."
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"></textarea>
    </div>

    <!-- Botón -->
    <div>
      <button type="submit"
        class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
        Enviar Datos
      </button>
    </div>

  </form>
</div>


    <script src="https://cdn.tailwindcss.com"></script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/nueva_compañia.blade.php ENDPATH**/ ?>
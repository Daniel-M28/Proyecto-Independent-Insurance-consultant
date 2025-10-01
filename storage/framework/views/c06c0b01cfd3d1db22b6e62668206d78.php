<?php $__env->startSection('content'); ?>


<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">

    <!-- Sección izquierda con info e imágenes -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
      <h1 class="text-4xl font-bold mb-6">Commercial Insurance Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to obtain your quote.
      </p>
      <img src="<?php echo e(asset('imgs/quote.png')); ?>" alt="Cotización Comercial" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('comercial')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Commercial Quote</button>
      </div>

      <h1 class="text-4xl font-bold mb-6 mt-32">Personal Car Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to quote your personal vehicle.
      </p>
      <img src="<?php echo e(asset('imgs/auto.png')); ?>" alt="Cotización Auto Personal" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('personal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Personal Car Quote</button>
      </div>
    </div>

    <!-- Sección derecha con formularios -->
    <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16">
      
      <!-- Formulario Comercial -->
      <form id="form-comercial" action="#" method="post" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <h2 class="text-2xl font-bold mb-4">Commercial Form</h2>

        <div>
          <label for="usdot" class="block mb-1 font-semibold">USDOT</label>
          <input type="text" id="usdot" name="usdot" placeholder="USDOT number" inputmode="numeric" pattern="[0-9]*" maxlength="8"  class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="name-commercial" class="block mb-1 font-semibold">Name</label>
          <input type="text" id="name-commercial" name="name" placeholder="Example: Juan" maxlength="30" pattern="^[A-Za-z\s]+$" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="lastname-commercial" class="block mb-1 font-semibold">Lastname</label>
          <input type="text" id="lastname-commercial" name="lastname" placeholder="Example: Perez Rodriguez" maxlength="30" pattern="^[A-Za-z\s]+$" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"required>
        </div>

        <div>
          <label for="phone-commercial" class="block mb-1 font-semibold">Phone Number</label>
          <input type="tel" id="phone-commercial" name="phone" placeholder="Example (555) 123-4567" inputmode="numeric" pattern="^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$" maxlength="20" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="email-commercial" class="block mb-1 font-semibold">Email</label>
          <input type="email" id="email-commercial" name="email" placeholder="Email@example.com" maxlength="255" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="business-address" class="block mb-1 font-semibold">Business address</label>
          <input type="text" id="business-address" name="business_address" placeholder="1234 Elm Street, Springfield, IL 62704" maxlength="100" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="vin-commercial" class="block mb-1 font-semibold">VIN</label>
          <input type="text" id="vin-commercial" name="vin" placeholder="Example : 1HGCM82633A123456, JH4KA8260MC123456" pattern="^[A-HJ-NPR-Z0-9]{17}(,\s*[A-HJ-NPR-Z0-9]{17})*$" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
         <small> Separate multiple VINs with commas </small>
        </div>

        <div>
          <label for="yard-commercial" class="block mb-1 font-semibold">Parking space (optional)</label>
          <input type="text" id="yard-commercial" name="yard" placeholder="1234 Elm Street, Springfield, IL 62704"  maxlength="100"  class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="miles-commercial" class="block mb-1 font-semibold">Miles</label>
          <input type="number" id="miles-commercial" name="miles" min="1" max="1000000" step="1" placeholder="Example 1500" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

        <div>
          <label for="type-of-load" class="block mb-1 font-semibold">Type of load</label>
          <select id="type-of-load" name="type_of_load" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
            <option value="">-- Select an option --</option>
            <option value="dryvan">Dryvan</option>
            <option value="reefer">Reefer</option>
            <option value="flatbed">Flatbed</option>
            <option value="carhauler">Car Hauler</option>
            <option value="towing">Towing</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Coverages</label>
          <div class="flex flex-col gap-2">
            <label class="inline-flex items-center">
              <input type="checkbox" name="coverages[]" value="liability" class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded">
              <span class="ml-2">Liability $1M</span>
            </label>
            <label class="inline-flex items-center">
              <input type="checkbox" name="coverages[]" value="cargo" class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded">
              <span class="ml-2">Cargo $100K</span>
            </label>
          </div>
        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        <div>
          <label for="licenses-commercial" class="block mb-1 font-semibold">Driver license(s) and other documents</label>
          <input type="file" id="licenses-commercial" name="licenses[]" multiple accept=".jpeg,.jpg,.png,.pdf,.doc,.docx" class="block w-full text-gray-300 mt-2" required> 
          <small class="text-gray-400">allowed formats:  JPG, PNG, PDF, DOC, DOCX</small>
        </div> 

        <div>
          <label for="comments-commercial" class="block mb-1 font-semibold">Additional comments</label>
          <textarea id="comments-commercial" name="comments" rows="4" maxlength="500" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"></textarea>
        </div>

        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
          Request a Quote
        </button>
      </form>

      <!-- Formulario Auto Personal -->
      <form id="form-personal" action="#" method="post" enctype="multipart/form-data" class="space-y-6 hidden">
        <?php echo csrf_field(); ?>
        <h2 class="text-2xl font-bold mb-4">Personal Vehicle Form</h2>

        <div>
          <label for ="name-personal" class="block mb-1 font-semibold">Name</label>
          <input type="text" id="name-personal" name="name" placeholder="Example: Juan" pattern="^[A-Za-z\s]+$" maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
        </div>

        <div>
          <label for ="lastname" class="block mb-1 font-semibold">Lastname</label>
          <input type="text" id="lastname-personal" name="lastname" pattern="^[A-Za-z\s]+$" placeholder="Example: Perez Rodriguez" maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
        </div>

        <div>
          <label for="license-personal"  class="block mb-1 font-semibold">DL License (Upload file)</label>
            <input 
            type="file" id="license-personal" name="license-personal[]" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx"
            class="block w-full text-gray-300 mt-2"
            required multiple>
            <small class="text-gray-400">allowed formats: JPG, PNG, PDF, DOC, DOCX</small>
        </div>


        <div>
          <label  class="block mb-1 font-semibold">Date of birth</label>
          <input type="date" name="dob"  max="<?php echo e(date('Y-m-d')); ?>"  class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300" required>
        </div>

         <div>
          <label for="email" class="block mb-1 font-semibold">Email</label>
          <input type="email" id="email-personal" name="email" placeholder="email@example.com" maxlength="255" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="phone" class="block mb-1 font-semibold">Phone Number</label>
          <input type="tel" id="phone-personal" name="phone" placeholder="Example (555) 123-4567" inputmode="numeric" pattern="^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$" maxlength="20" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label for="address" class="block mb-1 font-semibold">Address</label>
          <input type="text" id="address-personal" name="address" placeholder="1234 Elm Street, Springfield, IL 62704" maxlength="100" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Date of issue ISS</label>
          <input type="date" name="iss_date" max="<?php echo e(date('Y-m-d')); ?>" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300" required>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Occupation</label>
          <input type="text" id="occupation-personal" name="occupation" maxlength="50" placeholder="Driver"class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md"  required>
        </div>

        <div>
          <label for="miles" class="block mb-1 font-semibold">Miles</label>
          <input type="number" id="miles" name="miles" min="1" max="1000000" step="1" placeholder="example 500" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        </div>


        <div>
          <label for="vin" class="block mb-1 font-semibold">VIN</label>
          <input type="text" id="vin" name="vin" pattern="^[A-HJ-NPR-Z0-9]{17}(,\s*[A-HJ-NPR-Z0-9]{17})*$" placeholder="Example : 1HGCM82633A123456, JH4KA8260MC123456" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
        <small> Enter your 17-character VIN. If you have more than one, separate them with commas </small>
        </div>


        <div>
          <label class="block mb-1 font-semibold">Coverages</label>
          <select name="coverage" id="coverage-personal" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200"  required>
            <option value="">-- Select coverage --</option>
            <option value="basic">Basic</option>
            <option value="full cover">Full Cover</option>
          </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-1 font-semibold">Vehicle Type</label>
            <input type="text" name="vehicle_type" placeholder="Car-Pickup" maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Usage</label>
            <input type="text" name="usage" placeholder="Personal"  maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
          </div>
          
          <div>
            <label class="block mb-1 font-semibold">Make</label>
            <input type="text" name="make" placeholder="Toyota" maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Model</label>
            <input type="text" name="model" placeholder="Camry" maxlength="30"  class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Body Class</label>
            <input type="text" name="body_class" placeholder="Sedam" maxlength="30" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" required>
          </div>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Observations</label>
          <textarea rows="4" name="observations" maxlength="500" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md"></textarea>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/quote.blade.php ENDPATH**/ ?>
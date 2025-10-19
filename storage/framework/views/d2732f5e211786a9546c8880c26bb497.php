

<?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <?php endif; ?>

<?php $__env->startSection('content'); ?>


 
<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">
    
    <!-- information section -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">

    <!-- Mensajes de éxito y error responsive -->
    <div class="block lg:hidden mb-6">
    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
</div>





      <h1 class="text-4xl font-bold mb-6">Regulatory</h1>
      <p class="text-lg leading-relaxed">
        
        Please provide the following information to request regulatory information.
         Specify which one you require in the comments section. Complete each field 
         with the requested information. We will contact you as soon as possible.
    </div>

    <!-- Form -->
    <div class="w-full max-w-2xl bg-[#121212] p-8 lg:p-16 rounded-lg text-white">

     <!-- Mensajes de éxito y error -->
            <?php if(session('success')): ?>
    <div class="hidden lg:block mb-4 p-3 bg-green-600 text-white rounded">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="hidden lg:block mb-4 p-3 bg-red-600 text-white rounded">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="hidden lg:block mb-4 p-3 bg-red-600 text-white rounded">
        <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
            
      <form action="<?php echo e(route('regulatorios.store')); ?>" method="POST" class="space-y-6 relative" id="RegulatoryForm">
        <?php echo csrf_field(); ?>

<!-- Contenedor del spinner y texto -->
<div id="loader" class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-50">
    <div class="flex items-center gap-2">
        <!-- Spinner -->
        <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        <!-- Texto -->
        <span class="text-white font-semibold text-lg">Submitting request...</span>
    </div>
</div>

        <!-- Nombre -->
        <div>
          <label for="name" class="block mb-1 font-semibold">Name</label>
          <input 
            type="text" 
            id="name" 
            name="name" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            value="<?php echo e(old('name')); ?>"
            placeholder="Example: Juan"
            oninvalid="this.setCustomValidity('the name can only contain letters and spaces')"
            oninput="this.setCustomValidity('')"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required/>
          
        </div>

        <!-- Apellidos -->
        <div>
          <label for="last-name" class="block mb-1 font-semibold">Lastname</label>
          <input 
            type="text" 
            id="last-name" 
            name="last_name" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            value="<?php echo e(old('last_name')); ?>"
            placeholder="Example: Perez Rodriguez"
            oninvalid="this.setCustomValidity('the lastname can only contain letters and spaces')"
            oninput="this.setCustomValidity('')"
            required
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            
          >
        </div>

        <!-- Correo electrónico -->
        <div>
          <label for="email" class="block mb-1 font-semibold">Email</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            maxlength="255" 
            placeholder="email@example.com"
            value="<?php echo e(old('email')); ?>"
            oninvalid="this.setCustomValidity('Please enter a valid email format')"
            oninput="this.setCustomValidity('')"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
          >
        </div>

        <!-- Teléfono -->
         <div>
          <label for="phone-number" class="block mb-1 font-semibold">Phone Number</label>
         <input 
        type="tel" 
        id="phone-number" 
        name="phone_number" 
        placeholder="Example: (555) 123-4567" 
        inputmode="numeric" 
        pattern="\(?[0-9]{3}\)?[ -]?[0-9]{3}[ -]?[0-9]{4}" 
        maxlength="20" 
        value="<?php echo e(old('phone_number')); ?>"
        required
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <!-- Observaciones -->
        <div>
          <label for="observations" class="block mb-1 font-semibold">Observations – Request for permit or procedure</label>
          <textarea 
            id="observations" 
            name="observations" 
            rows="4"  
            maxlength="500" 
            value="<?php echo e(old('observations')); ?>"
            placeholder="Describe your application: MC Number: Rehabilitation or new application.BOC-3, UCR, DOT Rehabilitation. Business Registration (Incorporation)."
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
            required
          ></textarea>
        </div>

        <!-- Botón -->
    <div>
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
            Send Request
        </button>
    </div>

      </form>

      <script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('RegulatoryForm');
    const loader = document.getElementById('loader');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', () => {
        loader.classList.remove('hidden'); // muestra el spinner
        submitButton.disabled = true;      // desactiva el botón
        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
    });
});
</script>


    </div>
  </div>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/regulatorios.blade.php ENDPATH**/ ?>
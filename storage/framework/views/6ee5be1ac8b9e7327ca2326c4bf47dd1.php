<?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">

    <!-- Imagen izquierda -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800 flex items-center justify-center">
      <img src="<?php echo e(asset('imgs/loge.png')); ?>" alt="Logo" class="max-h-[500px] object-contain">
    </div>

    <!-- Formulario -->
    <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16 flex flex-col justify-center">
      <h1 class="text-white text-4xl mb-6 text-center">Register</h1>

      <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>

        <!-- Name -->
        <div class="flex gap-4">
          <div class="w-1/2">
            <label for="name" class="block text-sm font-medium text-white">Name</label>
            <input 
            placeholder="Example: Juan" 
            id="name"
            type="text"
            name="name" 
            value="<?php echo e(old('name')); ?>" 
            required 
            autofocus 
            autocomplete="name"
            minlength="2" 
            maxlength="20"
            pattern="[A-Za-zÀ-ÿ\s]+"
            title="Only letters are allowed"
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Name is required' : 'Only letters are allowed')"
            oninput="this.setCustomValidity('')"
            autocomplete="given-name"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
         

            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

        <!--  Lastname -->
          <div class="w-1/2">
            <label for="lastname" class="block text-sm font-medium text-white">Last Name</label>
            <input
             placeholder="ejemplo: Perez" 
             id="lastname" 
             type="text" 
             name="lastname" 
             value="<?php echo e(old('lastname')); ?>" 
             required 
             autocomplete="lastname"
             minlength="2" 
             maxlength="20"
             pattern="[A-Za-zÀ-ÿ\s]+"
             title="Only letters are allowed"
             oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Name is required' : 'Only letters are allowed')"
             oninput="this.setCustomValidity('')"
             autocomplete="lastname"
             class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
             <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-white">Email</label>
          <input
          placeholder="email@ejemplo.com" 
          id="email" 
          type="email" 
          name="email"
          value="<?php echo e(old('email')); ?>" 
          maxlength="100"
          required 
          autocomplete="email"
          oninvalid="this.setCustomValidity('Please enter a valid email address')"
          oninput="this.setCustomValidity('')"
          class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password -->
<div class="relative">
  <label for="password" class="block text-sm font-medium text-white">Password</label>
  
  <input 
    placeholder="password" 
    id="password" 
    type="password" 
    name="password" 
    required 
    autocomplete="new-password"
    minlength="8"
    maxlength="64"
    class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400 pr-10">
  
  <!-- Botón ojito -->
  <button 
    type="button" 
    onclick="togglePassword('password', this)" 
    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200"
    title="Show password">
    <!-- Ícono del ojo -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.008 9.963 7.178.07.21.07.432 0 .643C20.573 16.49 16.638 19.5 12 19.5c-4.639 0-8.577-3.008-9.964-7.178z" />
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  </button>

  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Confirm Password -->
<div class="relative mt-4">
  <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
  
  <input 
    placeholder="confirm password" 
    id="password_confirmation" 
    type="password" 
    name="password_confirmation"
    required 
    autocomplete="new-password"
    minlength="8" 
    maxlength="64"
    class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400 pr-10">
  
  <!-- Botón ojito -->
  <button 
    type="button" 
    onclick="togglePassword('password_confirmation', this)" 
    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200"
    title="Show password">
    
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.008 9.963 7.178.07.21.07.432 0 .643C20.573 16.49 16.638 19.5 12 19.5c-4.639 0-8.577-3.008-9.964-7.178z" />
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  </button>

  <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- JS para mostrar/ocultar -->
<script>
  function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";
    btn.querySelector("svg").classList.toggle("opacity-50");
  }
</script>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
          <a href="<?php echo e(route('login')); ?>" class="text-sm text-white underline hover:text-gray-300">
            Already registered?
          </a>

          <button type="submit"
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
            Register
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/auth/register.blade.php ENDPATH**/ ?>
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

        <!-- Name y Lastname -->
        <div class="flex gap-4">
          <div class="w-1/2">
            <label for="name" class="block text-sm font-medium text-white">Name</label>
            <input placeholder="ejemplo: Juan" id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus autocomplete="name"
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

          <div class="w-1/2">
            <label for="lastname" class="block text-sm font-medium text-white">Last Name</label>
            <input placeholder="ejemplo: Perez" id="lastname" type="text" name="lastname" value="<?php echo e(old('lastname')); ?>" required autocomplete="family-name"
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
          <input placeholder="email@ejemplo.com" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="username"
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
        <div>
          <label for="password" class="block text-sm font-medium text-white">Password</label>
          <input placeholder="password" id="password" type="password" name="password" required autocomplete="new-password"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
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
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
          <input placeholder="confirm password" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
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
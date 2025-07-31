<?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-900">

    <h1 class="text-white text-4xl mb-6">Login</h1>

    
    <?php if(session('status')): ?>
        <div class="mb-4 font-medium text-sm text-green-600">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="w-full sm:max-w-md px-6 py-4 bg-[#121212] shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            
            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input id="email" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="email@example.com" required autofocus autocomplete="username">
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

            
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input id="password" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" type="password" name="password" placeholder="password" required autocomplete="current-password">
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

            
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-white">Remember me</span>
                </label>
            </div>

            
            <div class="flex items-center justify-end mt-4">
                <?php if(Route::has('password.request')): ?>
                    <a class="text-sm text-white underline hover:text-gray-300" href="<?php echo e(route('password.request')); ?>">
                        Forgot your password?
                    </a>
                <?php endif; ?>

                <button type="submit" class="ml-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Log in
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/auth/login.blade.php ENDPATH**/ ?>
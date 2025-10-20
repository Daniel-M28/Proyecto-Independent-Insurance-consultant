

<?php $__env->startSection('title', 'Error 403'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center">
    <img src="<?php echo e(asset('imgs/error.png')); ?>" alt="Error 403" class="w-48 md:w-64 mb-6 mt-24">

    <h1 class="text-4xl font-bold mb-3 text-gray-100">Acceso denegado</h1>

    <p class="text-gray-400 mb-8 max-w-md">
        No tienes permiso para acceder a esta sección.  
        Si crees que se trata de un error, contacta con el administrador.
    </p>

    <a href="<?php echo e(url('/')); ?>" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
        Volver al inicio
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/errors/403.blade.php ENDPATH**/ ?>
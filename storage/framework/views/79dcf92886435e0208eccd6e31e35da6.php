<?php $__env->startSection('content'); ?>
   <div class="py-12 mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-white text-center">
            <h1 class="text-3xl font-bold">
                <?php echo e(__('Welcome :name', ['name' => Auth::user()->name])); ?>

            </h1>
            <p class="text-lg mt-2 text-gray-300">
                What would you like to do today?
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="<?php echo e(route('certificados.index')); ?>"
                   class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    Generate COI
                </a>

                <a href="#"
                   class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    View My Policy
                </a>

                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
                 <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="px-8 py-4 bg-blue-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                     Users
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/dashboard.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

<?php if(session('status')): ?>
    <div id="alert-status" 
         class="fixed top-4 left-1/2 transform -translate-x-1/2 
                bg-green-600 text-white p-4 rounded mb-4 text-center shadow-lg 
                z-50 w-[90%] md:w-auto">
        <?php echo e(session('status')); ?>

    </div>

    <script>
        setTimeout(() => {
            const alertBox = document.getElementById('alert-status');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 400); // elimina después del fade
            }
        }, 3000); 
    </script>
<?php endif; ?>



   <div class="py-12 mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-white text-center">
            <h1 class="text-3xl font-bold">
                <?php echo e(__('Welcome :name', ['name' => Auth::user()->name])); ?>

            </h1>
            <p class="text-lg mt-2 text-gray-300">
                What would you like to do today?
            </p>

           <div 
  class="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?> 
            mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-6xl mx-auto 
         <?php else: ?> 
            mt-8 flex justify-center gap-6 flex-wrap 
         <?php endif; ?>">

    
    <a href="<?php echo e(route('certificados.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-blue-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Generate COI
    </a>

    <a href="<?php echo e(route('policies.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        View My Policy
    </a>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users.index')): ?>
    <a href="<?php echo e(route('admin.users.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Users
    </a>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
    <a href="<?php echo e(route('admin.regulatorios')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
       Regulatory
    </a>

    <a href="<?php echo e(route('admin.factoring')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Factoring
    </a>

    <a href="<?php echo e(route('admin.commercial.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Commercial Quotes
    </a>

    <a href="<?php echo e(route('admin.personal-quotes.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Personal Quotes
    </a>

    <a href="<?php echo e(route('admin.new-company.index')); ?>"
       class="w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        New Companies
    </a>
    <?php endif; ?>
</div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/dashboard.blade.php ENDPATH**/ ?>
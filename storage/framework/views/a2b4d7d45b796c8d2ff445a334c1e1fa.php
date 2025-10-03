

<?php $__env->startSection('content'); ?>
<div class="container mt-24 mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold mb-6 text-center text-white">Factoring Requests</h1>

   <?php if(session('error')): ?>
    <div class="mb-4 p-3 bg-red-600 text-white rounded shadow">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
    <!-- Tabla -->
    <div class="overflow-x-auto rounded-lg shadow-inner">
        <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
            <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                <tr class="divide-x divide-zinc-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Lastname</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Observations</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700 text-sm">
                <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4"><?php echo e($request->id); ?></td>
                        <td class="px-6 py-4"><?php echo e($request->name); ?></td>
                        <td class="px-6 py-4"><?php echo e($request->last_name); ?></td>
                        <td class="px-6 py-4"><?php echo e($request->email); ?></td>
                        <td class="px-6 py-4"><?php echo e($request->phone_number); ?></td>

                        <td class="px-6 py-4 max-w-xs truncate" title="<?php echo e($request->observations); ?>">
                            <?php echo e(\Illuminate\Support\Str::limit($request->observations, 20, '...')); ?>

                        </td>

                        <td class="px-6 py-4"><?php echo e(\Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i')); ?></td>

                        <td class="px-6 py-4 flex justify-center">
                            
                            <form action="<?php echo e(route('factorings.destroy', $request->id)); ?>" method="POST" 
                                  onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">
                            No requests found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-6 flex justify-center">
            <?php echo e($requests->links()); ?>

        </div>
    </div>

    <!-- Botón back -->
    <div class="mt-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/factoring/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<div class="mt-24 max-w-7xl mx-auto p-6 bg-zinc-900 text-gray-100 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-center">Regulatory Requests</h1>


    <?php if(session('success')): ?>
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
    


    <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-600 text-white rounded shadow">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
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
                <?php $__empty_1 = true; $__currentLoopData = $regulatorios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4"><?php echo e($item->id); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->name); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->last_name); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->email); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->phone_number); ?></td>
                        <td class="px-6 py-4 max-w-xs truncate" title="<?php echo e($item->observations); ?>">
                            <?php echo e($item->observations ?? '—'); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php echo e(\Carbon\Carbon::parse($item->created_at)->timezone('America/Bogota')->format('d/m/Y H:i')); ?>

                        </td>

                        <td class="px-6 py-4 flex justify-center">
                            
                            <?php if(auth()->user()->hasRole('administrador')): ?>
                                <form action="<?php echo e(route('regulatorios.destroy', $item->id)); ?>" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this request?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <tr>
                        <td colspan="8" class="px-6 py-6 text-gray-400 ">
                            No request found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 flex justify-center">
        <?php echo e($regulatorios->links()); ?>

    </div>
</div>


<div class="mt-6">
    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to Dashboard</a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/regulatorios/index.blade.php ENDPATH**/ ?>
 

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="mt-12 mb-4 p-3 bg-green-600 text-white rounded">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="mt-24 max-w-7xl mx-auto p-6 bg-zinc-900 text-gray-100 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-center">Solicitudes de Regulatorios</h1>

    <?php if($regulatorios->count()): ?>
        <div class="overflow-x-auto rounded-lg shadow-inner">
            <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
                <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                    <tr class="divide-x divide-zinc-600">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Lastname</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Phone</th>
                        <th class="px-6 py-3">Observaciones</th>
                        <th class="px-6 py-3">Fecha</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-700 text-sm">
                    <?php $__currentLoopData = $regulatorios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                            <td class="px-6 py-4"><?php echo e($item->id); ?></td>
                            <td class="px-6 py-4"><?php echo e($item->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($item->last_name); ?></td>
                            <td class="px-6 py-4"><?php echo e($item->email); ?></td>
                            <td class="px-6 py-4"><?php echo e($item->phone_number); ?></td>
                            <td class="px-6 py-4 max-w-xs truncate" title="<?php echo e($item->observations); ?>">
                                <?php echo e($item->observations ?? '—'); ?>

                            </td>
                            <td class="px-6 py-4"><?php echo e(\Carbon\Carbon::parse($item->created_at)->timezone('America/Bogota')->format('d/m/Y H:i')); ?></td>

                            <td class="px-6 py-4 flex justify-center">
                                
                                <form action="<?php echo e(route('regulatorios.destroy', $item->id)); ?>" method="POST" 
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            <?php echo e($regulatorios->links()); ?>

        </div>
    <?php else: ?>
        <p class="text-gray-400">No hay solicitudes registradas aún.</p>
    <?php endif; ?>

</div>

<!-- Botón back -->
<div class="mt-6">
    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to list</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/regulatorios/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<h1 class="mt-12 text-3xl font-semibold text-white">Editar usuario</h1>

<div class="bg-zinc-800 rounded-lg shadow-md p-6">
    <div>   
            <div class="bg-zinc-800 p-6 rounded-lg">
    <p class="text-lg font-semibold text-white mb-2">Nombre:</p>
    <p class="bg-zinc-900 p-3 rounded text-white border border-zinc-700"><?php echo e($user->name); ?></p>

    <h2 class="text-lg font-semibold text-white mt-6 mb-2">Listado de roles</h2>

    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid gap-2">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="inline-flex items-center text-white">
                    <input
                        type="checkbox"
                        name="roles[]"
                        value="<?php echo e($role->id); ?>"
                        class="mr-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        <?php echo e($user->roles->contains($role->id) ? 'checked' : ''); ?>

                    >
                    <?php echo e($role->name); ?>

                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button type="submit"
            class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Asignar rol
        </button>
    </form>
</div>

        </p>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>
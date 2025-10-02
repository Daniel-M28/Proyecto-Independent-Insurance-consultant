

<?php $__env->startSection('content'); ?>
<h1 class="mt-12 text-3xl font-semibold text-white">Editar usuario</h1>

<div class="bg-zinc-800 rounded-lg shadow-md p-6">
    <div class="bg-zinc-800 p-6 rounded-lg">

        <!-- Formulario de edición -->
        <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-white">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php echo e(old('name', $user->name)); ?>"
                    class="mt-1 block w-full bg-zinc-900 border border-zinc-700 text-white rounded-md shadow-sm focus:ring-indigo-500"
                >
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Apellido (opcional si lo manejas en tu modelo) -->
            <div class="mb-4">
                <label for="lastname" class="block text-sm font-medium text-white">Apellido</label>
                <input
                    id="lastname"
                    name="lastname"
                    type="text"
                    value="<?php echo e(old('lastname', $user->lastname)); ?>"
                    class="mt-1 block w-full bg-zinc-900 border border-zinc-700 text-white rounded-md shadow-sm focus:ring-indigo-500"
                >
                <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Listado de roles -->
            <h2 class="text-lg font-semibold text-white mt-6 mb-2">Listado de roles</h2>
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

            <!-- Botón -->
            <button type="submit"
                class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar cambios
            </button>
        </form>
    </div>
</div>
<!-- Botón back -->
    <div class="mt-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to list</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>
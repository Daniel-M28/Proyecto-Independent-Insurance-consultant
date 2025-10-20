

<?php $__env->startSection('content'); ?>

<div class="container mx-auto px-4 mt-12 text-gray-100 bg-zinc-900 rounded-lg py-6 shadow-lg">
    <h2 class="mb-6 text-3xl font-semibold text-center">List of Users</h2>

    
    <div class="mb-6 flex items-center">
        <!-- Botón Crear Usuario -->
        <a href="<?php echo e(route('admin.users.create')); ?>"
           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow mr-4">
            + New user
        </a>

        
        <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="flex justify-center flex-1">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Search by first or last name"
                class="w-1/2 px-4 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-l-md 
                       focus:outline-none focus:ring-blue-500 placeholder-gray-400"
            />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
                Buscar
            </button>
        </form>
    </div>
    


<?php if(session('success')): ?>
    <div class="mb-4 p-3 bg-green-600 text-white rounded shadow">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('info')): ?>
    <div class="mb-4 p-3 bg-blue-600 text-white rounded shadow">
        <?php echo e(session('info')); ?>

    </div>
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
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Apellido</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Fecha de registro</th>
                    <th class="px-6 py-3">Rol</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700 text-sm">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4"><?php echo e($user->id); ?></td>
                        <td class="px-6 py-4"><?php echo e($user->name); ?></td>
                        <td class="px-6 py-4"><?php echo e($user->lastname); ?></td>
                        <td class="px-6 py-4"><?php echo e($user->email); ?></td>
                        <td class="px-6 py-4"><?php echo e($user->created_at->format('d-m-Y')); ?></td>
                        <td class="px-6 py-4"><?php echo e($user->roles->first()?->name ?? 'Sin rol'); ?></td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            
                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                               class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                view
                            </a>

                            
                            <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                    delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-400">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 flex justify-center pagination">
        <?php echo e($users->links()); ?>

    </div>

</div>

<!-- Botón back -->
<div class="mt-6">
    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to dashboard</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/users/index.blade.php ENDPATH**/ ?>
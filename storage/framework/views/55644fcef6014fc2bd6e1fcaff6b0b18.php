

<?php $__env->startSection('content'); ?>
<div class="mt-24 max-w-7xl mx-auto p-6 bg-zinc-900 text-gray-100 rounded-lg shadow">

    <h1 class="text-3xl font-bold mb-6 text-center">Company Requests</h1>

    
    <?php if(session('success')): ?>
        <div class="bg-green-600 text-white p-3 rounded mb-4 text-center"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-600 text-white rounded shadow text-center">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto rounded-lg shadow-inner">
        <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
            <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                <tr class="divide-x divide-zinc-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Owner</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Company Names</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Advisor</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-zinc-700 text-sm">
                <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4"><?php echo e($company->id); ?></td>
                        <td class="px-6 py-4"><?php echo e($company->owner_first_name); ?> <?php echo e($company->owner_last_name); ?></td>
                        <td class="px-6 py-4"><?php echo e($company->phone); ?></td>
                        <td class="px-6 py-4"><?php echo e($company->email); ?></td>
                        <td class="px-6 py-4">
                            <?php echo e($company->company_name_1); ?>, <?php echo e($company->company_name_2); ?>, <?php echo e($company->company_name_3); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php echo e(\Carbon\Carbon::parse($company->created_at)->timezone('America/Bogota')->format('Y-m-d H:i')); ?>

                        </td>

                        
                        <td class="px-6 py-4">
                            <?php if($company->users->isNotEmpty()): ?>
                                <?php echo e($company->users->first()->name); ?>

                            <?php else: ?>
                                <span class="text-gray-400">Not assigned</span>
                            <?php endif; ?>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 justify-center">
                                
                                <a href="<?php echo e(route('admin.new-company.show', $company->id)); ?>"
                                   class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                    View
                                </a>

                                
                                <?php if(auth()->user()->hasRole('administrador')): ?>
                                    <button onclick="openModal(<?php echo e($company->id); ?>)"
                                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-md">
                                        Asiggn
                                    </button>

                                    
                                    <form action="<?php echo e(route('admin.new-company.destroy', $company->id)); ?>" method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta solicitud?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                            Delete
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">No company requests yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 flex justify-center">
        <?php echo e($companies->links()); ?>

    </div>

    
    <div class="mt-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to dashboard</a>
    </div>
</div>


<div id="assignModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-zinc-800 rounded-lg shadow-lg p-6 w-full max-w-md text-white">
        <h2 class="text-xl font-semibold mb-4">Assign advisor</h2>

        <form id="assignForm" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="asesor_id" class="block mb-1 text-sm text-gray-300">Select advisor:</label>
                <select name="asesor_id" id="asesor_id"
                        class="w-full bg-zinc-700 border border-zinc-600 rounded-md p-2 text-white">
                    
                    <option value="">— Not assigned —</option>

                    <?php $__currentLoopData = $asesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($asesor->id); ?>"><?php echo e($asesor->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md text-sm">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-sm">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>


<script>
function openModal(id) {
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');
    const routeTemplate = "<?php echo e(route('admin.new-company.assign', ['id' => ':id'])); ?>";
    form.action = routeTemplate.replace(':id', id);

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('assignModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/new-company/index.blade.php ENDPATH**/ ?>
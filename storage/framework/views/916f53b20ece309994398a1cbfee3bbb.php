

<?php $__env->startSection('content'); ?>
<div class="p-6 max-w-7xl mx-auto mt-24 text-white space-y-6">
    <h1 class="text-3xl font-bold mb-6">Company Request #<?php echo e($company->id); ?></h1>

    <!-- Contenedor flex para listas lado a lado -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Lista 1: Datos del propietario -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Owner Information</h2>
            <ul class="space-y-1">
                <li><strong>Name:</strong> <?php echo e($company->owner_first_name); ?> <?php echo e($company->owner_last_name); ?></li>
                <li><strong>SSN:</strong> <?php echo e($company->ssn); ?></li>
                <li><strong>Phone:</strong> <?php echo e($company->phone); ?></li>
                <li><strong>Email:</strong> <?php echo e($company->email); ?></li>
                <li><strong>Date of Birth:</strong> <?php echo e($company->dob); ?></li>
            </ul>
        </div>

        <!-- Lista 2: Detalles de la empresa / solicitud -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Company / Request Details</h2>
            <ul class="space-y-1">
                <li><strong>Company Names:</strong> <?php echo e($company->company_name_1); ?>, <?php echo e($company->company_name_2); ?>, <?php echo e($company->company_name_3); ?></li>
                <li><strong>Business Address:</strong> <?php echo e($company->business_address); ?></li>
                <li><strong>Cargo Type:</strong> <?php echo e($company->cargo_type); ?></li>
                <li><strong>Operation Type:</strong> <?php echo e($company->operation_type); ?></li>
                <li><strong>Vehicle Type:</strong> <?php echo e($company->vehicle_type); ?></li>
                <li><strong>Observations:</strong> <?php echo e($company->observations ?? 'N/A'); ?></li>
            </ul>
        </div>
    </div>

    <!-- Licencias / Documentos -->
    <div class="bg-zinc-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Licenses / Documents</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php if(!empty($company->licenses) && count($company->licenses) > 0): ?>
                <?php $__currentLoopData = $company->licenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Str::endsWith($file, ['jpg','jpeg','png'])): ?>
                        <img 
                            src="<?php echo e(asset('storage/' . $file)); ?>" 
                            class="w-full h-48 object-cover rounded shadow cursor-pointer" 
                            onclick="openModal('<?php echo e(asset('storage/' . $file)); ?>')"
                        >
                    <?php else: ?>
                        <a href="<?php echo e(asset('storage/' . $file)); ?>" target="_blank" class="text-blue-400 underline break-all">
                            <?php echo e(basename($file)); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>No files uploaded.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Botón back -->
    <div class="mt-6">
        <a href="<?php echo e(route('admin.new-company.index')); ?>" class="text-gray-400 hover:underline">← Back to list</a>
    </div>
</div>

<!-- Modal para imágenes -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
    <span class="absolute top-4 right-6 text-white text-3xl cursor-pointer" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" class="max-h-[90vh] max-w-[90vw] rounded shadow-lg">
</div>

<script>
    function openModal(src) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera de la imagen
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if(e.target.id === 'imageModal') closeModal();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/new-company/show.blade.php ENDPATH**/ ?>
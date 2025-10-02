

<?php $__env->startSection('content'); ?>
<div class="p-6 max-w-7xl mx-auto mt-24 text-white space-y-6">
    <h1 class="text-3xl font-bold mb-6">Request #<?php echo e($request->id); ?></h1>

    <!-- Contenedor flex para listas lado a lado -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Lista 1: Datos del cliente -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
            <ul class="space-y-1">
                <li><strong>Name:</strong> <?php echo e($request->name); ?> <?php echo e($request->lastname); ?></li>
                <li><strong>Phone:</strong> <?php echo e($request->phone); ?></li>
                <li><strong>Email:</strong> <?php echo e($request->email); ?></li>
                <li><strong>Business address:</strong> <?php echo e($request->business_address); ?></li>
            </ul>
        </div>

        <!-- Lista 2: Detalles del vehículo / solicitud -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Vehicle / Request Details</h2>
            <ul class="space-y-1">
                <li><strong>USDOT:</strong> <?php echo e($request->usdot); ?></li>
                <li><strong>VIN(s):</strong> <?php echo e($request->vin); ?></li>
                <li><strong>Parking Yard:</strong> <?php echo e($request->yard ?? 'N/A'); ?></li>
                <li><strong>Miles:</strong> <?php echo e($request->miles ?? 'N/A'); ?></li>
                <li><strong>Type of load:</strong> <?php echo e($request->type_of_load ?? 'N/A'); ?></li>
                <li><strong>Coverages:</strong> <?php echo e($request->coverages ? implode(', ', $request->coverages) : 'N/A'); ?></li>
                <li><strong>Comments:</strong> <?php echo e($request->comments ?? 'N/A'); ?></li>
            </ul>
        </div>
    </div>

    <!-- Licencias / Documentos -->
    <div class="bg-zinc-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Licenses / Documents</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php if($request->licenses): ?>
                <?php $__currentLoopData = $request->licenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
</div>

 <!-- Botón back -->
    <div class="mt-6">
        <a href="<?php echo e(route('admin.commercial.index')); ?>" class="text-gray-400 hover:underline">← Back to list</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/admin/commercial/show.blade.php ENDPATH**/ ?>
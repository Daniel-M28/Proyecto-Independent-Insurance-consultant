

<?php $__env->startSection('content'); ?>
<div class="mt-24 flex justify-center mt-10">
    <div class="w-full max-w-5xl bg-zinc-800 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-6 text-center">Policy Management</h1>

        <?php if(session('success')): ?>
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
            
            <form method="GET" action="<?php echo e(route('policies.index')); ?>" class="flex justify-center flex-1 mb-6">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search user by name or email"
                    class="w-1/2 px-4 py-2 bg-zinc-700 border border-zinc-700 text-white rounded-l-md focus:outline-none placeholder-gray-400" />
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Search</button>
            </form>

            <?php if(!empty($results)): ?>
                <div class="bg-zinc-900 p-4 rounded-lg mb-6">
                    <h2 class="text-white text-lg mb-3">Results:</h2>
                    <ul class="space-y-2">
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">
                                <div>
                                    <p class="text-white font-semibold"><?php echo e($r->name); ?></p>
                                    <p class="text-gray-400 text-sm"><?php echo e($r->email); ?></p>
                                </div>
                                <a href="<?php echo e(route('policies.index',['user_id'=>$r->id])); ?>"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">See policy</a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <?php if($user): ?>
                <form method="POST" action="<?php echo e(route('policies.store')); ?>" enctype="multipart/form-data" onsubmit="return confirmarReemplazo()">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                    <label class="text-white block mb-2">Upload policy <?php echo e($user->name); ?> <?php echo e($user->lastname); ?></label>
                    <input type="file" name="file" accept="application/pdf" required class="block w-full text-white bg-zinc-800 border border-zinc-700 rounded-lg p-2">
                    <button type="submit" class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Upload policy</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>

       
<div id="pdfContainer" class="mt-10">

    <?php if($policy): ?>
        <iframe src="<?php echo e(asset('storage/' . $policy->file_path)); ?>" class="w-full h-[700px] rounded-lg"></iframe>
    <?php else: ?>
        <p class="text-gray-400 text-center mt-10">There is no policy assigned yet.</p>
    <?php endif; ?>

    
    <div class="flex justify-between items-center mt-6">
        
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to dashboard</a>

        
        <?php if($policy): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                <form method="POST" action="<?php echo e(route('policies.destroy',$policy->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                            onclick="return confirm('¿Deseas eliminar esta póliza?')">
                        Eliminar Póliza
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>

<script>
function confirmarReemplazo(){
    <?php if($policy): ?>
        return confirm('This user already has a policy. Would you like to replace it?');
    <?php endif; ?>
    return true;
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/policies/index.blade.php ENDPATH**/ ?>
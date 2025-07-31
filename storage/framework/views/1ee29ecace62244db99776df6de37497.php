<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
        <ul class="inline-flex items-center space-x-1">
            
            <?php if($paginator->onFirstPage()): ?>
                <li>
                    <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md cursor-not-allowed">
                         Anterior
                    </span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>"
                       class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md hover:bg-blue-700">
                         Anterior
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li>
                        <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md">
                            <?php echo e($element); ?>

                        </span>
                    </li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li>
                                <span class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md font-semibold">
                                    <?php echo e($page); ?>

                                </span>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>"
                                   class="px-4 py-2 bg-zinc-800 text-gray-300 border border-zinc-600 rounded-md hover:bg-blue-600 hover:text-white">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>"
                       class="px-4 py-2 bg-blue-600 text-white border border-zinc-600 rounded-md hover:bg-blue-700">
                        Siguiente 
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <span class="px-4 py-2 bg-zinc-700 text-gray-400 border border-zinc-600 rounded-md cursor-not-allowed">
                         
                    </span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>
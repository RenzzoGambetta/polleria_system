<?php if($paginator->hasPages()): ?>
    <ul class="pagination-an">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="Anterior" >
                <span class="page-link" id="centra"  style='color:#bb0e0e' aria-hidden="true"> <i class='bx bxs-arrow-from-right'></i>Anterior</span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" id="centra"  href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="Anterior"><i class='bx bxs-arrow-from-left bx-rotate-180' ></i>Anterior</a>
            </li>
        <?php endif; ?>

    </ul>
<?php endif; ?>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>
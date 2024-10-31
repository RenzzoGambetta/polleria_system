<?php if($paginator->hasPages()): ?>
    <ul class="pagination_si">

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" id="centra" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="Siguiente"> Siguiente <i class='bx bxs-arrow-from-left'></i></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="Siguiente">
                <span class="page-link" id="centra"  style='color:#bb0e0e' aria-hidden="true"> Siguiente <i class='bx bxs-arrow-from-left'></i></span>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/vendor/pagination/anterior.blade.php ENDPATH**/ ?>
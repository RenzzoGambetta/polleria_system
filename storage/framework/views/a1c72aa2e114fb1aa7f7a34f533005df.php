<?php if($paginator->hasPages()): ?>
    <ul class="pagination_nu" id="centra" >
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled icon-pagination" aria-disabled="true" aria-label="Anterior">
                <span class="page-link" aria-hidden="true"><i class='bx bx-caret-left' style='color:#bb0e0e' ></i></span>
            </li>
        <?php else: ?>
            <li class="page-item icon-pagination">
                <a class="page-link" id="icon_paginacion" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="Anterior"><i class='bx bx-caret-left bx-flashing' ></i></a>
            </li>
        <?php endif; ?>

        
        <?php for($i = 1; $i <= $paginator->lastPage(); $i++): ?>
            <?php if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2): ?>
                <li id="<?php echo e(($i == $paginator->currentPage()) ? 'border_ac' : 'border'); ?>">
                    <a  class="page-link" id="<?php echo e(($i == $paginator->currentPage()) ? 'nu_text_ac' : 'nu_text'); ?>"  href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item icon-pagination">
                <a class="page-link" id="icon_paginacion" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="Siguiente"><i class='bx bx-caret-right bx-flashing' ></i></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled icon-pagination" aria-disabled="true" aria-label="Siguiente">
                <span class="page-link" aria-hidden="true"><i class='bx bx-caret-right' style='color:#bb0e0e'  ></i></span>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/vendor/pagination/numeros.blade.php ENDPATH**/ ?>
<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="<?php echo e(asset($EmployeeRecordDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($PaginationStyle)); ?>">
<div class="btn-mobile mobile">
    <a href="<?php echo e(route('show_panel_register_entry')); ?>"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Inventario</h1>
        <ul class="breadcrumb">

            <a href="<?php echo e(route('inventory')); ?>" class="active">
                todos
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                <?php echo e(__('Lista de :from al :to de un total de :total   ', ['from' => $Inventory->firstItem(), 'to' => $Inventory->lastItem(), 'total' => $Inventory->total()])); ?>

            </a>

        </ul>
    </div>
</div>

<input type="checkbox" id="theme-toggle" hidden>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>
            <a href="<?php echo e(route('show_panel_register_entry')); ?>" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Data</th>
                    <th>Data</th>
                    <th>Data</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $Inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Inventories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>-------</td>
                        <td>-------</td>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
</div>

<section class="paginacion">
    <?php echo e($Inventory->onEachSide(1)->links('pagination::custom')); ?>

    <?php echo e($Inventory->onEachSide(1)->links('pagination::numeros')); ?>

    <?php echo e($Inventory->onEachSide(1)->links('pagination::anterior')); ?>

</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/inventory_management/inventory.blade.php ENDPATH**/ ?>
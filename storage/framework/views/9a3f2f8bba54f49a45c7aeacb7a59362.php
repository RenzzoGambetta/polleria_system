<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="<?php echo e(asset($EmployeeRecordDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($PaginationStyle)); ?>">

<div class="btn-mobile mobile">
    <a href="<?php echo e(route('role_register')); ?>"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Roles de Trabajo</h1>
        <ul class="breadcrumb">
            <a href="<?php echo e(route('user')); ?>" class="sub-link">
                Usuario
            </a>
            <li>
                /
            </li>
            <a href="<?php echo e(route('employeer')); ?>" class="active">
                todo
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                <?php echo e(__('Lista de :from al :to de un total de :total  roles ', ['from' => $Roles->firstItem(), 'to' => $Roles->lastItem(), 'total' => $Roles->total()])); ?>

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
            <a href="<?php echo e(route('role_register')); ?>" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acceso</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $Roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rol->id ?? 'No registrado'); ?></td>
                        <td><?php echo e($rol->name ?? 'No registrado'); ?></td>
                        <td>Sin data</td>
                        <td>Sin data</td>
                        <td>No asignado</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
</div>

<section class="paginacion">
    <?php echo e($Roles->onEachSide(1)->links('pagination::custom')); ?>

    <?php echo e($Roles->onEachSide(1)->links('pagination::numeros')); ?>

    <?php echo e($Roles->onEachSide(1)->links('pagination::anterior')); ?>

</section>

<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/user_management/role.blade.php ENDPATH**/ ?>
<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="<?php echo e(asset($EmployeeRecordDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($PaginationStyle)); ?>">

<div class="btn-mobile mobile">
    <a href="<?php echo e(route('employeer_register')); ?>"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Empleados</h1>
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
                <?php echo e(__('Lista de :from al :to de un total de :total   ', ['from' => $List->firstItem(), 'to' => $List->lastItem(), 'total' => $List->total()])); ?>

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
            <a href="<?php echo e(route('employeer_register')); ?> " class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Nacimiento</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $List; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $List_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($List_->person->dni ?? 'No registrado'); ?></td>
                        <td><?php echo e($List_->person->firstname ?? 'No registrado'); ?></td>
                        <td><?php echo e($List_->person->lastname ?? 'No registrado'); ?></td>
                        <td><?php echo e($List_->person->phone ?? 'No registrado'); ?></td>
                        <td><?php echo e($List_->awd ?? 'No registrado'); ?></td>
                        <td><?php echo e($List_->awd ?? 'No registrado'); ?></td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
</div>
<section class="paginacion">
    <?php echo e($List->onEachSide(1)->links('pagination::custom')); ?>

    <?php echo e($List->onEachSide(1)->links('pagination::numeros')); ?>

    <?php echo e($List->onEachSide(1)->links('pagination::anterior')); ?>

</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/user_managment/employee.blade.php ENDPATH**/ ?>
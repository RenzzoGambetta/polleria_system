<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="<?php echo e(asset($EmployeeRecordDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($RoleRegisterDesktop)); ?>">

<div class="header">
    <div class="left">
        <h1>Registro de nuevo Rol</h1>
        <ul class="breadcrumb">

            <a href="<?php echo e(route('position')); ?>" class="sub-link">
                roles
            </a>
            <li>
                /
            </li>
            <a href="#" class="pagina" class="active">
                nuevo
            </a>

        </ul>
    </div>
</div>
<form action="<?php echo e(route('role_register_store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="name-input container">

        <div id="dimensions name-input">
            <input type="submit" class="button-opcion previous" value="Cancelar">
            <div class="input-group name-input">
                <input type="text" id="name" class="effect-1" name="name" placeholder="Nombre de Rol" value="" />
                <span class="border"></span>
            </div>
            <input type="submit" class="button-opcion next" value="Registrar">
        </div>

    </div>

    <div class="input-group">

        <div class="title_categories_primary">Permisos</div>
        <div class="input-group">
            <div class="check container">
                <?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories => $permissionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="dimensions" class="apo">
                        <div class="checkbox checkbox-1">
                            <input type="checkbox" id="<?php echo e($categories); ?>" />
                            <label for="<?php echo e($categories); ?>" class="title_categories"><?php echo e($categories); ?></label>
                        </div>
                        <div id="<?php echo e($categories); ?>" class="sub-rol">
                            <?php $__currentLoopData = $permissionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="checkbox checkbox-1">
                                    <input type="checkbox" id="C_<?php echo e($permission->name); ?>" name="permissions[]" value="<?php echo e($permission->id); ?>" />
                                    <label for="C_<?php echo e($permission->name); ?>" class="sub_categories"><?php echo e($permission->name); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</form>

<script src="<?php echo e(asset($RoleRegistrationButtonActions)); ?>"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/user_managment/role_register.blade.php ENDPATH**/ ?>
<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="<?php echo e(asset($EmployeeRecordDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($Form)); ?>">
<script src="<?php echo e($JquerySrc); ?>" integrity="<?php echo e($JqueryIntegrity); ?>" crossorigin="<?php echo e($JqueryCrossorigin); ?>"></script>

<div class="header">
    <div class="left">
        <h1>Nuevo usuario</h1>
        <ul class="breadcrumb">
            <a href="<?php echo e(route('user')); ?>" class="sub-link">
                Usuario
            </a>
            <li>
                /
            </li>
            <a href="<?php echo e(route('employeer_register')); ?>" class="active">
                Registro
            </a>

        </ul>
    </div>
</div>

<section>
    <section class="form_pos1">
        <div id="Sentral">
            <section id="miFormulario">
                <?php if(session()->has('Ms')): ?>
                    <div class = "ms_dt">
                        <h4 class = "ms_tp">Alert:</h4>
                        <h2 class = "ms_txt"><?php echo e(session('Ms')); ?></h2>
                    </div>
                <?php endif; ?>

                <div class = "ms_rr active hide-element">
                    <h4 class = "ms_tp">Alert:</h4>
                    <h2 class = "ms_txt">Completa los campos vacios</h2>
                </div>
                <div class = "ms_bx active hide-element">
                    <h4 class = "ms_tp">Alert:</h4>
                    <h2 class = "ms_txt"> ms_txt </h2>
                </div>
            </section>
        </div>

    </section>

    <form method="post" action="<?php echo e(route('user_register_store')); ?>">
        <?php echo csrf_field(); ?>
        <section class="form_pos">

            <section class="form_pos2">
                <h1 class="text-center title-form-h1">Formulario <i class='bx bxs-user-voice'></i></h1>
                <!-- Progress bar -->
                <div class="progressbar two-frame">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Definir rol"></div>
                    <div class="progress-step" data-title="Generar acceso"></div>
                </div>



                <div class="form-step form-step-active">

                    <div class="row">
                        <div class="select">
                            <div class="employers">
                                <?php $__currentLoopData = $Employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Employee_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="employer">
                                    <input type="radio" id="<?php echo e($Employee_->id ?? 'not_id'); ?>" name="employer_id" value="<?php echo e($Employee_->id ?? 'not_id'); ?>" />
                                    <span> <?php echo e($Employee_->person->firstname ?? 'No registrado'); ?> </span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </div>
                            <div class="posemployer">Empleado <i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>

                        <div class="select">
                            <div class="roles">
                                <?php $__currentLoopData = $Role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Role_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="role">
                                    <input type="radio" id="<?php echo e($Role_->id ?? 'not_id'); ?>" name="role_id" value="<?php echo e($Role_->id ?? 'not_id'); ?>" />
                                    <span> <?php echo e($Role_->name ?? 'No registrado'); ?> </span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </div>
                            <div class="posrole">Selecciona el rol <i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>
                    </div>


                    <div class="btn-navegation-form">
                        <a href="#" class="btn btn-next width-50 ml-auto">Siguiente</a>
                    </div>
                </div>
                <div class="form-step">

                    <div class="input-group col-md-6 one unique">
                        <input type="text" id="user_name" class="effect-4" name="user_name" placeholder=" " required />
                        <label for="user_name">*Nombre de Usuario</label>
                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="password" id="password_primary" class="effect-4" name="password_primary" placeholder=" " required />
                            <label for="password_primary">*Contraseña</label>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="password" id="password_repeat" class="effect-4" name="password_repeat" placeholder=" " required />
                            <label for="password_repeat">*Repita la Contraseña</label>
                        </div>
                    </div>

                    <div class="btns-group btn-navegation-form-3frem">
                        <a href="#" class="btn btn-prev">Atras</a>
                        <input type="submit" class="btn" id="submitButton" value="Registrar" onclick="validarFormulario(event)" />
                    </div>


                </div>
            </section>

        </section>
    </form>
</section>
<script src="<?php echo e(asset($EffectsAndActionsUserRegister)); ?>"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/user_management/user_register.blade.php ENDPATH**/ ?>
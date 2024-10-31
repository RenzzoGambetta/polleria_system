<!--Encabezado de la pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($HeaderPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---------------------------------------------------------------------->
<script src="<?php echo e($AlertSrc); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset($InventoryRegisterDesktop)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($InventoryRegisterMobile)); ?>">
<link rel="stylesheet" href="<?php echo e(asset($LoadFragment)); ?>">

<div class="header">
    <div class="left">
        <h1 class="title-reducer">Registro de Entrada</h1>
        <ul class="breadcrumb">

            <a href="<?php echo e(route('inventory')); ?>" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="<?php echo e(route('show_panel_register_entry')); ?>" class="active">
                Registro
            </a>

        </ul>
    </div>
</div>

<form id="myForm" action="<?php echo e(route('register_product_entry')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="input-data-form">
        <div class="sub-input-01">
            <?php

                $comment = 'Comentario';

            ?>
            <div class="block-01">
                <div class="lateralside-content sub-block-01">

                    <div class="select">
                        <div class="sub-title-div">
                            <label for="sub-title-select-01" class="sub-title-select">Seleccione un provedor</label>

                        </div>
                        <div class="options">
                            <?php $__currentLoopData = $Suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="<?php echo e($supplier['id']); ?>" class="option">
                                    <input type="radio" name="supplier_id" id="<?php echo e($supplier['id']); ?>" value="<?php echo e($supplier['id']); ?>" />
                                    <span><?php echo e($supplier['name']); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <label for="new" class="option">
                                <input type="radio" name="role" id="new" />
                                <span>Nuevo provedor</span>
                            </label>
                        </div>

                        <div class="selected">Seleccionar un provedor</div>
                    </div>
                </div>
                <div class="lateralside-content sub-block-02">
                    <div class="input-group input-dimensions">
                        <input type="date" id="issue-date-input" class="input-iten effect-5 date-icon" placeholder=" " value="<?php echo e(date('Y-m-d')); ?>">
                        <label for="effect5">Fecha de emision</label>
                    </div>
                </div>

            </div>
            <div class="block-02">
                <div class="wave-group input-dimensions comment">
                    <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="comment" id="comment-input" required=""></textarea>
                    <label class="label">
                        <?php $__currentLoopData = str_split($comment); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="--index: <?php echo e($index); ?>" class="label-char"><?php echo e($char); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </label>
                </div>
            </div>

        </div>

    </div>

    <div class="bottom-data">
        <div class="orders">
            <table class="list-data-product">
                <thead>
                    <tr>
                        <th class="field-size movile-style-th">Producto</th>
                        <th class="data-entry movile-style-th">Unidad</th>
                        <th class="data-entry movile-style-th">C/Unitario</th>
                        <th class="data-entry movile-style-th">C/Total</th>
                        <th class="data-button movile-style-th">Opciones</th>

                    </tr>
                </thead>

                <tbody class="list-inten" id="puntoClave">
                    <td></td>
                    <td></td>
                    <td class="name-iten total-price-and-unit">Total -></td>
                    <td class="total-price-and-unit">
                        <div class="aling-center-displey">
                            <div class="text-aling-preci">s/<span id="total-price">0</span></div>
                        </div>
                    </td>
                </tbody>

            </table>
            <div class="filter">
                <div id="wifi-loader">
                    <svg class="circle-outer" viewBox="0 0 86 86">
                        <circle class="back" cx="43" cy="43" r="40"></circle>
                        <circle class="front" cx="43" cy="43" r="40"></circle>
                        <circle class="new" cx="43" cy="43" r="40"></circle>
                    </svg>
                    <svg class="circle-middle" viewBox="0 0 60 60">
                        <circle class="back" cx="30" cy="30" r="27"></circle>
                        <circle class="front" cx="30" cy="30" r="27"></circle>
                    </svg>
                    <svg class="circle-inner" viewBox="0 0 34 34">
                        <circle class="back" cx="17" cy="17" r="14"></circle>
                        <circle class="front" cx="17" cy="17" r="14"></circle>
                    </svg>
                    <div class="text" data-text="Esperando a que seleccione un provedor"></div>
                </div>
            </div>
        </div>

    </div>
<div>
    <div class="sub-input-02">
        <button  type="button" class="button-opcion-form cancel-option" onclick="cancelPage('<?php echo e(route('inventory')); ?>')"><i class="fi fi-sr-document-circle-wrong icon-option"></i>Cancelar</button>
        <button  type="button" class="button-opcion-form clear-option border-style-right" onclick="clearInput()"><i class="fi fi-sr-broom icon-option"></i>Limpiar</button>
        <button  type="button" class="button-opcion-form element-option" onclick="addItems()"><i class="fi fi-sr-add-document icon-option"></i>Aadir producto</button>
        <button  type="submit" class="button-opcion-form register-option" ><i class="fi fi-sr-registration-paper icon-option"></i>Registrar</button>
        <script src="<?php echo e(asset($FunctionButtonOnclick)); ?>"></script>

    </div>
</div>
</form>
<script src="<?php echo e(asset($OptionSelector)); ?>"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
<?php echo $__env->make($FooterPanel, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!------------------------------------------------------------>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/inventory_management/product_stock_entry.blade.php ENDPATH**/ ?>
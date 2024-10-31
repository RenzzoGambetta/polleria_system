<!DOCTYPE html>
<html lang="<?php echo e($Language); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Brazza</title>

    <!--Icono-->
    <link rel="icon" href="<?php echo e(asset($CompanyLogoIcon)); ?>" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo e(asset($Fonts)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($LoginMobile)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($LoginDesktop)); ?>">


    <!--JS & jQuery-->
    <script src="<?php echo e($JquerySrc); ?>" integrity="<?php echo e($JqueryIntegrity); ?>" crossorigin="<?php echo e($JqueryCrossorigin); ?>"></script>

</head>

<body>
    <div id="container">
        <div class="banner">
            <img src="<?php echo e(asset($SecurityMeaningImage)); ?>" alt="imagem-login"
                id="imagen_login">
            <p style=" font-weight: 400;" id="data_login">
                Solo se permite el acceso a trabajadores o familiares
                de la empresa,<br> esta prohibido el uso inadecuado del
                sistema o su publicaciòn a <br>personas no autorizadas. <br>
                <br>*Solo para uso de la empresa D'Brazza Dorado
            </p>
        </div>

        <div class="box-login">
            <h1 id="sub_title">
                Hola!<br>
                Bienvenidos a D'Brazza.
            </h1>
            <img src="<?php echo e(asset($CompanyLogoIcon)); ?>" alt="Logo" id="logo">
            <form id="form" action='/login' method="POST">
                <div class="box">

                    <?php echo csrf_field(); ?>
                    <input type="text" name="username" id="username" placeholder="Usuario" value="Pablo_caja" required>
                    <input type="password" name="password" id="password" placeholder="Contraseña" value="password123" required>

                    <button>Ingresar</button>


                </div>
            </form>

        </div>
    </div>
</body>

</html>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/auth/login.blade.php ENDPATH**/ ?>
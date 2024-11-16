<!DOCTYPE html>
<html lang="{{ $Language }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Brazza</title>

    <!--Icono-->
    <link rel="icon" href="{{ asset($CompanyLogoIcon) }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset($Fonts) }}">
    <link rel="stylesheet" href="{{ asset($LoginMobile) }}">
    <link rel="stylesheet" href="{{ asset($LoginDesktop) }}">


    <!--JS & jQuery-->
    <script src="{{ asset($JquerySrc) }}"></script>


</head>

<body>
    <div id="container">
        <div class="banner">
            <img src="{{ asset($SecurityMeaningImage) }}" alt="imagem-login"
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
            <img src="{{ asset($CompanyLogoIcon) }}" alt="Logo" id="logo">
            <form id="form" action='/login' method="POST">
                <div class="box">

                    @csrf
                    <input type="text" name="username" id="username" placeholder="Usuario" required>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>

                    <button>Ingresar</button>


                </div>
            </form>

        </div>
    </div>
</body>

</html>

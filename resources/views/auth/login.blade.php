<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Brazza</title>

    <!--Icono-->
    <link rel="icon" href="{{ asset('global_resources/image/logo_polleria.ico') }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('global_resources/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/auth/css/login_desktop.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/auth/css/login_mobile.css') }}">
    
    <!--JS & jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div id="container">
        <div class="banner">
            <img src="{{ asset('resources/auth/image/Seguridad.png') }}" alt="imagem-login"
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
            <img src="{{ asset('global_resources/image/logo_polleria.ico') }}" alt="Logo" id="logo">
            <form id="form" action='/login' method="POST">
                <div class="box">

                    @csrf
                    <input type="text" name="username" id="username" placeholder="Usuario" value="Pablo_caja" required>
                    <input type="password" name="password" id="password" placeholder="Contraseña" value="password123" required>

                    <button>Ingresar</button>


                </div>
            </form>

        </div>
    </div>
</body>

</html>

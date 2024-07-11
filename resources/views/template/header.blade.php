<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono-->
    <link rel="icon" href="{{ asset('global_resources/image/logo_polleria.ico') }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('resources/template/css/template_desktop.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>D'Brazza</title>
</head>

<body>

    <!-- menu vertica -->
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="{{ asset('global_resources/image/logo_polleria.ico') }}" alt="Icono" id="logo_icon">
            <div class="logo-name"><span>D'Brazza</span></div>
        </a>

        <ul class="side-menu">

            <li class="active"><a href="#op"><i class='bx bxs-user-detail'></i>Usuarios</a></li>

        </ul>

        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Serrar sesion
                </a>
            </li>
        </ul>
    </div>
    <!-- Find el menu vertica -->

    <!-- Contenido principal -->
    <div class="content">
        <!-- Barra de navegación -->
        <nav>
            <i class='bx bx-menu'></i>

            <!-- buscador -->

            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Buscar...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>

            <!-- modo claro and oscuro -->

            <label for="theme-toggle" class="theme-toggle"></label>

            <!-- notoficaciones -->

            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>

            <!-- menu -->

            <a href="#" class="profile">
                <img src="{{ asset('resources/template/image/user_icon.png') }}">
            </a>
        </nav>

        <!-- Fin de la barra de navegación -->

     <main>

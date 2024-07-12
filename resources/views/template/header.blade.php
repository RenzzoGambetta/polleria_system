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
        <a class="logo">
            <img src="{{ asset('global_resources/image/logo_polleria.ico') }}" alt="Icono" id="logo_icon">
            <div class="logo-name"><span>D'Brazza</span></div>
        </a>

        <ul class="side-menu">

            <li class="{{ ($Navegacion['seccion'] ?? null) == 1 ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="{{ ($Navegacion['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle' }}" id="accion"><i class='bx bxs-home'></i>Home</a>
            </li>

            <li class="{{ ($Navegacion['seccion'] ?? null) == 2 ? 'sub active' : 'sub' }} ">

                <a href="{{ route('user') }}" class="{{ ($Navegacion['seccion'] ?? null) == 2 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navegacion['color'] ?? null) == 20 ? 'nav_select' : '' }}"><i class='bx bxs-user-detail'></i>Usuarios</a>
                <ul class="sub">
                    <li class="{{ ($Navegacion['sub_seccion'] ?? null) == 2.1 ? 'active' : '' }}">
                        <a href="{{ route('employeer') }}" id="{{ ($Navegacion['color'] ?? null) == 21 ? 'nav_select' : '' }}"><i class='bx bxs-user-detail'></i>Enpleado</a>
                    </li>
                    <li class="{{ ($Navegacion['sub_seccion'] ?? null) == 2.2 ? 'active' : '' }}">
                        <a href="{{ route('position') }}" id="{{ ($Navegacion['color'] ?? null) == 22 ? 'nav_select' : '' }}"><i class='bx bxs-user-detail'></i>Cargos</a>
                    </li>
                </ul>

            </li>

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

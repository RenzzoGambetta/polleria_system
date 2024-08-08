<!DOCTYPE html>
<html lang="{{$Language }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono-->
    <link rel="icon" href="{{ asset($CompanyLogoIcon) }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset($ColorNightAndDay) }}">
    <link rel="stylesheet" href="{{ asset($TemplateDesktop) }}">
    <link rel='stylesheet' href="{{ $Boxicons }}" >

    <title>D'Brazza</title>
</head>

<body class="{{ session('theme', 'light') }}">

    <!-- menu vertica -->
    <div class="sidebar">
        <a class="logo">
            <img src="{{ asset($CompanyLogoIcon) }}" alt="Icono" id="logo_icon">
            <div class="logo-name"><span>D'Brazza</span></div>
        </a>

        <ul class="side-menu">

            <li class="{{ ($Navigation['seccion'] ?? null) == 1 ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="{{ ($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle' }}" id="accion"><i class='bx bxs-home'></i>Home</a>
            </li>

            <li class="{{ ($Navigation['seccion'] ?? null) == 2 ? 'sub active' : 'sub' }} ">

                <a href="{{ route('user') }}" class="{{ ($Navigation['seccion'] ?? null) == 2 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navigation['color'] ?? null) == 20 ? 'nav_select' : '' }}"><i class='bx bxs-user-voice'></i>Usuarios</a>
                <ul class="sub">
                    <li class="{{ ($Navigation['sub_seccion'] ?? null) == 2.1 ? 'active' : '' }}">
                        <a href="{{ route('employeer') }}" id="{{ ($Navigation['color'] ?? null) == 21 ? 'nav_select' : '' }}"><i class='bx bxs-user-detail'></i>Empleado</a>
                    </li>
                    <li class="{{ ($Navigation['sub_seccion'] ?? null) == 2.2 ? 'active' : '' }}">
                        <a href="{{ route('position') }}" id="{{ ($Navigation['color'] ?? null) == 22 ? 'nav_select' : '' }}"><i class='bx bxs-component'></i>Roles</a>
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
            <script src="{{ asset($SwitchTheme) }}"></script>

            <!-- notoficaciones -->

            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>

            <!-- menu -->

            <a href="#" class="profile">
                <img src="{{ asset($TempUserIcon) }}">
            </a>
        </nav>

        <!-- Fin de la barra de navegación -->

     <main>

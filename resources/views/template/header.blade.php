<!DOCTYPE html>
<html lang="{{ $Language }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono-->
    <link rel="icon" href="{{ asset($CompanyLogoIcon) }}" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset($ColorNightAndDay) }}">
    <link rel="stylesheet" href="{{ asset($TemplateDesktop) }}">
    <link rel="stylesheet" href="{{ asset($TemplateMobile) }}">
    <link rel='stylesheet' href="{{ $Boxicons }}">
    <link rel='stylesheet' href="{{ asset($IconReferen) }}">

    <script src="{{ asset($JquerySrc) }}"></script>

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-solid-rounded/css/uicons-solid-rounded.css'>

    <title>D'Brazza</title>
</head>

<body class="{{ session('theme', 'light') }}">

    <section class="main-content">
        <!-- menu vertical -->
        <div class="sidebar {{ session('menu_state') === 'close' ? 'close' : '' }}">
            <a class="logo">
                <img src="{{ asset($CompanyLogoIcon) }}" alt="Icono" id="logo_icon">
                <div class="logo-name"><span>D'Brazza</span></div>
            </a>

            <ul class="side-menu">

                <li class="{{ ($Navigation['seccion'] ?? null) == 1 ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="{{ ($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle' }}" id="accion"><i class='bx bxs-home'></i>Home</a>
                </li>

                <li class="{{ ($Navigation['seccion'] ?? null) == 2 ? 'sub active' : 'sub' }}">
                    <a href="{{ route('user') }}" class="{{ ($Navigation['seccion'] ?? null) == 2 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navigation['color'] ?? null) == 20 ? 'nav_select' : '' }}"><i class='fi fi-ss-user-unlock bx-adjustment-icon'></i>Usuarios</a>
                    <ul class="sub">
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 2.1 ? 'active' : '' }}">
                            <a href="{{ route('employeer') }}" id="{{ ($Navigation['color'] ?? null) == 21 ? 'nav_select' : '' }}"><i class='fi fi-ss-users-medical bx-adjustment-icon'></i>Empleado</a>
                        </li>
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 2.2 ? 'active' : '' }}">
                            <a href="{{ route('position') }}" id="{{ ($Navigation['color'] ?? null) == 22 ? 'nav_select' : '' }}"><i class='fi fi-sr-chart-tree bx-adjustment-icon'></i>Roles</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ ($Navigation['seccion'] ?? null) == 3 ? 'sub active' : 'sub' }}">
                    <a href="{{ route('inventory') }}" class="{{ ($Navigation['seccion'] ?? null) == 3 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navigation['color'] ?? null) == 30 ? 'nav_select' : '' }}"><i class='fi fi-br-supplier-alt bx-adjustment-icon'></i>Inventario</a>
                    <ul class="sub">
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 3.1 ? 'active' : '' }}">
                            <a href="{{ route('show_list_inventory_movements') }}" id="{{ ($Navigation['color'] ?? null) == 31 ? 'nav_select' : '' }}"><i class='fi fi-bs-sort-alt bx-adjustment-icon'></i>Movimientos</a>
                        </li>
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 3.2 ? 'active' : '' }}">
                            <a href="{{ route('show_panel_register_output') }}" id="{{ ($Navigation['color'] ?? null) == 32 ? 'nav_select' : '' }}"><i class='fi fi-ss-inbox-out bx-adjustment-icon'></i>Salida</a>
                        </li>
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 3.3 ? 'active' : '' }}">
                            <a href="{{ route('show_panel_register_entry') }}" id="{{ ($Navigation['color'] ?? null) == 33 ? 'nav_select' : '' }}"><i class='fi fi-ss-inbox-in bx-adjustment-icon'></i>Entradas</a>
                        </li>
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 3.4 ? 'active' : '' }}">
                            <a href="{{ route('suppliers') }}" id="{{ ($Navigation['color'] ?? null) == 34 ? 'nav_select' : '' }}"><i class='fi fi-bs-person-dolly bx-adjustment-icon'></i>Provedores</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ ($Navigation['seccion'] ?? null) == 4 ? 'sub active' : 'sub' }}">
                    <a href="{{ route('menu') }}" class="{{ ($Navigation['seccion'] ?? null) == 4 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navigation['color'] ?? null) == 40 ? 'nav_select' : '' }}"><i class='fi fi-rr-plate-eating bx-adjustment-icon'></i>Menu</a>
                    <ul class="sub">
                        <li class="{{ ($Navigation['sub_seccion'] ?? null) == 4.1 ? 'active' : '' }}">
                            <a href="{{ route('category_carte') }}" id="{{ ($Navigation['color'] ?? null) == 41 ? 'nav_select' : '' }}"><i class='fi fi-rs-recipe-book bx-adjustment-icon'></i>Carta</a>
                        </li>

                    </ul>
                </li>
                <li class="{{ ($Navigation['seccion'] ?? null) == 1 ? 'active' : '' }}">
                    <a class="{{ ($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle' }}" id="accion"><i class='fi fi-sr-module bx-adjustment-icon'></i>Modulo 2</a>
                </li>

                <li class="{{ ($Navigation['seccion'] ?? null) == 1 ? 'active' : '' }}">
                    <a class="{{ ($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle' }}" id="accion"><i class='fi fi-sr-module bx-adjustment-icon'></i>Modulo 3</a>
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
            <nav id="nav-style-primary">
                <i class='bx bx-menu'></i>

                <!-- buscador -->

                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Buscar...">
                        <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                    </div>
                </form>

                <!-- modo claro and oscuro -->
                <input type="checkbox" id="theme-toggle" hidden {{ session('theme') === 'dark' ? 'checked' : '' }}>
                <label for="theme-toggle" class="theme-toggle {{ session('theme') === 'dark' ? 'dark-mode-button' : 'light-mode-button' }}" id="theme-toggle-action"></label>
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

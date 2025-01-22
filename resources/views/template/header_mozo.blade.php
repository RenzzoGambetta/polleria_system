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
    <link rel='stylesheet' href="{{ asset($Boxicons) }}">
    <link rel='stylesheet' href="{{ asset($IconReferen) }}">
    <link rel='stylesheet' href="{{ asset($MozoStylePanel) }}">

    <script src="{{ asset($JquerySrc) }}"></script>
    <script src="{{ asset($FunctionGlobal) }}"></script>

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
                <li class="{{ ($Navigation['seccion'] ?? null) == 10 ? 'sub active' : 'sub' }}">
                    <a href="{{ route('mozo') }}" class="{{ ($Navigation['seccion'] ?? null) == 10 ? ' submenu-toggle inac' : 'submenu-toggle acti' }}" id="{{ ($Navigation['color'] ?? null) == 100 ? 'nav_select' : '' }}" title="Todas las salas"><i class='fi fi-sr-table-pivot bx-adjustment-icon'></i>Salas</a>
                    <ul class="sub">
                        @foreach ($Data as $item)
                            <li class="{{ ($item->id ?? null) == $Option['id'] ? 'active' : '' }}" title="{{$item->name}}">
                                <a href="{{ route('table_to_mozo') }}?lounge_id={{ $item->id }}" id="{{ ($item->id ?? null) == $Option['id'] ? 'nav_select' : '' }}"><i class='bx bxs-label'></i> {{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>

            <ul class="side-menu">
                <li>
                    <a href="{{ route('log_out') }}" class="logout">
                        <i class="fi fi-br-arrow-up-left-from-circle bx-adjustment-icon"></i>
                        Regresar al home
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

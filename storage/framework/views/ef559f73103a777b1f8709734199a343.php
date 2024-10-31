<!DOCTYPE html>
<html lang="<?php echo e($Language); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono-->
    <link rel="icon" href="<?php echo e(asset($CompanyLogoIcon)); ?>" type="image/x-icon">
    <!--CSS-->
    <link rel="stylesheet" href="<?php echo e(asset($ColorNightAndDay)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($TemplateDesktop)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($TemplateMobile)); ?>">
    <link rel='stylesheet' href="<?php echo e($Boxicons); ?>">
    <link rel='stylesheet' href="<?php echo e($IconReferen); ?>">

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-solid-rounded/css/uicons-solid-rounded.css'>

    <title>D'Brazza</title>
</head>

<body class="<?php echo e(session('theme', 'light')); ?>">

    <section class="main-content">
        <!-- menu vertical -->
        <div class="sidebar <?php echo e(session('menu_state') === 'close' ? 'close' : ''); ?>">
            <a class="logo">
                <img src="<?php echo e(asset($CompanyLogoIcon)); ?>" alt="Icono" id="logo_icon">
                <div class="logo-name"><span>D'Brazza</span></div>
            </a>

            <ul class="side-menu">

                <li class="<?php echo e(($Navigation['seccion'] ?? null) == 1 ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle'); ?>" id="accion"><i class='bx bxs-home'></i>Home</a>
                </li>

                <li class="<?php echo e(($Navigation['seccion'] ?? null) == 2 ? 'sub active' : 'sub'); ?>">
                    <a href="<?php echo e(route('user')); ?>" class="<?php echo e(($Navigation['seccion'] ?? null) == 2 ? ' submenu-toggle inac' : 'submenu-toggle acti'); ?>" id="<?php echo e(($Navigation['color'] ?? null) == 20 ? 'nav_select' : ''); ?>"><i class='fi fi-ss-user-unlock bx-adjustment-icon'></i>Usuarios</a>
                    <ul class="sub">
                        <li class="<?php echo e(($Navigation['sub_seccion'] ?? null) == 2.1 ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('employeer')); ?>" id="<?php echo e(($Navigation['color'] ?? null) == 21 ? 'nav_select' : ''); ?>"><i class='fi fi-ss-users-medical bx-adjustment-icon'></i>Empleado</a>
                        </li>
                        <li class="<?php echo e(($Navigation['sub_seccion'] ?? null) == 2.2 ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('position')); ?>" id="<?php echo e(($Navigation['color'] ?? null) == 22 ? 'nav_select' : ''); ?>"><i class='fi fi-sr-chart-tree bx-adjustment-icon'></i>Roles</a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo e(($Navigation['seccion'] ?? null) == 3 ? 'sub active' : 'sub'); ?>">
                    <a href="<?php echo e(route('inventory')); ?>" class="<?php echo e(($Navigation['seccion'] ?? null) == 3 ? ' submenu-toggle inac' : 'submenu-toggle acti'); ?>" id="<?php echo e(($Navigation['color'] ?? null) == 30 ? 'nav_select' : ''); ?>"><i class='fi fi-br-supplier-alt bx-adjustment-icon'></i>Inventario</a>
                    <ul class="sub">
                        <li class="<?php echo e(($Navigation['sub_seccion'] ?? null) == 3.1 ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('show_panel_register_entry')); ?>" id="<?php echo e(($Navigation['color'] ?? null) == 31 ? 'nav_select' : ''); ?>"><i class='fi fi-ss-inbox-in bx-adjustment-icon'></i>Entradas</a>
                        </li>

                    </ul>
                </li>

                <li class="<?php echo e(($Navigation['seccion'] ?? null) == 1 ? 'active' : ''); ?>">
                    <a class="<?php echo e(($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle'); ?>" id="accion"><i class='fi fi-sr-module bx-adjustment-icon'></i>Modulo 2</a>
                </li>

                <li class="<?php echo e(($Navigation['seccion'] ?? null) == 1 ? 'active' : ''); ?>">
                    <a class="<?php echo e(($Navigation['color'] ?? null) == 10 ? 'submenu-toggle nav_select' : 'submenu-toggle'); ?>" id="accion"><i class='fi fi-sr-module bx-adjustment-icon'></i>Modulo 3</a>
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
                <input type="checkbox" id="theme-toggle" hidden <?php echo e(session('theme') === 'dark' ? 'checked' : ''); ?>>
                <label for="theme-toggle" class="theme-toggle <?php echo e(session('theme') === 'dark' ? 'dark-mode-button' : 'light-mode-button'); ?>" id="theme-toggle-action"></label>
                <script src="<?php echo e(asset($SwitchTheme)); ?>"></script>

                <!-- notoficaciones -->

                <a href="#" class="notif">
                    <i class='bx bx-bell'></i>
                    <span class="count">12</span>
                </a>

                <!-- menu -->

                <a href="#" class="profile">
                    <img src="<?php echo e(asset($TempUserIcon)); ?>">
                </a>
            </nav>

            <!-- Fin de la barra de navegación -->

            <main>
<?php /**PATH C:\Users\fer\Desktop\polleria real\polleria_system\resources\views/template/header.blade.php ENDPATH**/ ?>
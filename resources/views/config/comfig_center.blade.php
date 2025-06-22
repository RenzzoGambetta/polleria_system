<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($ConfigCenter) }}">

<div class="bottom-data">

    <!-- Recordatorios -->
    <div class="reminders">
        <div class="header">
            <i class="fi fi-ss-screen icon-center-data"></i>
            <h3>Sistema</h3>
        </div>
        <ul class="task-list">
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-sr-workflow-setting-alt icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Configuración inicial</h1>
                        <p class="sub-title-to-config">Características, opciones, otros.</p>
                    </div>
                </div>
            </li>
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-ss-print icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Impresoras</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-ss-operating-system-upgrade icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Optimización de procesos</h1>
                        <p class="sub-title-to-config">Reducir o eliminar la pérdida de tiempo y recursos</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Recordatorios -->
    <div class="reminders">
        <div class="header">
            <i class="fi fi-bs-building icon-center-data"></i>
            <h3>Empresa</h3>
        </div>
        <ul class="task-list">
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-ss-corporate-alt icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Datos de la empresa</h1>
                        <p class="sub-title-to-config">Modificar los datos de la empresa.</p>
                    </div>
                </div>
            </li>
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-ss-admin-alt icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Usuarios / Roles</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-sr-document-signed icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Tipo de documentos</h1>
                        <p class="sub-title-to-config">Modificar los tipos de documentos.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-ss-credit-card icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Tipos de pago</h1>
                        <p class="sub-title-to-config">Modificar los tipos de pagos.</p>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- Recordatorios -->
    <div class="reminders">
        <div class="header">
            <i class="fi fi-sr-user-chef icon-center-data"></i>
            <h3>Restaurante </h3>
        </div>
        <ul class="task-list">
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-bs-cash-register icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Cajas</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="completed">
                <div class="task-title">
                    <i class="fi fi-sr-grill icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Áreas de Producción</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-ss-table-pivot icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Salones y mesas</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-sr-hamburger-soda icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Productos</h1>
                        <p class="sub-title-to-config">Creación, modificación.</p>
                    </div>
                </div>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class="fi fi-ss-qrcode-menu icon-center-table config"></i>
                    <div class="sub-title-and-description">
                        <h1 class="title-to-config">Carta QR</h1>
                        <p class="sub-title-to-config">Creación</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</div>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>

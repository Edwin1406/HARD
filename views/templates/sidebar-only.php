 <?php

    $userEmail = $_SESSION['email'] ?? 'No disponible'; // Asignar
    ?>


 <header class="py-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/admin/index">DESARROLLO</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'pruebas@megaecuador.com') { ?>
                    <li class="sidebar-item active ">
                        <a href="/admin/index" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span class="d-none d-xl-inline">Dashboard</span>
                        </a>
                    </li>
                <?php } ?>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span class="d-none d-xl-inline">Administracion</span>
                    </a>
                    <?php if ($userEmail === 'invitado@pruebas.com' || $userEmail === 'pruebas@megaecuador.com') { ?>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="/admin/bodega/crearBodega"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Bodega</span></a>
                            </li>
                            <li class="submenu-item">
                                <a href="/admin/ciudad/crearCiudad"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Ciudades</span></a>
                            </li>
                            <li class="submenu-item">
                                <a href="/admin/paises/crearPais"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Paises</span></a>
                            </li>
                            <li class="submenu-item">
                                <a href="/admin/marca/crearMarca"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Marcas</span></a>
                            </li>
                        </ul>
                    <?php } ?>
                </li>

                <!-- pruebas -->
                <?php if ($userEmail === 'pruebas@megaecuador.com' || $userEmail === 'produccion@megaecuador.com') { ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-code-slash"></i>
                            <span class="d-none d-xl-inline">Pruebas</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="/admin/pruebas/tablaPruebas"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Tabla Pruebas</span></a>
                            </li>
                            <li class="submenu-item">
                                <a href="/admin/pruebas/crearPruebas"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Crear Pruebas</span></a>
                            </li>
                            <li class="submenu-item">
                                <a href="/admin/vehiculos/registroVehiculos"><i class="bi bi-arrow-right"> </i><span class="d-none d-xl-inline">Registro de Vehículos</span></a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>


<style>

/* Ocultar texto en pantallas pequeñas */
.d-none.d-xl-inline {
    display: none !important;
}

/* Mostrar texto solo en pantallas grandes */
@media (min-width: 1200px) {
    .d-none.d-xl-inline {
        display: inline !important;
    }
}

/* Mostrar los íconos siempre */
.sidebar-link i {
    display: inline-block !important;
}

/* Mostrar solo los iconos en el menú hamburguesa */
.sidebar-wrapper .menu .sidebar-item.has-sub .sidebar-link i {
    font-size: 1.2rem !important;
}

.sidebar-wrapper .menu .sidebar-item .sidebar-link span {
    display: none !important;
}




</style>
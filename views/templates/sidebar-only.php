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

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active">
                    <a href="/admin/index" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Administracion</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/bodega/crearBodega"><i class="bi bi-arrow-right"> </i>Bodega</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/ciudad/crearCiudad"><i class="bi bi-arrow-right"> </i>Ciudades</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/paises/crearPais"><i class="bi bi-arrow-right"> </i>Paises</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/marca/crearMarca"><i class="bi bi-arrow-right"> </i>Marcas</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-code-slash"></i>
                        <span>Pruebas</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/admin/pruebas/tablaPruebas"><i class="bi bi-arrow-right"> </i>Tabla Pruebas</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/pruebas/crearPruebas"><i class="bi bi-arrow-right"> </i>Crear Pruebas</a>
                        </li>
                        <li class="submenu-item">
                            <a href="/admin/vehiculos/registroVehiculos"><i class="bi bi-arrow-right"> </i>Registro localizacion de Vehículos</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>



<style>

/* Sidebar container */
#sidebar {
    width: 250px;
    background-color: #2c3e50;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    display: none;
    transition: transform 0.3s ease-in-out;
}

/* Sidebar active state */
#sidebar.active {
    display: block;
    transform: translateX(0);
}

/* Menu styling */
.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-item {
    padding: 15px;
    color: #fff;
}

.sidebar-link {
    text-decoration: none;
    color: #fff;
    display: flex;
    align-items: center;
}

.sidebar-link i {
    margin-right: 10px;
}

/* Expandable submenu */
.submenu {
    list-style: none;
    padding-left: 20px;
    display: none;
}

.sidebar-item.has-sub.active > .submenu {
    display: block;
}

/* Sidebar toggle button */
.burger-btn {
    display: block;
    font-size: 30px;
    color: #fff;
}

.sidebar-header {
    padding: 10px 20px;
    background-color: #34495e;
    color: #fff;
}

/* Mobile hamburger menu (for responsive) */
@media (max-width: 768px) {
    #sidebar {
        width: 100%;
    }
}


</style>



<script>


// JavaScript for toggling the sidebar
const burgerBtn = document.querySelector('.burger-btn');
const sidebar = document.getElementById('sidebar');
const sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');

burgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

// Toggle submenu visibility on click
sidebarItems.forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('active');
    });
});


</script>
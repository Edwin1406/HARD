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
                     <a href="/admin/index">MEGASTOCK</a>
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
                             <span>Dashboard</span>
                         </a>
                     </li>
                 <?php } ?>

                 <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-stack"></i>
                         <span>Producción</span>
                     </a>
                     <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'planta@megaecuador.com' || $userEmail === 'pruebas@megaecuador.com') { ?>
                         <ul class="submenu ">
                             <li class="sidebar-title"><b><i class="bi bi-archive"></i> Registros</b></li>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/consumo"><i class="bi bi-arrow-right"> </i>Registro Empaque</a>
                                 </li>
                             <?php }  ?>

                             <!-- icono de flecha -->
                             <li class="submenu-item ">
                                 <a href="/admin/consumo_general"><i class="bi bi-arrow-right"> </i>Registro Consumo General</a>
                             </li>
                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/convertidor/consumo_convertidor"><i class="bi bi-arrow-right"> </i>Registro Convertidor</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/doblado/consumo_doblado"><i class="bi bi-arrow-right"> </i>Registro Consumo Doblado</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/guillotina/consumo_guillotina_papel"><i class="bi bi-arrow-right"> </i>Registro Consumo Guillotina</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control_troquel"><i class="bi bi-arrow-right"> </i>Registro Troquel</a>
                                 </li>
                             <?php }  ?>

                             <li class="sidebar-title"><b><i class="bi bi-table"></i> Tablas</b></li>
                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/tablaConsumo"><i class="bi bi-arrow-right"> </i>Tabla Consumo Empaque</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/convertidor/tablaConsumoConvertidor"><i class="bi bi-arrow-right"> </i>Tabla Consumo Convertidor</a>
                                 </li>
                             <?php }  ?>

                             <li class="submenu-item ">
                                 <a href="/admin/tablaConsumoGeneral"><i class="bi bi-arrow-right"> </i>Tabla Consumo General</a>
                             </li>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/doblado/tablaConsumoDoblado"><i class="bi bi-arrow-right"> </i>Tabla Consumo Doblado</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/tablaConsumoTroquel"><i class="bi bi-arrow-right"> </i>Tabla Consumo Troquel</a>
                                 </li>
                             <?php }  ?>

                             <?php if ($email !== 'planta@megaecuador.com') { ?>
                                 <li class="submenu-item ">
                                     <a href="/admin/control/guillotina/tablaConsumoGuillotinaPapel"><i class="bi bi-arrow-right"> </i>Tabla Consumo Guillotina Papel</a>
                                 </li>
                             <?php }  ?>

                         </ul>
                     <?php }  ?>

                 </li>
                 <?php if ($userEmail === 'control@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'pruebas@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-collection-fill"></i>
                             <span>Administrativo</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/tablaAdminConsumoGeneral"><i class="bi bi-arrow-right"> </i>Habilitar Consumo General</a>
                             </li>

                         </ul>
                     </li>
                 <?php } ?>

                 <?php if ($userEmail === 'artes@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'pruebas@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-rulers"></i>
                             <span>Diseño</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/diseno/crearDiseno"><i class="bi bi-arrow-right"> </i>Crear Diseño</a>
                                 <a href="/admin/diseno/tablaDiseno"><i class="bi bi-arrow-right"> </i>Tabla Diseño</a>
                                 <a href="/admin/turnoDiseno/generarTurno"><i class="bi bi-arrow-right"> </i>Generar Turno</a>
                                 <a href="/admin/turnoDiseno/turnotablaDiseno"><i class="bi bi-arrow-right"> </i>Tabla Turno Diseño</a>
                             </li>

                         </ul>
                     </li>
                 <?php } ?>

                 <?php if (
                        $userEmail === 'ventas@megaecuador.com' ||
                        $userEmail === 'produccion@megaecuador.com' ||
                        $userEmail === 'pruebas@megaecuador.com'
                    ) { ?>
                     <li class="sidebar-item has-sub">
                         <a href="#" class="sidebar-link">
                             <i class="bi bi-bag-fill"></i>
                             <span>Ventas</span>
                         </a>

                         <ul class="submenu">
                             <li class="submenu-item">
                                 <a href="/admin/diseno/tablaDiseno">
                                     <i class="bi bi-arrow-right"></i> Tabla Diseño
                                 </a>
                                 <a href="/admin/turnoDiseno/turnotablaDiseno"><i class="bi bi-arrow-right"> </i>Tabla Turno Diseño</a>
                             </li>
                             <li class="submenu-item">
                                 <a href="/admin/turnoDiseno/generarTurno">
                                     <i class="bi bi-arrow-right"></i> Generar turno
                                 </a>
                             </li>
                         </ul>
                     </li>
                 <?php } ?>
                 <!-- pruebas-->
                 <?php if ($userEmail === 'pruebas@megaecuador.com' || $userEmail === 'produccion@megaecuador.com'|| $userEmail === 'corrugador@megaecuador.com'|| $userEmail === 'flexo@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <!-- <i class="bi bi-collection-fill"></i> -->
                             <i class="bi bi-code-slash"></i>
                             <span>Pruebas</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/pruebas/tablaPruebas"><i class="bi bi-arrow-right"> </i>Tabla Pruebas</a>
                             </li>
                             <li class="submenu-item ">
                                 <a href="/admin/pruebas/crearPruebas"><i class="bi bi-arrow-right"> </i>Crear Pruebas</a>
                             </li>
                             <li class="submenu-item ">
                                 <a href="/admin/vehiculos/registroVehiculos"><i class="bi bi-arrow-right"> </i>Registro localizacion de Vehículos</a>
                             </li>
                         </ul>
                     </li>
                 <?php } ?>
                 <!-- pruebas-->
                 <?php if ($userEmail === 'pruebas@megaecuador.com' || $userEmail === 'produccion@megaecuador.com' || $userEmail === 'mantenimiento@megaecuador.com') { ?>
                     <li class="sidebar-item  has-sub">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-tools"></i>
                             <span>Mantenimiento</span>
                         </a>
                         <ul class="submenu ">
                             <li class="submenu-item ">
                                 <a href="/admin/pruebas/tablaPruebas"><i class="bi bi-arrow-right"> </i>Tabla Pruebas</a>
                             </li>
                             <li class="submenu-item ">
                                 <a href="/admin/mantenimiento/registroMantenimiento"><i class="bi bi-arrow-right"> </i>Registro Mantenimiento</a>
                             </li>
                         </ul>
                     </li>
                 <?php } ?>
         </div>
         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>









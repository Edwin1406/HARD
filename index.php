<?php 
    


error_reporting(E_ALL);
ini_set('display_errors', 1);



require_once __DIR__ . '/includes/app.php';

use MVC\Router;

use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\Apicontroller;
use Controllers\BodegaController;
use Controllers\ControlController;
use Controllers\DiseñoController;
use Controllers\GraficasController;
use Controllers\PruebasController;
use Controllers\LocalizarController;
use Controllers\MantenimientoController;

$router = new Router();


// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);


// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
// $router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);



// Area de Administración
$router->get('/admin/index', [AdminController::class, 'index']);



// Dashboard
$router->get('/admin/bodega/crearBodega', [BodegaController::class, 'crearBodega']);
$router->post('/admin/bodega/crearBodega', [BodegaController::class, 'crearBodega']);

$router->post('/admin/ciudad', [BodegaController::class, 'ciudad']);












// CRUD DE PRUEBAS 
// Crear prueba
$router->get('/admin/pruebas/crearPruebas', [PruebasController::class, 'crearPruebas']);
$router->post('/admin/pruebas/crearPruebas', [PruebasController::class, 'crearPruebas']);


// eliminar carrito
$router->post('/admin/eliminarCarrito', [PruebasController::class, 'eliminarCarrito']);

// REGISTRAR VENTA
$router->post('/admin/pruebas/registrarVenta', [PruebasController::class, 'registrarVenta']);














// cerrar sesión
$router->get('/cerrarSesion', [AuthController::class, 'cerrarSesion']);



$router->comprobarRutas();







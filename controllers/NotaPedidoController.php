<?php

namespace Controllers;

use Model\Exportadores;
use Model\Importadores;
use Model\NotaPedido;
use Model\Pais;
use MVC\Router;

class NotaPedidoController
{
   public static function crearNota(Router $router): void
{
    $alertas = [];

    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: /');
        exit; // Es importante añadir exit después de un redireccionamiento
    }

    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];

    $importadores = Importadores::all();
    $exportadores = Exportadores::all();
    $pais = Pais::all();
    $notasPedidos = NotaPedido::all();
    
    $notaPedido = new NotaPedido;

    // Verifica si es una petición POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Codigo_Nota_Pedido = $_POST['Codigo_Nota_Pedido'] ?? 0;
        $existeNotaPedido = NotaPedido::where('Codigo_Nota_Pedido', $Codigo_Nota_Pedido);
        
        if ($existeNotaPedido) {
            // Mensaje de error
            NotaPedido::setAlerta('error', 'Ya existe una Nota Pedido con ese código');
            $_SESSION['alertas'] = NotaPedido::getAlertas(); // Guardar las alertas en la sesión
        } else {
            // Crear una nueva instancia
            $notaPedido = new NotaPedido($_POST);
        }

        // Sincronizar objeto con los datos del formulario
        $notaPedido->sincronizar($_POST);

        // Validar las entradas
        $alertas = $notaPedido->validar();

        if (empty($alertas)) {
            // Guardar el registro
            $resultado = $notaPedido->guardar();

            if ($resultado) {
                header('Location: /admin/notaPedido/crearNota?exito=1');
                exit; // Asegúrate de detener la ejecución después del redireccionamiento
            }
        } else {
            // Si hay alertas, las guardamos en la sesión
            $_SESSION['alertas'] = $alertas;
        }
    }

    // Recuperar las alertas de la sesión y luego borrarlas para que no se mantengan después de un reload
    $alertas = $_SESSION['alertas'] ?? [];
    unset($_SESSION['alertas']); // Limpiar las alertas de la sesión después de mostrarlas

    // Renderizar la vista
    $router->render('admin/notapedido/crearNota', [
        'titulo' => 'Crear Nota Pedido',
        'nombre' => $nombre,
        'email' => $email,
        'alertas' => $alertas,
        'importadores' => $importadores,
        'exportadores' => $exportadores,
        'pais' => $pais,
        'notasPedidos' => $notasPedidos,
    ]);
}

}

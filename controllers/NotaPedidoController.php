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
    }

    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];

    $importadores = Importadores::all();
    $exportadores = Exportadores::all();
    $pais = Pais::all();
    $notasPedidos = NotaPedido::all();
    
    $notaPedido = new NotaPedido;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $Codigo_Nota_Pedido = $_POST['Codigo_Nota_Pedido'] ?? 0;
        $existeNotaPedido = NotaPedido::where('Codigo_Nota_Pedido', $Codigo_Nota_Pedido);
        if ($existeNotaPedido) {
            // Mensaje de error
            NotaPedido::setAlerta('error', 'Ya existe una Nota Pedido con ese código');
            $alertas = NotaPedido::getAlertas();
        } else {
            // Crea una nueva instancia
            $notaPedido = new NotaPedido($_POST);
        }

        // Sincronizar objeto con los datos del formulario
        $notaPedido->sincronizar($_POST);

        // Validar los datos
        $alertas = $notaPedido->validar();

        if (empty($alertas)) {
            // Guardar el registro
            $resultado = $notaPedido->guardar();

            if ($resultado) {
                header('Location: /admin/notaPedido/crearNota?exito=1');
            }
        }
    }

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

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
        // debuguear($notasPedidos);
    
        $notaPedido = new NotaPedido;

        // $bodega =  Bodega::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $notaPedido->sincronizar($_POST);

            // debuguear($notaPedido);

            // debuguear($marca);
            $alertas = $notaPedido->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $notaPedido->guardar();

                if ($resultado) {
                    header('Location: /admin/notaPedido/crearNota?exito=1');
                }
            }
        }








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

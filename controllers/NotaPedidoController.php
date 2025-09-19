<?php

namespace Controllers;

use Model\Exportadores;
use Model\Importadores;
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








        $router->render('admin/notapedido/crearNota', [
            'titulo' => 'Crear Nota Pedido',
            'nombre' => $nombre,
            'email' => $email,
            'alertas' => $alertas,
            'importadores' => $importadores,
            'exportadores' => $exportadores,
            'pais' => $pais
        ]);
    }
}

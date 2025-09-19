<?php

namespace Controllers;

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











        $router->render('admin/notapedido/crearNota', [
            'titulo' => 'Crear Nota Pedido',
            'nombre' => $nombre,
            'email' => $email,
            'alertas' => $alertas

        ]);






    }
    }
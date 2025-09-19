<?php

namespace Controllers;

use MVC\Router;

class NotaPedidoController
{
    public static function crearNota(Router $router): void
    {












        $router->render('admin/notaPedido/crearNota', [
            'titulo' => 'Crear Nota Pedido'
        ]);






    }
    }
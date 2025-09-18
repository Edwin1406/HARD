<?php

namespace Controllers;

use MVC\Router;

class BodegaController
{
    public static function bodega(Router $router): void
    {

        $alertas = [];


          // Render a la vista
        $router->render('admin/bodega/crearBodega', [
            'titulo' => 'Crea una Bodega', 
            'alertas' => $alertas
        ]);



    }


    }



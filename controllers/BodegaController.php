<?php

namespace Controllers;

use Model\Bodega;
use MVC\Router;

class BodegaController
{
    public static function crearBodega(Router $router): void
    {

        $alertas = [];

         session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];


        $bodega =  Bodega::all();

          // Render a la vista
        $router->render('admin/bodega/crearBodega', [
            'titulo' => 'Crea una Bodega', 
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'bodega' => $bodega
        ]);



    }


    }



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

        $bodega = new Bodega($_POST);

        // $bodega =  Bodega::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bodega->sincronizar($_POST);

            // debuguear($bodega);
            $alertas = $bodega->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $bodega->guardar();

                if ($resultado) {
                    header('Location: /admin/bodega/tablaBodega?exito=1');
                }
            }
        }

        // Render a la vista
        $router->render('admin/bodega/crearBodega', [
            'titulo' => 'Crea una Bodega',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }

    // tabla de bodega


    public static function tablaBodega(Router $router): void
    {

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $bodega =  Bodega::all();

        // Render a la vista
        $router->render('admin/bodega/tablaBodega', [
            'titulo' => 'Tabla de Bodegas',
            'bodega' => $bodega,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }


    public static function eliminarBodega(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $bodega = Bodega::find($id);
                if ($bodega) {
                    $bodega->eliminar();
                    header('Location: /admin/bodega/tablaBodega');
                }
            }
        }
    }























    
}

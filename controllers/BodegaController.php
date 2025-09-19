<?php

namespace Controllers;

use Model\Bodega;
use Model\Ciudad;
use Model\Marca;
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
                    header('Location: /admin/bodega/tablaBodega?eliminado=3');
                }
            }
        }
    }



    public static function editarBodega(Router $router): void
    {

        $alertas = [];
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/bodega/tablaBodega');
        }

        // Obtener los datos de la bodega a editar
        $bodega = Bodega::find($id);

        if (!$bodega) {
            header('Location: /admin/bodega/tablaBodega');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bodega->sincronizar($_POST);

            // debuguear($bodega);
            $alertas = $bodega->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $bodega->guardar();

                if ($resultado) {
                    header('Location: /admin/bodega/tablaBodega?editado=2');
                }
            }
        }

        // Render a la vista
        $router->render('admin/bodega/editarBodega', [
            'titulo' => 'Editar Bodega',
            'alertas' => $alertas,
            'bodega' => $bodega,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }




    // crear ciudad
 public static function crearCiudad(Router $router): void
    {

        $alertas = [];

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $ciudad = new Ciudad;

        // $bodega =  Bodega::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ciudad->sincronizar($_POST);

            // debuguear($ciudad);
            $alertas = $ciudad->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $ciudad->guardar();

                if ($resultado) {
                    header('Location: /admin/ciudad/tablaCiudad?exito=1');
                }
            }
        }

        // Render a la vista
        $router->render('admin/ciudad/crearCiudad', [
            'titulo' => 'Crea una Ciudad',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }



    // tabla de ciudad
    public static function tablaCiudad(Router $router): void
    {

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $ciudad =  Ciudad::all();

        // Render a la vista
        $router->render('admin/ciudad/tablaCiudad', [
            'titulo' => 'Tabla de Ciudades',
            'ciudad' => $ciudad,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }



    public static function eliminarCiudad(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $ciudad = Ciudad::find($id);
                if ($ciudad) {
                    $ciudad->eliminar();
                    header('Location: /admin/ciudad/tablaCiudad?eliminado=3');
                }
            }
        }
    }


    // editar ciudad
    public static function editarCiudad(Router $router): void
    {

        $alertas = [];
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/ciudad/tablaCiudad');
        }

        // Obtener los datos de la ciudad a editar
        $ciudad = Ciudad::find($id);

        if (!$ciudad) {
            header('Location: /admin/ciudad/tablaCiudad');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ciudad->sincronizar($_POST);

            // debuguear($ciudad);
            $alertas = $ciudad->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $ciudad->guardar();

                if ($resultado) {
                    header('Location: /admin/ciudad/tablaCiudad?editado=2');
                }
            }
        }

        // Render a la vista
        $router->render('admin/ciudad/editarCiudad', [
            'titulo' => 'Editar Ciudad',
            'alertas' => $alertas,
            'ciudad' => $ciudad,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }


















// crear marca
 public static function crearMarca(Router $router): void
    {

        $alertas = [];

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $marca = new Marca;

        // $bodega =  Bodega::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $marca->sincronizar($_POST);

            // debuguear($marca);
            $alertas = $marca->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $marca->guardar();

                if ($resultado) {
                    header('Location: /admin/marca/tablaMarca?exito=1');
                }
            }
        }

        // Render a la vista
        $router->render('admin/marca/crearMarca', [
            'titulo' => 'Crea una Marca',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }



    // tabla de marca
    public static function tablaMarca(Router $router): void
    {

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $marca =  Marca::all();

        // Render a la vista
        $router->render('admin/marca/tablaMarca', [
            'titulo' => 'Tabla de Marcas',
            'marca' => $marca,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }   

    
    // eliminar marca
    public static function eliminarMarca(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $marca = Marca::find($id);
                if ($marca) {
                    $marca->eliminar();
                    header('Location: /admin/marca/tablaMarca?eliminado=3');
                }
            }
        }
    }

    // editar marca
    public static function editarMarca(Router $router): void
    {

        $alertas = [];
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/marca/tablaMarca');
        }

        // Obtener los datos de la marca a editar
        $marca = Marca::find($id);

        if (!$marca) {
            header('Location: /admin/marca/tablaMarca');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $marca->sincronizar($_POST);

            // debuguear($marca);
            $alertas = $marca->validar();

            if (empty($alertas)) {
                // Guardar el registro
                $resultado = $marca->guardar();

                if ($resultado) {
                    header('Location: /admin/marca/tablaMarca?editado=2');
                }
            }
        }

        // Render a la vista
        $router->render('admin/marca/editarMarca', [
            'titulo' => 'Editar Marca',
            'alertas' => $alertas,
            'marca' => $marca,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }

























}

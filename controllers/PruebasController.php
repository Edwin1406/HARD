<?php

namespace Controllers;

use Model\Carrito;
use Model\DetalleVenta;
use Model\Ventas;
use MVC\Router;


class PruebasController
{


    public static function crearPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();

        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearPruebas?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/crearPruebas', [
            'titulo' => 'Crear Pruebas',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
        ]);
    }


    public static function eliminarCarrito()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $carrito = Carrito::find($id);

            if ($carrito) {
                $carrito->eliminar();
                header('Location: /admin/pruebas/crearPruebas?exito=1');
                exit;
            } else {
                // Manejar el caso en que no se encuentra el registro
                header('Location: /admin/pruebas/crearPruebas?error=1');
                exit;
            }
        }
    }


    // public static function registrarVenta()
    // {
    //     session_start();
    //     if (!isset($_SESSION['email'])) {
    //         header('Location: /');
    //         exit;
    //     }

    //     // ✅ Solo continuar si la petición es POST
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $id_usuario = $_SESSION['id'];
    //         $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

    //         if (empty($carritoTemporal)) {
    //             header('Location: /carrito');
    //             exit;
    //         }

    //         // Calcular total
    //         $total = 0;
    //         foreach ($carritoTemporal as $item) {
    //             $total += $item->cantidad;
    //         }


    //         // Obtener ID generado
    //         // Crear venta
    //         $venta = new Ventas;
    //         $venta->id_usuario = $id_usuario;
    //         // id_venta
    //         // $venta->id_venta = null;
    //         $venta->total = $total;
    //         $venta->fecha = date('Y-m-d H:i:s');
    //         $venta->guardarCarrito();

    //         $id_venta = $venta->id; // Asegúrate que ActiveRecord actualiza esta propiedad


    //         // Insertar detalles
    //         foreach ($carritoTemporal as $item) {
    //             $detalle = new DetalleVenta;
    //             $detalle->id_venta = $id_venta;
    //             $detalle->tipo_maquina = $item->tipo_maquina;
    //             $detalle->cantidad = $item->cantidad;
    //             $detalle->casos = $item->casos;
    //             $detalle->metros_lineales = $item->metros_lineales;
    //             $detalle->n_laminas = $item->n_laminas;
    //             $detalle->n_cambios = $item->n_cambios;
    //             $detalle->consumo_almidon = $item->consumo_almidon;
    //             $detalle->consumo_resina = $item->consumo_resina;
    //             $detalle->consumo_recubrimiento = $item->consumo_recubrimiento;
    //             // $detalle->fecha = date('Y-m-d H:i:s');
    //             $detalle->guardarCarrito();
    //         }

    //         // Vaciar carrito
    //         Carrito::eliminarPorColumna('id_usuario', $id_usuario);

    //         // Redirigir o mostrar mensaje de éxito
    //         header('Location: /admin/pruebas/crearPruebas?exito=1');
    //         exit;
    //     } else {
    //         // Si no es POST, redirige o muestra un error
    //         header('Location: /carrito');
    //         exit;
    //     }
    // }



    public static function registrarVenta()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;
            $metros_lineales_C = $_POST['metros_lineales_C'] ?? 0;

            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;
            $consumo_almidon = $_POST['consumo_almidon'] ?? 0;
            $consumo_resina = $_POST['consumo_resina'] ?? 0;
            $consumo_recubrimiento = $_POST['consumo_recubrimiento'] ?? 0;
            $metros_lineales_B = $_POST['metros_lineales_B'] ?? 0;
            $metros_lineales_E = $_POST['metros_lineales_E'] ?? 0;
            // operador
            $operador =$_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            
            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->metros_lineales_C = $metros_lineales_C;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;
            $venta->consumo_almidon = $consumo_almidon;
            $venta->consumo_resina = $consumo_resina;
            $venta->consumo_recubrimiento = $consumo_recubrimiento;
            $venta->metros_lineales_B = $metros_lineales_B;
            $venta->metros_lineales_E = $metros_lineales_E;
            $venta->operador = $operador;
            $venta->turno = $turno;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearPruebas?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }
}

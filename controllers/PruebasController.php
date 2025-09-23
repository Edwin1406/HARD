<?php

namespace Controllers;

use Model\Bodega;
use Model\Carrito;
use Model\Ciudad;
use Model\DetalleVenta;
use Model\Marca;
use Model\NotaPedido;
use Model\Pais;
use Model\Tienda;
use Model\Ventas;
use MVC\Router;


class PruebasController
{

public static function crearPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        // id_nota puede venir por GET o por POST
        $id_nota = $_GET['id'] ?? ($_POST['id_nota'] ?? null);

        // Catálogos
        $tiendas = Tienda::all();
        $bodega  = Bodega::all();
        $ciudad  = Ciudad::all();
        $pais    = Pais::all();
        $marca   = Marca::all();

        // Info de la nota
        $informacionNota = NotaPedido::where('Codigo_Nota_Pedido', $id_nota);
        $fecha = NotaPedido::where('Codigo_Nota_Pedido', $id_nota)->Fecha_Nota_Pedido ?? date('Y-m-d');

        // Datos de sesión
        $nombre = $_SESSION['nombre'];
        $email  = $_SESSION['email'];

        // Auxiliares
        $carritoTemporal = Carrito::all();
        $carrito = new Carrito;
        $alertas = [];

        // 1) Recuperar “old” de sesión (flash) si vienes de un redirect
        $old = $_SESSION['old'] ?? [];
        if (isset($_SESSION['old'])) {
            unset($_SESSION['old']); // flash: se usa una vez
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 2) Guardar lo recibido como “old”
            $old = $_POST;

            // Mapear POST al modelo
            $carrito->Codigo_Nota_Pedido       = $id_nota;
            $carrito->Nombre_Tienda            = $_POST['Nombre_Tienda'] ?? '';
            $carrito->Fecha_Tienda_Nota_Pedido = $_POST['Fecha_Tienda_Nota_Pedido'] ?? null;
            $carrito->Factura_Nota_Pedido      = $_POST['Factura_Nota_Pedido'] ?? null;
            $carrito->Total_Tienda_Nota_Pedido = $_POST['Total_Tienda_Nota_Pedido'] ?? 0.00;
            $carrito->cantidad                 = $_POST['cantidad'] ?? 0;

            // Validación del modelo
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                $resultado = $carrito->guardar();
                if ($resultado) {
                    // 3) Guardar “old” en sesión antes del redirect
                    $_SESSION['old'] = $old;
                    header("Location: /admin/pruebas/crearPruebas?id=$id_nota&exito=1");
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
            // Si hay errores, seguimos al render con $old ya cargado
        }

        // Renderizar la vista
        $router->render('admin/pruebas/crearPruebas', [
            'titulo'          => 'Crear Pruebas',
            'alertas'         => $alertas,
            'nombre'          => $nombre,
            'email'           => $email,
            'carritoTemporal' => $carritoTemporal,
            'id_nota'         => $id_nota,
            'informacionNota' => $informacionNota,
            'fecha'           => $fecha,
            'tiendas'         => $tiendas,
            'bodega'          => $bodega,
            'ciudad'          => $ciudad,
            'pais'            => $pais,
            'marca'           => $marca,
            'old'             => $old,
        ]);
    }

    public static function eliminarCarrito()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }


        $id_nota = $_GET['id'] ?? ($_POST['id_nota'] ?? null);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $carrito = Carrito::find($id);

            if ($carrito) {
                $carrito->eliminar();
                // header('Location: /admin/pruebas/crearPruebas?exito=1');
                header("Location: /admin/pruebas/crearPruebas?id=$id_nota&eliminado=3");
                exit;
            } else {
                // Manejar el caso en que no se encuentra el registro
                // header('Location: /admin/pruebas/crearPruebas?error=1');
                header("Location: /admin/pruebas/crearPruebas?id=$id_nota&error=1");
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
            $operador = $_POST['operador'] ?? '';
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

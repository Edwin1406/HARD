<?php

namespace Controllers;

use Model\Bodega;
use Model\Carrito;
use Model\Carrito2;
use Model\Ciudad;
use Model\Compra;
use Model\DetalleVenta;
use Model\Marca;
use Model\NotaPedido;
use Model\Pais;
use Model\Prenda;
use Model\Tienda;
use Model\TiendaNota;
use Model\Ventas;
use MVC\Router;


class PruebasController
{

    // public static function crearPruebas(Router $router)
    // {
    //     session_start();
    //     if (!isset($_SESSION['email'])) {
    //         header('Location: /');
    //         exit;
    //     }

    //     // id_nota puede venir por GET o por POST
    //     $id_nota = $_GET['id'] ?? ($_POST['id_nota'] ?? null);
    //     if (!$id_nota) {
    //         header('Location: /admin/notaPedido/crearNota');
    //         exit;
    //     }

    //     // Catálogos
    //     $tiendas = Tienda::all();
    //     $bodega  = Bodega::all();
    //     $ciudad  = Ciudad::all();
    //     $pais    = Pais::all();
    //     $marca   = Marca::all();

    //     // Info de la nota
    //     $informacionNota = NotaPedido::where('Codigo_Nota_Pedido', $id_nota);
    //     $fecha = NotaPedido::where('Codigo_Nota_Pedido', $id_nota)->Fecha_Nota_Pedido ?? date('Y-m-d');

    //     // Datos de sesión
    //     $nombre = $_SESSION['nombre'];
    //     $email  = $_SESSION['email'];

    //     // Auxiliares
    //     $carritoTemporal = Carrito::all();
    //     $carrito = new Carrito;
    //     $alertas = [];

    //     // 1) Recuperar “old” de sesión (flash) si vienes de un redirect
    //     $old = $_SESSION['old'] ?? [];
    //     if (isset($_SESSION['old'])) {
    //         unset($_SESSION['old']); // flash: se usa una vez
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // 2) Guardar lo recibido como “old”
    //         $old = $_POST;

    //         // Mapear POST al modelo
    //         $carrito->Codigo_Nota_Pedido       = $id_nota;
    //         $carrito->Nombre_Tienda            = $_POST['Nombre_Tienda'] ?? '';
    //         $carrito->Fecha_Tienda_Nota_Pedido = $_POST['Fecha_Tienda_Nota_Pedido'] ?? null;
    //         $carrito->Factura_Nota_Pedido      = $_POST['Factura_Nota_Pedido'] ?? null;
    //         $carrito->Total_Tienda_Nota_Pedido = $_POST['Total_Tienda_Nota_Pedido'] ?? 0.00;
    //         $carrito->cantidad                 = $_POST['cantidad'] ?? 0;

    //         // Validación del modelo
    //         $alertas = $carrito->validar();

    //         if (empty($alertas)) {
    //             $resultado = $carrito->guardar();
    //             if ($resultado) {
    //                 // 3) Guardar “old” en sesión antes del redirect
    //                 $_SESSION['old'] = $old;
    //                 header("Location: /admin/pruebas/crearPruebas?id=$id_nota&exito=1");
    //                 exit;
    //             } else {
    //                 $alertas['error'][] = 'Error al guardar el registro';
    //             }
    //         }
    //         // Si hay errores, seguimos al render con $old ya cargado
    //     }

    //     // Renderizar la vista
    //     $router->render('admin/pruebas/crearPruebas', [
    //         'titulo'          => 'Crear Pruebas',
    //         'alertas'         => $alertas,
    //         'nombre'          => $nombre,
    //         'email'           => $email,
    //         'carritoTemporal' => $carritoTemporal,
    //         'id_nota'         => $id_nota,
    //         'informacionNota' => $informacionNota,
    //         'fecha'           => $fecha,
    //         'tiendas'         => $tiendas,
    //         'bodega'          => $bodega,
    //         'ciudad'          => $ciudad,
    //         'pais'            => $pais,
    //         'marca'           => $marca,
    //         'old'             => $old,
    //     ]);
    // }

    public static function crearPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        // id_nota puede venir por GET o por POST
        // $id_nota = $_GET['id'] ?? ($_POST['id_nota'] ?? null);
        // if (!$id_nota) {
        //     header('Location: /admin/notaPedido/crearNota');
        //     exit;
        // }



        $id_tienda_nota = $_GET['id'] ?? null;

        //  if (!$id_tienda_nota) {
        //     header('Location: /admin/notaPedido/crearNota');
        //     exit;
        // }



        // debuguear($id_tienda_nota);

        // obtener el id_nota a partir del id_tienda_nota
        $id_nota = TiendaNota::where('id', $id_tienda_nota)->Codigo_Nota_Pedido ?? null;


        // obtengo la información de la tienda nota
        // $informacionNota = TiendaNota::where('id', $id_tienda_nota);
        // debuguear($informacionNota);


        // debuguear($id_nota);









        // Detectar si el cliente quiere JSON (AJAX)
        $isAjax      = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        $acceptsJson = isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');
        $wantsJson   = $isAjax || $acceptsJson;

        // Catálogos (como los tenías)
        $tiendas = Tienda::all();
        $bodega  = Bodega::all();
        $ciudad  = Ciudad::all();
        $paises    = Pais::all();
        $marca   = Marca::all();
        $prendas = Prenda::all();



        // debuguear($paises);

        // Info de la nota (como lo tenías)
        $informacionNota = NotaPedido::where('Codigo_Nota_Pedido', $id_nota);


        //tienda_nota
        $tienda_nota = TiendaNota::where('id', $id_tienda_nota);

        $fecha = NotaPedido::where('Codigo_Nota_Pedido', $id_nota)->Fecha_Nota_Pedido ?? date('Y-m-d');

        // Datos de sesión
        $nombre = $_SESSION['nombre'];
        $email  = $_SESSION['email'];

        // Datos existentes para pintar en la vista
        $carritoTemporal2 = Carrito2::all('ASC');

        $carrito = new Carrito2;
        $alertas = [];

        // Flash "old" si vienes de redirect
        $old = $_SESSION['old'] ?? [];
        if (isset($_SESSION['old'])) {
            unset($_SESSION['old']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Guardar "old" para el flujo con redirect
            $old = $_POST;

            // Mapear POST -> modelo (solo los campos pedidos)
            // $carrito->Codigo_Nota_Pedido = $id_nota;  

            $id_tienda = $_POST['id_tienda'] ?? null;

            // debuguear($id_tienda);


            $id_nota = $_POST['id_nota'] ?? 0;

            $carrito->Codigo_Nota_Pedido = $id_nota;
            $carrito->etiqueta           = $_POST['etiqueta']   ?? 0;
            $carrito->prenda             = $_POST['Prenda_Partida']   ?? '';
            $carrito->saldo              = $_POST['saldo']   ?? 0;
            $carrito->composicion        = $_POST['composicion']   ?? '';
            $carrito->cantidad           = $_POST['cantidad'] ?? 0;
            $carrito->precio_unitario    = $_POST['precio_unitario'] ?? 0;
            // $carrito->total              = $_POST['total'] ?? 0;
            $carrito->total              = (float)($carrito->cantidad * $carrito->precio_unitario);
            $carrito->num_factura        = $_POST['num_factura'] ?? 0;
            $carrito->tienda             = $_POST['tienda'] ?? '';
            $carrito->marca              = $_POST['marca'] ?? '';
            $carrito->pais               = $_POST['pais'] ?? '';
            $carrito->num_caja           = $_POST['num_caja'] ?? 0;
            $carrito->bodega             = $_POST['bodega'] ?? '';
            $carrito->id_tienda          = $id_tienda ?? null;


            // Saneos mínimos
            $carrito->prenda   = trim((string)$carrito->prenda);
            $carrito->cantidad = is_numeric($carrito->cantidad) ? (float)$carrito->cantidad : 0.0;

            // Validación del modelo (usa tu Carrito2::validar())

            // debuguear($carrito);




            $alertas = $carrito->validar();


            // debuguear($carrito);

            if (empty($alertas)) {
                $ok = $carrito->guardar();

                if ($ok) {
                    // Rama AJAX/JSON: devolver JSON y NO redirigir
                    if ($wantsJson) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'ok'  => true,
                            'id'  => $carrito->id ?? null,
                            'row' => [
                                'id'                  => $carrito->id ?? null,
                                // nombres que usa el frontend en Handsontable
                                'codigo_nota_pedido'  => $carrito->Codigo_Nota_Pedido,
                                'etiqueta'            => $carrito->etiqueta,
                                'prenda'              => $carrito->prenda,
                                'saldo'               => $carrito->saldo,
                                'composicion'         => $carrito->composicion,
                                'cantidad'            => (float)$carrito->cantidad,
                                'precio_unitario'     => number_format((float)$carrito->precio_unitario, 2, '.', ''),
                                'total'               => number_format((float)$carrito->total, 2, '.', ''),
                                'num_factura'         => $carrito->num_factura,
                                'tienda'              => $carrito->tienda,
                                'marca'               => $carrito->marca,
                                'pais'                => $carrito->pais,
                                'num_caja'            => $carrito->num_caja,
                                'bodega'              => $carrito->bodega,
                                'id_tienda'           => $carrito->id_tienda,

                            ],
                        ], JSON_UNESCAPED_UNICODE);
                        exit;
                    }

                    // Rama FORM tradicional: redirect como siempre
                    $_SESSION['old'] = $old;

                    header("Location: /admin/pruebas/crearPruebas?id=$id_tienda&exito=1");

                    // cargo de nuevo la página para evitar reenvío de formulario





                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }

            // Si viene por AJAX y hay errores -> 422 con JSON
            if ($wantsJson) {
                http_response_code(422);
                header('Content-Type: application/json');
                echo json_encode([
                    'ok'     => false,
                    'errors' => $alertas,
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
            // Si es FORM y hay errores: continuar al render mostrando alertas
        }

        // Renderizar la vista
        $router->render('admin/pruebas/crearPruebas', [
            'titulo'            => 'Crear Pruebas',
            'alertas'           => $alertas,
            'nombre'            => $nombre,
            'email'             => $email,
            'carritoTemporal2'  => $carritoTemporal2,
            'id_nota'           => $id_nota,
            'informacionNota'   => $informacionNota,
            'fecha'             => $fecha,
            'tiendas'           => $tiendas,
            'bodega'            => $bodega,
            'ciudad'            => $ciudad,
            'paises'            => $paises,
            'marca'             => $marca,
            'old'               => $old,
            'prendas'           => $prendas,
            'tienda_nota'      => $tienda_nota,
        ]);
    }



    public static function crearPrenda()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            http_response_code(401);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['ok' => false, 'error' => 'No autorizado']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
            return;
        }

        // Campos (mismos nombres)
        $prenda = new Prenda;
        $prenda->Prenda_Partida      = trim($_POST['Prenda_Partida'] ?? '');
        $prenda->Partida_Partida     = trim($_POST['Partida_Partida'] ?? '');
        $prenda->Composicion_Partida = trim($_POST['Composicion_Partida'] ?? '');

        // Validación mínima
        if ($prenda->Prenda_Partida === '') {
            http_response_code(422);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['ok' => false, 'error' => 'El campo "Prenda" es obligatorio.']);
            return;
        }

        // Guardar
        $ok = $prenda->guardar(); // ideal: setea $prenda->id o retorna el ID
        if (!$ok) {
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['ok' => false, 'error' => 'No se pudo guardar.']);
            return;
        }

        // Respuesta JSON simple
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'ok' => true,
            'prenda' => [
                'id'                  => $prenda->id ?? null,
                'Prenda_Partida'      => $prenda->Prenda_Partida,
                'Partida_Partida'     => $prenda->Partida_Partida,
                'Composicion_Partida' => $prenda->Composicion_Partida,
            ],
        ], JSON_UNESCAPED_UNICODE);
    }










    public static function eliminarCarrito()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $id_nota = $_GET['id'] ?? ($_POST['id_nota'] ?? null);

        // AJAX/JSON
        $isAjax      = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        $acceptsJson = isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');
        $wantsJson   = $isAjax || $acceptsJson;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $carrito = $id ? Carrito2::find($id) : null;

            if ($carrito) {
                $carrito->eliminar();

                if ($wantsJson) {
                    header('Content-Type: application/json');
                    echo json_encode(['ok' => true], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                header("Location: /admin/pruebas/crearPruebas?id=$id_nota&eliminado=3");
                exit;
            } else {
                if ($wantsJson) {
                    http_response_code(404);
                    header('Content-Type: application/json');
                    echo json_encode(['ok' => false, 'error' => 'Registro no encontrado'], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                header("Location: /admin/pruebas/crearPruebas?id=$id_nota&error=1");
                exit;
            }
        }

        // No-POST
        if ($wantsJson) {
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'error' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        header("Location: /admin/pruebas/crearPruebas?id=$id_nota&error=1");
        exit;
    }




    public static function actualizarPruebas()
    {
        session_start();
        header('Content-Type: application/json');

        if (!isset($_SESSION['email'])) {
            echo json_encode(['ok' => false, 'error' => 'no-auth']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['ok' => false, 'error' => 'bad-method']);
            return;
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo json_encode(['ok' => false, 'error' => 'missing-id']);
            return;
        }

        $carrito = Carrito2::find($id);
        if (!$carrito) {
            echo json_encode(['ok' => false, 'error' => 'not-found']);
            return;
        }

        // Datos
        $idNota      = $_POST['id_nota'] ?? null;
        $etiqueta    = trim($_POST['etiqueta'] ?? '');
        $prenda      = trim($_POST['prenda'] ?? '');
        // cantidad - eitqueta es saldo
        $saldo     = (float)($_POST['cantidad'] ?? 0) - (float)($_POST['etiqueta'] ?? 0);
        $composicion = trim($_POST['composicion'] ?? '');
        $cantidad    = (float)($_POST['cantidad'] ?? 0);
        $precioU     = (float)($_POST['precio_unitario'] ?? 0);
        $total       = (float)($cantidad * $precioU);
        $num_factura = (int)($_POST['num_factura'] ?? 0);
        $tienda      = trim($_POST['tienda'] ?? '');
        $marca       = trim($_POST['marca'] ?? '');
        $pais        = trim($_POST['pais'] ?? '');
        $num_caja    = (int)($_POST['num_caja'] ?? 0);
        $bodega      = trim($_POST['bodega'] ?? '');
        $id_tienda   = isset($_POST['id_tienda']) ? (int)$_POST['id_tienda'] : null;

        // Actualizar
        $carrito->Codigo_Nota_Pedido = $idNota ?: $carrito->Codigo_Nota_Pedido;
        $carrito->etiqueta           = $etiqueta;
        $carrito->prenda             = $prenda;
        $carrito->saldo              = $saldo;
        $carrito->composicion        = $composicion;
        $carrito->cantidad           = $cantidad;
        $carrito->precio_unitario    = $precioU;
        $carrito->total              = $total;
        $carrito->num_factura        = $num_factura;
        $carrito->tienda             = $tienda;
        $carrito->marca              = $marca;
        $carrito->pais               = $pais;
        $carrito->num_caja           = $num_caja;
        $carrito->bodega             = $bodega;
        $carrito->id_tienda          = $id_tienda;

        $ok = $carrito->guardar();
        echo json_encode(['ok' => (bool)$ok, 'id' => $carrito->id]);
    }


    // public static function crearPruebasAjax()
    // {
    //     session_start();
    //     header('Content-Type: application/json');

    //     if (!isset($_SESSION['email'])) {
    //         echo json_encode(['ok' => false, 'error' => 'no-auth']);
    //         return;
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //         echo json_encode(['ok' => false, 'error' => 'bad-method']);
    //         return;
    //     }

    //     $idNota    = $_POST['id_nota'] ?? null;
    //     $id_tienda = isset($_POST['id_tienda']) ? (int)$_POST['id_tienda'] : 0;

    //     $etiqueta  = trim((string)($_POST['etiqueta'] ?? ''));
    //     $prenda    = trim((string)($_POST['prenda'] ?? ''));
    //     $cantidad  = (float)($_POST['cantidad'] ?? 0);
    //     $precioU   = (float)($_POST['precio_unitario'] ?? 0);

    //     // ✅ Solo evita filas vacías (NO es “duplicado”, es evitar basura)
    //     $isEmpty = ($etiqueta === '' && $prenda === '' && $cantidad == 0 && $precioU == 0);
    //     if (!$idNota || $id_tienda <= 0 || $isEmpty) {
    //         echo json_encode(['ok' => false, 'error' => 'empty-or-missing']);
    //         return;
    //     }

    //     $carrito = new Carrito2();

    //     $carrito->Codigo_Nota_Pedido = $idNota;
    //     $carrito->id_tienda          = $id_tienda;

    //     $carrito->etiqueta           = $etiqueta;
    //     $carrito->prenda             = $prenda;
    //     $carrito->saldo              = (float)($_POST['cantidad'] ?? 0) - (float)($_POST['etiqueta'] ?? 0);
    //     $carrito->composicion        = trim((string)($_POST['composicion'] ?? ''));
    //     $carrito->cantidad           = $cantidad;
    //     $carrito->precio_unitario    = $precioU;
    //     $carrito->total              = (float)($cantidad * $precioU);

    //     $carrito->num_factura        = "12345"; // (int)($_POST['num_factura'] ?? 0);""
    //     $carrito->tienda             = trim((string)($_POST['tienda'] ?? ''));
    //     $carrito->marca              = trim((string)($_POST['marca'] ?? ''));
    //     $carrito->pais               = trim((string)($_POST['pais'] ?? ''));
    //     $carrito->num_caja           = (int)($_POST['num_caja'] ?? 0);
    //     $carrito->bodega             = trim((string)($_POST['bodega'] ?? ''));


    //     // si esta duplicado no lo guarda
    //     $duplicados =Carrito2:: whereArray(
    //         [
    //             'cantidad' => $carrito->cantidad,
    //             'etiqueta'           => $carrito->etiqueta,
    //             'prenda'             => $carrito->prenda,
    //             'composicion'        => $carrito->composicion,
    //             'cantidad'           => $carrito->cantidad,
    //             'precio_unitario'    => $carrito->precio_unitario,
    //             'id_tienda'          => $carrito->id_tienda,
    //         ]
    //     );

    //     $alertas = $carrito->validar();
    //     if (!empty($alertas)) {
    //         http_response_code(422);
    //         echo json_encode(['ok' => false, 'errors' => $alertas], JSON_UNESCAPED_UNICODE);
    //         return;
    //     }

    //     if (!empty($duplicados)) {
        
    //         $ok = $carrito->guardar();
    //     }

    //     if (!$ok) {
    //         echo json_encode(['ok' => false, 'error' => 'db-save-failed']);
    //         return;
    //     }

    //     echo json_encode(['ok' => true, 'id' => $carrito->id], JSON_UNESCAPED_UNICODE);
    // }

public static function crearPruebasAjax()
{
    session_start();
    header('Content-Type: application/json; charset=utf-8');

    if (!isset($_SESSION['email'])) {
        echo json_encode(['ok' => false, 'error' => 'no-auth'], JSON_UNESCAPED_UNICODE);
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['ok' => false, 'error' => 'bad-method'], JSON_UNESCAPED_UNICODE);
        return;
    }

    // --------- Inputs ----------
    $idNota    = $_POST['id_nota'] ?? null;
    $id_tienda = isset($_POST['id_tienda']) ? (int)$_POST['id_tienda'] : 0;

    $etiqueta  = trim((string)($_POST['etiqueta'] ?? ''));
    $prenda    = trim((string)($_POST['prenda'] ?? ''));
    $cantidad  = (float)($_POST['cantidad'] ?? 0);
    $precioU   = (float)($_POST['precio_unitario'] ?? 0);

    // ✅ Solo evita filas vacías (basura)
    $isEmpty = ($etiqueta === '' && $prenda === '' && $cantidad == 0 && $precioU == 0);

    if (!$idNota || $id_tienda <= 0 || $isEmpty) {
        echo json_encode(['ok' => false, 'error' => 'empty-or-missing'], JSON_UNESCAPED_UNICODE);
        return;
    }

    // --------- Modelo ----------
    $carrito = new Carrito2();

    $carrito->Codigo_Nota_Pedido = $idNota;
    $carrito->id_tienda          = $id_tienda;

    $carrito->etiqueta           = $etiqueta;
    $carrito->prenda             = $prenda;

    // ✅ saldo NO debe restar etiqueta (texto). Ajusta si tu negocio requiere otra lógica.
    // Por defecto lo dejamos igual a la cantidad (o usa 0 si aplica)
    $carrito->saldo              = $cantidad;

    $carrito->composicion        = trim((string)($_POST['composicion'] ?? ''));
    $carrito->cantidad           = $cantidad;
    $carrito->precio_unitario    = $precioU;
    $carrito->total              = (float)($cantidad * $precioU);

    // Otros campos
    $carrito->num_factura        = trim((string)($_POST['num_factura'] ?? ''));
    $carrito->tienda             = trim((string)($_POST['tienda'] ?? ''));
    $carrito->marca              = trim((string)($_POST['marca'] ?? ''));
    $carrito->pais               = trim((string)($_POST['pais'] ?? ''));
    $carrito->num_caja           = (int)($_POST['num_caja'] ?? 0);
    $carrito->bodega             = trim((string)($_POST['bodega'] ?? ''));

    // --------- Validación ----------
    $alertas = $carrito->validar();
    if (!empty($alertas)) {
        http_response_code(422);
        echo json_encode(['ok' => false, 'errors' => $alertas], JSON_UNESCAPED_UNICODE);
        return;
    }

    // --------- Duplicado: SOLO si TODOS los campos coinciden ----------
    // Incluye Codigo_Nota_Pedido para que NO compare contra otras notas.
    $duplicados = Carrito2::whereArray([
        'Codigo_Nota_Pedido' => $carrito->Codigo_Nota_Pedido,
        'id_tienda'          => $carrito->id_tienda,
        'etiqueta'           => $carrito->etiqueta,
        'prenda'             => $carrito->prenda,
        'composicion'        => $carrito->composicion,
        'cantidad'           => $carrito->cantidad,
        'precio_unitario'    => $carrito->precio_unitario,
        'num_caja'           => $carrito->num_caja,
        'bodega'             => $carrito->bodega,
        // Si quieres que tienda/marca/pais también cuenten como “idéntico”, descomenta:
        'tienda'          => $carrito->tienda,
        'marca'           => $carrito->marca,
        'pais'            => $carrito->pais,
        'num_factura'     => $carrito->num_factura,
    ]);

    // ✅ Si existe IDENTICO → NO guardar
    if (!empty($duplicados)) {
        echo json_encode(['ok' => false, 'error' => 'duplicate-row'], JSON_UNESCAPED_UNICODE);
        return;
    }

    // ✅ Si NO existe → guardar
    $ok = $carrito->guardar();

    if (!$ok) {
        echo json_encode(['ok' => false, 'error' => 'db-save-failed'], JSON_UNESCAPED_UNICODE);
        return;
    }

    echo json_encode(['ok' => true, 'id' => $carrito->id], JSON_UNESCAPED_UNICODE);
}


















    public static function registrarVenta()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito2::wherenuevo('id_usuario', $id_usuario);

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
            $via_trasporte = $_POST['via_trasporte'] ?? 0;
            $puerto_embarque = $_POST['puerto_embarque'] ?? 0;
            $puerto_destino = $_POST['puerto_destino'] ?? 0;
            $Fob_Nota_Pedido = $_POST['Fob_Nota_Pedido'] ?? 0;
            $Flete_Nota_Pedido = $_POST['Flete_Nota_Pedido'] ?? 0;
            $Costo_Flete_Nota_Pedido = $_POST['Costo_Flete_Nota_Pedido'] ?? 0;
            $Seguro_Nota_Pedido = $_POST['Seguro_Nota_Pedido'] ?? 0;





            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Compra;
            // $venta->id_usuario = $id_usuario;
            $venta->Total_Nota_Pedido = $total;
            $venta->via_trasporte = $via_trasporte;
            $venta->puerto_embarque = $puerto_embarque;
            $venta->puerto_destino = $puerto_destino;
            $venta->Fob_Nota_Pedido = $Fob_Nota_Pedido;
            $venta->Flete_Nota_Pedido = $Flete_Nota_Pedido;
            $venta->Costo_Flete_Nota_Pedido = $Costo_Flete_Nota_Pedido;
            $venta->Seguro_Nota_Pedido = $Seguro_Nota_Pedido;


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

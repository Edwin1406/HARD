<?php
namespace Controllers;

use MVC\Router;
use Model\Locations;

class LocalizarController
{
    /**
     * Vista: Registro de Vehículos
     * - Requiere sesión
     * - Renderiza la página donde el usuario selecciona vehículo e inicia el envío de GPS
     */
  
 public static function registroVehiculos(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $nombre = $_SESSION['nombre'] ?? '';
        $email  = $_SESSION['email']  ?? '';

        // Si aún no tienes catálogo de vehículos,
        // armamos uno deduplicando desde Locations::all()
        $vehiculosRaw = Locations::all();

        $vehiculos = []; // arreglo indexado por código (para deduplicar)
        foreach ($vehiculosRaw as $loc) {
            $code = trim($loc->vehicle_code ?? '');
            if ($code === '') continue;

            if (!isset($vehiculos[$code])) {
                $vehiculos[$code] = [
                    'code' => $code,
                    'name' => trim($loc->vehicle_name ?? ''),
                ];
            }
        }

        // Render
        $router->render('admin/vehiculos/registroVehiculos', [
            'titulo'     => 'Registro de Vehículos',
            'nombre'     => $nombre,
            'email'      => $email,
            'vehiculos'  => array_values($vehiculos), // pasar como lista simple
        ]);
    }








    /**
     * API: Recibe y guarda un punto de geolocalización.
     * Método: POST /api/locations/store
     * Body: JSON { vehicle_code, vehicle_name?, lat, lng, accuracy?, heading?, speed?, measured_at? }
     *
     * NOTA: el TRIGGER en DB se encarga de que el registro más reciente
     * quede con is_lastest = 1 y los demás en 0.
     */
    public static function apiGuardarUbicacion()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    http_response_code(204); exit;
}
header('Vary: Origin');



        // Leer JSON crudo
        $raw = file_get_contents('php://input');
        $in  = json_decode($raw, true);

        if (!$in) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'JSON inválido']);
            return;
        }

        // Validaciones básicas
        $vehicle_code = isset($in['vehicle_code']) ? trim($in['vehicle_code']) : '';
        $lat = $in['lat'] ?? null;
        $lng = $in['lng'] ?? null;

        if ($vehicle_code === '' || !is_numeric($lat) || !is_numeric($lng)) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'error' => 'Datos faltantes o inválidos']);
            return;
        }

        // Campos opcionales
        $vehicle_name = $in['vehicle_name'] ?? null;
        $accuracy     = isset($in['accuracy']) ? (float)$in['accuracy'] : null;
        $heading      = isset($in['heading']) ? (float)$in['heading'] : null;
        $speed        = isset($in['speed']) ? (float)$in['speed'] : null;
        // Si te llega ISO8601, conviértelo a "Y-m-d H:i:s"; si no, usa ahora.
        $measured_at  = $in['measured_at'] ?? date('Y-m-d H:i:s');
        if (preg_match('/^\d{4}-\d{2}-\d{2}T/', $measured_at)) {
            $measured_at = str_replace('T', ' ', substr($measured_at, 0, 19));
        }

        // Crear objeto Locations (tu ActiveRecord)
        $loc = new Locations([
            'vehicle_code' => $vehicle_code,
            'vehicle_name' => $vehicle_name,
            'lat'          => (float)$lat,
            'lng'          => (float)$lng,
            'accuracy'     => $accuracy,
            'heading'      => $heading,
            'speed'        => $speed,
            'measured_at'  => $measured_at,
            'is_lastest'   => 0, // el TRIGGER pondrá 1 al más reciente real
        ]);

        // Guardar
        if (!$loc->guardarPrepared()) {
            http_response_code(500);
            echo json_encode(['ok' => false, 'error' => 'No se pudo guardar']);
            return;
        }

        // Nada más: el TRIGGER en DB actualiza is_lastest.
        echo json_encode(['ok' => true, 'id' => $loc->id]);
    }

    /**
     * API: Últimas posiciones "activas" (para pintar en mapa o monitoreo)
     * Método: GET /api/locations/latest?active_secs=60
     * Devuelve solo registros con is_lastest = 1 y medidos en los últimos N segundos.
     */
    public static function apiUltimas()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    http_response_code(204); exit;
}
header('Vary: Origin');

        $activeSecs = isset($_GET['active_secs']) ? (int) $_GET['active_secs'] : 60;
        $rows = \Model\Locations::ultimas($activeSecs);

        echo json_encode($rows);
    }
}

<?php

namespace Model;

use DateTime;

class Ventas extends ActiveRecord {    
    protected static $tabla = 'VENTAS';
    protected static $columnasDB = ['id','id_usuario','consumo_papel','metros_lineales','metros_lineales_C','n_laminas','n_cambios','consumo_almidon','consumo_resina','consumo_recubrimiento','metros_lineales_B','metros_lineales_E','operador','turno','total','fecha'];

    public ?int $id;
    public ?int $id_usuario;
    public ?int $consumo_papel;
    public $metros_lineales;
    public $metros_lineales_C;
    public ?int $n_laminas;
    public ?int $n_cambios;
    public $consumo_almidon;
    public $consumo_resina;
    public $consumo_recubrimiento;
    public $metros_lineales_B;
    public $metros_lineales_E;
    public $operador;
    public $turno;
    public ?float $total;
    public ?string $fecha;

    public function __construct(array $args = []) {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s');

        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->consumo_papel = $args['consumo_papel'] ?? null;
        $this->metros_lineales_C = $args['metros_lineales_C'] ?? null;
        $this->metros_lineales = $args['metros_lineales'] ?? null;
        $this->n_laminas = $args['n_laminas'] ?? null;
        $this->n_cambios = $args['n_cambios'] ?? null;
        $this->consumo_almidon = $args['consumo_almidon'] ?? null;
        $this->consumo_resina = $args['consumo_resina'] ?? null;
        $this->consumo_recubrimiento = $args['consumo_recubrimiento'] ?? null;
        $this->metros_lineales_B = $args['metros_lineales_B'] ?? null;
        $this->metros_lineales_E = $args['metros_lineales_E'] ?? null;
        $this->operador = $args['operador'] ?? null;    
        $this->turno = $args['turno'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->fecha = $args['fecha'] ?? $fecha;

    }

}



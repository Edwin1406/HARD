<?php 
namespace Model;

class Carrito2 extends ActiveRecord {

    protected static $tabla = 'carrito2';
    protected static $columnasDB = [
        'id',
        'prenda',
        'cantidad'
    ];

    public $id;
    public $prenda;
    public $cantidad;
    
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->prenda = $args['prenda'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;

    }
}

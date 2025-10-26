<?php 
namespace Model;

class TiendaNota extends ActiveRecord {

    protected static $tabla = 'picos_nota';
    protected static $columnasDB = [
        'id',
        'Codigo_Nota_Pedido',
        'tienda'
    ];

    public $id;
    public $Codigo_Nota_Pedido;
    public $tienda;


    public function __construct($args = [])
    {
        $this->id               = $args['id'] ?? null;
        $this->Codigo_Nota_Pedido= $args['Codigo_Nota_Pedido'] ?? null;
        $this->tienda           = $args['tienda'] ?? '';
        
    }

    public function validar() {
        if(!$this->tienda) {
            self::$alertas['error'][] = 'El Campo Tienda es Obligatorio';
        }
        return self::$alertas;
    }
}

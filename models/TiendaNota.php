<?php 
namespace Model;

class TiendaNota extends ActiveRecord {

    protected static $tabla = 'picos_nota';
    protected static $columnasDB = [
        'id',
        'Codigo_Nota_Pedido',
        'tienda',
        'ciudad',
        'pais',
        'fecha',
        'num_factura'
    ];

    public $id;
    public $Codigo_Nota_Pedido;
    public $tienda;
    public $ciudad;
    public $pais;
    public $fecha;
    public $num_factura;
    


    public function __construct($args = [])
    {
        $this->id               = $args['id'] ?? null;
        $this->Codigo_Nota_Pedido= $args['Codigo_Nota_Pedido'] ?? null;
        $this->tienda           = $args['tienda'] ?? '';
        $this->ciudad          = $args['ciudad'] ?? '';
        $this->pais            = $args['pais'] ?? '';
        $this->fecha          = $args['fecha'] ?? '';
        $this->num_factura    = $args['num_factura'] ?? '';
    }

    public function validar() {
        if(!$this->tienda) {
            self::$alertas['error'][] = 'El Campo Tienda es Obligatorio';

        }

        if(!$this->ciudad) {
            self::$alertas['error'][] = 'El Campo Ciudad es Obligatorio';

        }



        if(!$this->fecha) {
            self::$alertas['error'][] = 'El Campo Fecha es Obligatorio';
        }
        




        return self::$alertas;
    }
}

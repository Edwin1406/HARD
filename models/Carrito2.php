<?php 
namespace Model;

class Carrito2 extends ActiveRecord {

    protected static $tabla = 'carrito2';
    protected static $columnasDB = [
        'id',
        'Codigo_Nota_Pedido',
        'prenda',
        'cantidad',
        'precio_unitario',
        'total'
    ];

    public $id;
    public $Codigo_Nota_Pedido;
    public $prenda;
    public $cantidad;
    public $precio_unitario;
    public $total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Codigo_Nota_Pedido = $args['Codigo_Nota_Pedido'] ?? null;
        $this->prenda = $args['prenda'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->precio_unitario = $args['precio_unitario'] ?? 0.0;
        $this->total = $args['total'] ?? 0.0;

    }
}

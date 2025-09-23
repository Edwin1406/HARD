<?php 
namespace Model;

class Carrito extends ActiveRecord {

    protected static $tabla = 'carrito';
    protected static $columnasDB = [
        'id',
        'Nombre_Tienda',
        'Fecha_Tienda_Nota_Pedido',
        'Factura_Nota_Pedido',
        'Total_Tienda_Nota_Pedido',
        'cantidad'
    ];

    public $id;
    public $Nombre_Tienda;
    public $Fecha_Tienda_Nota_Pedido;
    public $Factura_Nota_Pedido;
    public $Total_Tienda_Nota_Pedido;
    public $cantidad;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Nombre_Tienda = $args['Nombre_Tienda'] ?? '';
        $this->Fecha_Tienda_Nota_Pedido = $args['Fecha_Tienda_Nota_Pedido'] ?? null;
        $this->Factura_Nota_Pedido = $args['Factura_Nota_Pedido'] ?? null;
        $this->Total_Tienda_Nota_Pedido = $args['Total_Tienda_Nota_Pedido'] ?? 0.00;
        $this->cantidad = $args['cantidad'] ?? 0;
    }
}

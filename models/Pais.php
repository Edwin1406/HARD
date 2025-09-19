<?php 
namespace Model;


class Pais extends ActiveRecord {

    protected static $tabla = 'ORIGEN';
    protected static $columnasDB = ['id', 'Nombre_Origen'];

    public $id;
    public $Nombre_Origen;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Nombre_Origen = $args['Nombre_Origen'] ?? '';
   
    }


    public function validar() {

        if(!$this->Nombre_Origen) {
            self::$alertas['error'][] = 'El Campo Nombre Origen es Obligatorio';

        }
       
        return self::$alertas;
    }





}
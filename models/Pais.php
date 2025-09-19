<?php 
namespace Model;


class Pais extends ActiveRecord {

    protected static $tabla = 'ORIGEN';
    protected static $columnasDB = ['id', 'Nombre_Pais'];

    public $id;
    public $Nombre_Pais;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Nombre_Pais = $args['Nombre_Pais'] ?? '';
   
    }


    public function validar() {

        if(!$this->Nombre_Pais) {
            self::$alertas['error'][] = 'El Campo Nombre Pais es Obligatorio';

        }
       
        return self::$alertas;
    }





}
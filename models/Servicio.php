<?php 
namespace Model;

class Servicio extends ActiveRecord {

    protected static $tabla="servicios";
    protected static $columnasBD=['id','nombre','descripcion','precio'];

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct($arsg= [])
    {
        $this->id=$arsg['id'] ?? null;
        $this->nombre=$arsg['nombre'] ?? "";
        $this->descripcion=$arsg["descripcion"] ??
        $this->precio=$arsg['precio'] ?? "";
    }
}


?>
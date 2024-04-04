<?php
namespace Model;
use Model\ActiveRecord;



class Paquete extends ActiveRecord{
    protected static $tabla = "paquete";
    protected static $columnasDB = ["id","nombre"];

    public $id;
    public $nombre;
    
}
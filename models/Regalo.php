<?php
namespace Model;
use Model\ActiveRecord;

class Regalo extends ActiveRecord{
    protected static $tabla = "regalo";
    protected static $columnasDB = ["id","nombre"];

    public $id;
    public $nombre;


    public function __construct($data = []){
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ??  '';
    

     
    }

}
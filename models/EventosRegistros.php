<?php
namespace Model;
class EventosRegistros extends ActiveRecord{
    protected static $tabla = "evento_registro";
    protected static $columnasDB = ["id","evento_id","registro_id"];

    public $id;
    public $evento_id;
    public $registro_id;

    public function __construct($data = []){
        $this->id = $data['id'] ?? null;
        $this->evento_id = $data['evento_id'] ?? '';
        $this->registro_id = $data['registro_id'] ?? '';
    }
    

}
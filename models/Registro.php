<?php
namespace Model;
use Model\ActiveRecord;

class Registro extends ActiveRecord{
    protected static $tabla = "registro";
    protected static $columnasDB = ["paquete_id","pago_id","token","usuario_id"];

    public $id;
    public $paquete_id;
    public $pago_id;
    public $usuario_id;
    public $token;

    public function __construct($data = []){
        $this->id = $data['id'] ?? null;
        $this->paquete_id = $data['paquete_id'] ??  '';
        $this->pago_id = $data['pago_id'] ?? '' ;
        $this->usuario_id = $data['usuario_id'] ??  '';
        $this->token = $data['token'] ?? '';

     
    }

}
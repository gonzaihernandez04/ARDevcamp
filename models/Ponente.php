<?php
namespace Model;
use Model\ActiveRecord;

class Ponente extends ActiveRecord{
    public static $tabla = 'ponente';
    public static $columnasDB= ['id','nombre','apellido','ciudad','pais','imagen','tags','redes'];




    public function __construct($datos = []){

        
        $this->id = $datos['id'] ?? null;
        $this->nombre = $datos['nombre'] ?? '';
        $this->apellido = $datos['apellido'] ??'';
        $this->ciudad = $datos['ciudad'] ?? '';
        $this->pais = $datos['pais'] ??'';
        $this->imagen = $datos['imagen'] ??'';
        $this->tags = $datos['tags'] ??'';
        $this->redes = $datos['redes'] ?? '';
    }

    public function validarCrearPonente(): array{
        if(!$this->nombre) self::$alertas['error'][] = "Debes colocar un nombre";
        if(!$this->apellido) self::$alertas['error'][] = "Debes colocar un apellido";
        if(!$this->ciudad) self::$alertas['error'][] = "Debes colocar una ciudad";
        if(!$this->pais) self::$alertas['error'][] = "Debes colocar una pais";
        if(!$this->imagen) self::$alertas['error'][] = "Debes colocar una imagen";
        if(!$this->tags) self::$alertas['error'][] = "Debes colocar tags relacionados con el ponente";
        if(strlen($this->tags)>130) self::$alertas["error"][] = "Debes colocar menos tags";

        return self::$alertas;
    }





    public function validarCampos(){

    }
}
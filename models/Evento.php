<?php

namespace Model;
class Evento extends ActiveRecord{
    protected static $tabla = "evento";
    protected static $columnasDB = ["id","nombre","descripcion","disponibles","categoria_id","dia_id","hora_id"," ponente_id"];

    public $id;
    public $nombre;
    public $descripcion;
    public $disponibles;
    public $categoria_id;
    public $dia_id;
    public $hora_id;
    public $ponente_id;

    public function __construct($datos=[]){
        $this->id = $datos['id'] ?? null;
        $this->nombre = $datos['nombre'] ?? '';
        $this->descripcion = $datos['descripcion'] ?? '';
        $this->disponibles = $datos['disponibles'] ?? '';
        $this->categoria_id = $datos['categoria_id'] ?? '';
        $this->dia_id = $datos['dia_id'] ?? '';
        $this->hora_id = $datos['hora_id'] ?? '';
        $this->ponente_id = $datos['ponente_id'] ?? '';
    }
    
    // Mensajes de validación para la creación de un evento
public function validar() {
    if(!$this->nombre) {
        self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->descripcion) {
        self::$alertas['error'][] = 'La descripción es Obligatoria';
    }
    if(!$this->categoria_id  || !filter_var($this->categoria_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige una Categoría';
    }
    if(!$this->dia_id  || !filter_var($this->dia_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige el Día del evento';
    }
    if(!$this->hora_id  || !filter_var($this->hora_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige la hora del evento';
    }
    if(!$this->disponibles  || !filter_var($this->disponibles, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Añade una cantidad de Lugares Disponibles';
    }
    if(!$this->ponente_id || !filter_var($this->ponente_id, FILTER_VALIDATE_INT) ) {
        self::$alertas['error'][] = 'Selecciona la persona encargada del evento';
    }

    return self::$alertas;
}

}
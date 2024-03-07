<?php
namespace Model;
use Model\ActiveRecord;

class Hora extends ActiveRecord {
    protected static $tabla = 'hora';
    protected static $columnasDB = ["id","hora"];
  
    public $id;
    public $hora;
}
<?php

namespace Model;
use Model\ActiveRecord;
class ApiEvento extends ActiveRecord{

    protected static $tabla = "evento";
    protected static $columnasDB = ["id","categoria_id", "dia_id","hora_id"];

    public $id;
    public $categoria_id;
    public $dia_id;
    public $hora_id;
    


}
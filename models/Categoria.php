<?php
namespace Model;
class Categoria extends ActiveRecord{
    protected static $tabla = "categoria";
    protected static $columnasDB = ["id","nombre"];

    public $id;
    public $nombre;
    

}
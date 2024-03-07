<?php
namespace Controllers;

use Model\ApiEvento;

class ApiEventosController{

    public static function index(){
        $dia_id = $_GET['dia_id'] ?? null;
        $categoria_id = $_GET['categoria_id'] ?? null;

        $dia_id = filter_var($dia_id,FILTER_VALIDATE_INT);
        $categoria_id = filter_var($categoria_id,FILTER_VALIDATE_INT);
        if(!$dia_id || !$categoria_id){
            echo json_encode(['status'=> 'error','message'=> 'error']);
            return;
         
        }

   

        // Consultar base de datos
        $eventos = ApiEvento::whereArray([
            "dia_id"=>$dia_id,
            "categoria_id"=>$categoria_id,
        ]) ?? [];
        echo json_encode(["eventos"=>$eventos]);
    }

}
 

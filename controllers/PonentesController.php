<?php
namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class PonentesController{
    public static function index(Router $router){

   

        $router->render('admin/ponentes/index',[
            'titulo'=> 'Ponentes'
        ]);
    }


    public static function crear(Router $router){
        $alertas = [];
       if($_SERVER['REQUEST_METHOD'] === "POST"){

       }

        $router->render('admin/ponentes/crear',[
            'titulo'=> 'Registrar ponente',
            'alertas'=> $alertas
        ]);
    }
}
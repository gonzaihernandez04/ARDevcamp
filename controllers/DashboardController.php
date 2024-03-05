<?php
namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");

        $router->render('admin/dashboard/index',[
            'titulo'=> 'Panel de administracion'
        ]);
    }
}
<?php
namespace Controllers;
use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;
use Classes\Paginacion;

class EventosController{
    public static function index(Router $router){
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");
    // Obtengo el GET, que al principio es null
        $pagina_actual = $_GET['page'];
        // Valido que sea un entero, aunque no exista
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);

        // Si no existe una pagina, o el valor es menor a 1, establezco la direccion page=1;
        //La primera vez siempre sera =1 ya que esta variable $_get, no existe.
        if(!$pagina_actual || $pagina_actual<1) header("Location: /admin/eventos?page=1");

        $total = Evento::total();

        $registros_por_pagina = 10;
    

        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total);

        if($paginacion->total_paginas()<$pagina_actual){
            header("Location: /admin/eventos?page=1");
        }

    
        $eventos = Evento::paginar($registros_por_pagina,$paginacion->offset());
        
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }


        
        $router->render('admin/eventos/index',[
            'titulo'=> 'Conferencias y Workshops',
            "eventos"=>$eventos,
            'paginacion'=> $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router){
        if(!isAdmin()){
            header("Location: /login");
        }

        $alertas = [];
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento = new Evento;
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $evento->sincronizar($_POST);
            $evento->ponente = Ponente::find($evento->ponente_id);            
            $alertas = $evento->validar();
            if(empty($alertas)){
                $resultado = $evento->guardar();
                if($resultado) header("Location: /admin/eventos");
            }
        }
        

        $router->render('admin/eventos/crear',[
            "titulo"=>'Crear evento',
            "categorias"=> $categorias,
            "alertas"=>$alertas,
            "dias"=>$dias,
            "horas"=>$horas,
            "evento"=>$evento ?? '',
   
        ]);
    }



    public static function editar(Router $router){
        if(!isAdmin()){
            header("Location: /login");
        }

        $alertas = [];
        $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
        if(!$id) header("Location: /admin/eventos");

        $evento = Evento::find($id);    

        if(!$evento) header("Location: /admin/eventos");

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento->ponente = Ponente::find($evento->ponente_id);            


        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $evento->sincronizar($_POST);
            $evento->ponente = Ponente::find($evento->ponente_id);   
            $alertas = $evento->validar();

            if(empty($alertas)){
                unset($evento->ponente);
                $resultado = $evento->guardar();
                if($resultado) header("Location: /admin/eventos");
            }
        }
        

        $router->render('admin/eventos/editar',[
            "titulo"=>'Editar evento',
            "categorias"=> $categorias,
            "alertas"=>$alertas,
            "evento"=>$evento,
            "dias"=>$dias,
            "horas"=>$horas
        ]);
    }


    public static function eliminar(){

        if(!isAdmin()){
            header("Location: /login");
        }

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $evento = Evento::find($_POST['id']);    
            if(!$evento){
                header('Location: /admin/eventos');
            }
                $resultado = $evento->eliminar();
                if($resultado) header('Location:/admin/eventos');
            
        }
    }

}
<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;

class RegistroController
{
    public static function crear(Router $router)
    {
        if (!isAuth()) header("Location: /");

        // Verificar si el usuario ya esta registrado.
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && $registro->paquete_id == "3") {
            header("Location: /boleto?id=" . urlencode($registro->token));
        }


        $router->render('registro/crear', [
            "titulo" => " ArgDevCamp | Finalizar Registro"
        ]);
    }

    public static function gratis(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Verificar si el usuario ya esta registrado.
            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if (isset($registro) && $registro->paquete_id == "3") {
                header("Location: /boleto?id=" . urlencode($registro->token));
            }
            if (!isAuth()) header("Location: /");

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = [
                'paquete_id' => 3,
                'token' => $token,
                'pago_id' => '',
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);

            $resultado = $registro->guardar();


            // Urlencode() evita caracteres especiales.
            if ($resultado) header("Location: /boleto?id=" . urlencode($registro->token));
        }
        $router->render('registro/crear', [
            "titulo" => " Finalizar Registro"
        ]);
    }

    

    public static function pagar(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(!isAuth()) {
                echo json_encode(["resultado" => "error"]); // Usuario no autenticado
                return;
            }
    
            // Validar que post no venga vacio
            if(empty($_POST)){
                echo json_encode([]); // Datos vacíos
                return;
            }
    
            // Crear registro
            $token = substr(md5(uniqid(rand(),true)),0,8);
            $datos = $_POST;
            $datos['token'] = $token;
            $datos['usuario_id'] = $_SESSION['id'];
    
            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode(["resultado" => $resultado]); // Envía la respuesta JSON
            } catch (\Throwable $th) {
                echo json_encode(["resultado" => "error"]); // Error en la creación del registro
            }
    
            return; // Salir del controlador después de enviar la respuesta JSON
        }
        
        $router->render('registro/crear', [
            "titulo" => "Finalizar Registro"
        ]);
    }

    public static function boleto(Router $router)
    {
        $alertas = [];
        $id = $_GET['id'];

        if (!$id || !strlen($id) == 8) {
            header("Location: /");
        }


        // Buscar en BD

        $registro = Registro::where('token', $id);

        if (!$registro) {
            header("Location: /");
        }

        // Llenar las tablas de referencia

        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);

        $alertas = Registro::getAlertas();


        if (!isAuth()) header("Location: /");
        $router->render('registro/boleto', [
            "titulo" => " Asistencia a ArgDevCamp",
            "alertas" => $alertas,
            'registro' => $registro
        ]);
    }



    public static function conferencias(Router $router)
    {
        if (!isAuth()) header("Location: /login");

        // Validar que el usuario tenga el plan presencial

        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id',$usuario_id);

        if($registro->paquete_id !== "1"){
            header("Location: /login");
        }

        $eventos = Evento::ordenar('hora_id','ASC');
        $eventos_formateados = [];

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            if($evento->dia_id == "1" && $evento->categoria_id =="1"){
                $eventos_formateados['conferencias_v'][] = $evento;
            }

            if($evento->dia_id == "2" && $evento->categoria_id =="1"){
                $eventos_formateados['conferencias_s'][] = $evento;
            }


            if($evento->dia_id == "1" && $evento->categoria_id =="2"){
                $eventos_formateados['workshops_v'][] = $evento;
            }

            if($evento->dia_id == "2" && $evento->categoria_id =="2"){
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }
        $router->render('registro/conferencias', [
            "titulo" => " Elige Workshops y Conferencias",
            "eventos"=>$eventos_formateados
           
        ]);
    }
}

<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;

class RegistroController
{
    public static function crear(Router $router)
    {
        if (!isAuth()) header("Location: /");

        // Verificar si el usuario ya esta registrado.
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        // En caso de que el pase sea gratuito,presencial, o virtual y haya un registro que lo lelve al boleto
          if( isset($registro->regalo_id) && $registro->regalo_id == "1" && $registro->paquete_id == "3" ) {
            header('Location: /boleto?id=' . urlencode($registro->token));
        
      
          } else if(isset($registro->regalo_id) && ($registro->regalo_id == "1" || ($registro->paquete_id == "1" )))  {
            header('Location: /finalizar-registro/conferencias');       
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!isAuth()) {
                echo json_encode(["resultado" => "error"]); // Usuario no autenticado
                return;
            }

            // Validar que post no venga vacio
            if (empty($_POST)) {
                echo json_encode([]); // Datos vacíos
                return;
            }

            // Crear registro
            $token = substr(md5(uniqid(rand(), true)), 0, 8);
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
        $registro = Registro::where('usuario_id', $usuario_id);
        $evento_registro = EventosRegistros::where('registro_id',$registro->id);

        if (!isset($registro->paquete_id)) {
            header("Location: /login");
        }
        // Si el paquete es gratis o el 2 y el regalo == "1"(sin regalo), que me redirija al boleto
        if(($registro->paquete_id == "3" || $registro->paquete_id=="2") && $registro->regalo_id =="1"){
            header("Location: /boleto?id=". urlencode($registro->token));
        }
        // SI ya existe un registro con X id en las inscripciones, que lo redirija al boleto, esto se utiliza para evitar usar al regalo como forma de verifiacion que que se inscribio una persona. Se utiliza para la comprobacion de aquellos que compraron pase presencial. Si no existe ningun evento_registro segun el registro, arrojara null, es decir, no existira, por lo que, no se debe redirigir al boleto. S produce un corto circuito.

        if(isset($evento_registro->registro_id) && $evento_registro->registro_id == $registro->id){
            header("Location: /boleto?id=". urlencode($registro->token));

        }

        $eventos = Evento::ordenar('hora_id', 'ASC');
        $eventos_formateados = [];

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            if ($evento->dia_id == "1" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }

            if ($evento->dia_id == "2" && $evento->categoria_id == "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }


            if ($evento->dia_id == "1" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }

            if ($evento->dia_id == "2" && $evento->categoria_id == "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        // Manejando registro mediante post

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Revisar que el user este AUTH

            if (!isAuth()) header("Location: /login");

            $eventos = explode(',', $_POST['eventos']);
            if (empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }
            $eventos_array = [];
            // Obtener registro de usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if (!isset($registro) || $registro->paquete_id != "1") {
                echo json_encode(['resultado' => false]);
                return;
            }

            // Validar la disponibilidad de los eventos seleccionados

            foreach ($eventos as $evento_id) {
                $evento = Evento::find($evento_id);
                //Comprobar que el evento exista y si hay espacios disponibles.

                if (!isset($evento) || $evento->disponibles == "0") {
                    echo json_encode(["resultado"=>false]);
                    return;
                } else {
                    // Creo un array para nmo volver a consultar nuevamente la BD
                    $eventos_array[] = $evento;
                }
            }

         
                foreach ($eventos_array as $evento) {
                    $evento->disponibles -= 1;
                    $evento->guardar();
                    $data = [
                        "evento_id"=>(int) $evento->id,
                        "registro_id"=> (int) $registro->id

                    ];
                    $registro_usuario = new EventosRegistros($data);
                    $registro_usuario->guardar();
                
                }

                // Almacenar el regalo
                $registro->sincronizar(['regalo_id'=>$_POST["regalo_id"]]);
                $resultado = $registro->guardar();
                if($resultado){
                    echo json_encode(["resultado" => $resultado, "token"=>$registro->token]);
             
                }else{
                    echo json_encode(["resultado"=>false]);
               
                }
                return;
           
            }
         
        

        $regalos  = Regalo::all("ASC");
        $router->render('registro/conferencias', [
            "titulo" => " Elige Workshops y Conferencias",
            "eventos" => $eventos_formateados,
            'regalos' => $regalos

        ]);
    }
}

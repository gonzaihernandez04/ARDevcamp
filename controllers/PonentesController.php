<?php
namespace Controllers;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController{
    public static function index(Router $router){
        $ponentes = Ponente::all();

        $router->render('admin/ponentes/index',[
            'titulo'=> 'Ponentes',
            'ponentes'=>$ponentes
        ]);
    }


    public static function crear(Router $router){
        $alertas = [];
        $ponente = new Ponente;

       if($_SERVER['REQUEST_METHOD'] === "POST"){
      
            // Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpetaImagenes = '../public/img/speakers';
                // Crear la carpeta si no existe

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes,0777,true);
                }
             

                // Convertir imagen a png y webp
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);


                // Establecer nombre para la imagen
                 $nombre_imagen = md5(uniqid(rand(),true));

                  // Guardar las imagenes

                  $imagen_png->save($carpetaImagenes . '/' . $nombre_imagen . '.png');
                  $imagen_webp->save($carpetaImagenes . '/' . $nombre_imagen . '.webp');

                  $_POST['imagen'] = $nombre_imagen;

            }   

              // Guardar el registro
       
                // Deshacer arreglo
                $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);
                $ponente->sincronizar($_POST);
                $alertas = $ponente->validarCrearPonente();

                if(empty($alertas)){

                 // Guardar Ponente en BD
                 $resultado = $ponente->guardar();
                 if($resultado) header("Location: /admin/ponentes");

              }

              

               
            }

        
       
       $alertas = Ponente::getAlertas();
        $router->render('admin/ponentes/crear',[
            'titulo'=> 'Registrar ponente',
            'alertas'=> $alertas,
            'ponente'=>$ponente
        ]);
    
}
}
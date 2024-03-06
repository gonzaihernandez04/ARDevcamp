<?php

namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;
use Classes\Paginacion;

class PonentesController
{
    public static function index(Router $router)
    {
        // Obtengo el GET, que al principio es null
        $pagina_actual = $_GET['page'];
        // Valido que sea un entero, aunque no exista
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);

        // Si no existe una pagina, o el valor es menor a 1, establezco la direccion page=1;
        //La primera vez siempre sera =1 ya que esta variable $_get, no existe.
        if(!$pagina_actual || $pagina_actual<1) header("Location: /admin/ponentes?page=1");

        $total = Ponente::total();

        $registros_por_pagina = 5;
    

        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total);

        if($paginacion->total_paginas()<$pagina_actual){
            header("Location: /admin/ponentes?page=1");
        }

        
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");
        $ponentes = Ponente::paginar($registros_por_pagina,$paginacion->offset());
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes',
            'ponentes' => $ponentes,
            "paginacion"=>$paginacion->paginacion()
        ]);
    }


    public static function crear(Router $router)
    {
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");
        $alertas = [];
        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            // Leer imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpetaImagenes = '../public/img/speakers';
                // Crear la carpeta si no existe

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0777, true);
                }


                // Convertir imagen a png y webp
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);


                // Establecer nombre para la imagen
                $nombre_imagen = md5(uniqid(rand(), true));

                // Guardar las imagenes

                $imagen_png->save($carpetaImagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpetaImagenes . '/' . $nombre_imagen . '.webp');

                $_POST['imagen'] = $nombre_imagen;
            }

            // Guardar el registro

            // Deshacer arreglo
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            $alertas = $ponente->validarCrearPonente();

            if (empty($alertas)) {

                // Guardar Ponente en BD
                $resultado = $ponente->guardar();
                if ($resultado) header("Location: /admin/ponentes");
            }
        }




        $alertas = Ponente::getAlertas();
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router)
    {
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");
        $alertas = [];
        $ponente = new Ponente;
        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) header("Location: /admin/ponentes");

        //Obtener ponente a editar
        $ponente = Ponente::find($id);
        if (!$ponente) header("Location: /admin/ponentes");



        $ponente->imagen_actual = $ponente->imagen;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpetaImagenes = '../public/img/speakers';

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0777, true);
                }
                $imagenPng = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagenWebp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();
            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagenPng->save($carpetaImagenes . '/' . $nombre_imagen . '.png');
                    $imagenWebp->save($carpetaImagenes . '/' . $nombre_imagen . '.webp');
                }

                $resultado = $ponente->guardar();

                if ($resultado) header("Location: /admin/ponentes");
            }
        }



        $alertas = Ponente::getAlertas();
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente ?? null,
            "redes" => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar()
    {
        if(!isAuth()) header("Location: /login");
        if(!isAdmin()) header("Location: /auth/finalizar-registro");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = intval($_POST['id']);

            if (!$id) header("Location: /admin/ponentes");
            if (!filter_var($id, FILTER_VALIDATE_INT)) header("Location: /admin/ponentes");

            $ponente = Ponente::find($id);

            if (!isset($ponente)) header("Location: /admin/ponentes");
            $resultado = $ponente->eliminar();

            if ($resultado) header("Location: /admin/ponentes");
        }
    }
}

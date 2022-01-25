<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        
        $vendedores = Vendedor::all();

        //MUESTRA UN MENSAJE CONDICIONAL
        $resultado = $_GET['resultado'] ?? null ; /* Busca ese valor, y si no existe le asigna un null */

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }   

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            /** CREA UNA NUEVA INSTANCIA **/
            $propiedad = new Propiedad($_POST['propiedad']);
    
             /***** SUBIDA DE ARCHIVOS *****/
            //Crear Carpeta®
    
            //GENERA EL NOMBRE UNICO DE LA IMAGEN
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            //SETEAR LA IMAGEN
            // Realiza un resize a la imagen con intervention - class362
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen); //Aca le seteamos el nombre de la imagen al active record (osea el objeto en memoria identico a la tabla en la BD)
            }


            //Validar
            $errores = $propiedad->validar();
    
            if(empty($errores)){
                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                //guarda la bsae de datos
                $resultado = $propiedad->guardar();
    
            }
    
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        //Ejecutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args); //toma un arreglo

            //Validacion
            $errores = $propiedad->validar();

            // SUBIDA DE ARCHIVOS\
            //Genera el nombre unico de la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        
            // Realiza un resize a la imagen con intervention - class362
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                //esta parte estoy viendo que hace
                $propiedad->setImagen($nombreImagen);
            }

            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                // Insertar en la base de datos
                $propiedad->guardar();

            }

        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){  //El REQUEST_METHOD SE MANDA AL PRESIONAR EL BOTON ELIMINAR
        
            // Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
    
                if(valiarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
    
}
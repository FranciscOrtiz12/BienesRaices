<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router){
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Crear una nueva instancia
            $vendedor = new Vendedor( $_POST['vendedor']);
        
            // Validar que no haya campos vacios
            $errores = $vendedor->validar();
        
            //No hay errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        
        }

        $router->render('vendedores/crear',[
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);

    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        //Obtener los datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Asignar los valores
            $args = $_POST['vendedor'];
        
            //Sincronizar objeto en memoria con lo que el usuario escribió
            $vendedor->sincronizar($args);
        
            // validación
            $errores = $vendedor->validar();
            
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor,
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar Id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); //Valida si es el id es un numero

            if($id){
                // valida el tipo a eliminar
                $tipo = $_POST['tipo'];
                if(valiarTipoContenido($tipo)){ //valida si es correcto el tipo a eliminar (vendedor o propiedad)
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }

        }
    }
    
}
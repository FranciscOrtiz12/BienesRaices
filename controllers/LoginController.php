<?php

namespace Controllers;

use Intervention\Image\Gd\Commands\RotateCommand;
use MVC\Router;
use Model\Admin;

class loginController{

    public static function login(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Admin($_POST); //Se crea una nueva instancia con lo que hay en POST
            $errores = $auth->validar();

            if(empty($errores)){
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado){
                    //Verificar si el usuario existe o no (Mensaje de error)
                    $errores = Admin::getErrores();
                }else{
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado){
                        //Autenticar el usuario
                        $auth->autenticar();
                    } else {
                        // Password Incorrecto (Mensaje de Error)
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        
        header('Location: /');
    }

}
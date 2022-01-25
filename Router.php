<?php

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION['login'] ?? null; //Nos devuelve un boolean con la informacion de si el usuario esta iniciado o no -- Pero si la variable no existe, se le asigna un null 

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //Si no existe path_info asignale /
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null; //Si no existe, asignale null
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las Rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){ //in_array nos permite revisar un elemento en un arreglo
            header('Location: /');
        }


        if($fn){
            // La URL existe y hay una funcion asociadas
            call_user_func($fn, $this); //Esto nos permite llamar una funcion cuando no sabemos como se llama una funcion
        }else{
            echo('PAGINA NO ENCONTRADA 404');
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value; //key mantiene mantiene el nombre del atributo dentro del array
        }
        ob_start(); //Inicia un almacenamiento en memoria

        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //todo lo que habiamos almacenado en memoria se le asigna a la variable contenido
        include __DIR__ . "/views/layout.php";
    }
}
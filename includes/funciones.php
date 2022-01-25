<?php

define('TEMPLATES_URL', __DIR__ . '/templates');  /* __DIR__ esto toma como referencia el archivo actual para luego */
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/'); //DOCUMENT_ROOT NOS DEVUELVE LA RUTA EN LA QUE SE EJECUTA EL PROYECTO, OSEA PUBLIC

function incluirTemplate( string $nombre, bool $inicio = false ){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();
    
    if(!$_SESSION['login']){ //Si no esta autenticado
        header('Location: /');
    }
}

function debuguear($param){
    echo "<pre>";
    var_dump($param);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function sani($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido a eliminar
function valiarTipoContenido($tipo){
    $tipos = ['vendedor','propiedad'];
    return in_array($tipo , $tipos); //Esta funcion busca un string dentro de un arreglo y devuelve un bool -- EL PRIMER ARGUMENTO ES LO QUE SE BUSCARA Y EL SEGUNDO ES EN DONDE LO BUSCARA
}

//Muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;   
        case 3:
            $mensaje = 'Elimiando Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar( string $url ){
    // Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); //Validamos si el id es un numero

    if(!$id){ //Si id no es un numero nos redirige al admin
        header("location: ${url}");
    }

    return $id;
}
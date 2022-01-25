<?php

function conectarDB() : mysqli{  //Esto va a retornar una conexion de mysqli
    $db = new mysqli('','','','');

    if(!$db){ //En caso de que no se conecte
        echo "Error no se pudo conectar";
        exit; //Paramos la ejecucion del codigo
    }

    return $db;
}
<?php

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDb = ['id','nombre','apellido','telefono']; //Esto sirve para poder mapear

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        // ?? = en caso de que noe ste titulo sera un string vacio
        $this->id = $args['id'] ?? null; 
        $this->nombre = $args['nombre'] ?? ''; 
        $this->apellido = $args['apellido'] ?? ''; 
        $this->telefono = $args['telefono'] ?? ''; 

    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "El Nombre es Obligatorio";
        };

        if(!$this->apellido){
            self::$errores[] = "El Apellido es Obligatorio";
        };

        if(!$this->telefono){
            self::$errores[] = "El Teléfono es obligatorio";
        };

        if(!preg_match('/[0-9]{9}/', $this->telefono)){ //expresion regular - Busca un "patron" dentro de un texto
            self::$errores[] = "Formato Invalido";
        }


        return self::$errores;
    }
}
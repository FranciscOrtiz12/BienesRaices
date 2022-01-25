<?php

namespace Model;

use GuzzleHttp\Psr7\Query;

//La clase Propiedad hereda a la clase ActiveRecord
class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDb = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId']; //Esto sirve para poder mapear

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        // ?? = en caso de que noe ste titulo sera un string vacio
        $this->id = $args['id'] ?? null; 
        $this->titulo = $args['titulo'] ?? ''; 
        $this->precio = $args['precio'] ?? ''; 
        $this->imagen = $args['imagen'] ?? ''; 
        $this->descripcion = $args['descripcion'] ?? ''; 
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? ''; 
        $this->estacionamiento = $args['estacionamiento'] ?? ''; 
        $this->creado = date('Y/m/d'); 
        $this->vendedorId = $args['vendedorId'] ?? ''; 

    }

    public function validar(){
        if($this->titulo === ''){
            self::$errores[] = "Debes añadir un titulo";

        };

        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        };

        if( strlen( $this->descripcion < 50 ) ){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        };

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        };

        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio" ;
        };

        if(!$this->estacionamiento){
            self::$errores[] = "El número de estacionamiento es obligatorio" ;
        };

        if(!$this->vendedorId){
            self::$errores[] = "Debes ingresar la persona encargada" ;
        };

        if(!$this->imagen){ //En caso de que no exista
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        } 

        return self::$errores;
    }

}
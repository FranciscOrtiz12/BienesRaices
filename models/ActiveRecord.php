<?php

namespace Model;

class ActiveRecord{
    //Base de Datos
    protected static $db;
    //Class359
    protected static $tabla = '';
    protected static $columnasDb = []; //Esto sirve para poder mapear

    //Errores o Validacion
    protected static $errores = [];

    //Definir la conexion a la BD
    public static function setDb($database){
        self::$db = $database;
    }

    public function guardar(){
        //Si un atributo esta como null
        if (!is_null($this->id)){
            $this->actualizar();
        }else{ //Si no hay un id es porque debemos crearlo
            $this->crear();
        }

    }

    public function crear(){

        //Sanitizar la entrada de atributos
        $atributos = $this->sanitizarDatos();
        
        //join convierte todas los parametros de un arreglo en una variable. El primer dato que le pasamos es el separador que separara a cada una de las variables, y el segundo se le pasa el arreglo. (en este caso, las llaves del arreglo atributos)


        // Insertar en la base de atributos
        $query = " INSERT INTO ". static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Si tenemos un resultado
        if($resultado){
            // Redireccionamos al usuario al usuario y mostramos un mensaje de exito
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){

        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores); 
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        
        if($resultado){
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    //Eliminar un registro
    public function eliminar(){
        //ELIMINAR LA PROPIEDAD
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }

    }

    //Subida de Archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if (!is_null($this->id)){ //Si tenemso un id, significa que debemos borrar la imagen previa
            $this->borrarImagen();
        }

        if($imagen){ //si hay una imagen
            // Asignar al atributo de imagen el nombre de la imagen
            $this->imagen = $imagen;
        }
    }

    //Elimina el archivo
    public function borrarImagen(){
        // Comprobar si existe la imagen dentro del archivo o carpeta
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) { //Si existe el archivo lo eliminamos
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Atributos desde el post
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDb as $columna){ // as : En cada iteración, el valor del elemento actual se asigna a $columna
            if($columna === 'id') continue; //cuando se cumple esta codicion, el continue deja de ejecutar el codigo y fuerza al foreach a avanzar al siguiente indice 
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    
    //Sanitizar los datos del post
    public function sanitizarDatos(){ //class 359
        $atributos = $this->atributos(); //Tomamos el arreglo $atributos desde la function atributos();
        $sanitizado = [];

        foreach($atributos as $key =>$value ){ //esta forma, ademas asigna la clave del elemento actual a la variable $clave en cada iteración. REFERENCIA: //https://www.php.net/manual/es/control-structures.foreach.php
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    // Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla; //static llama al atributo $tabla, en la clase en la cual se este heredando
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    // Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; //static llama al atributo $tabla, en la clase en la cual se este heredando
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca una propiedad por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " where id = ${id}";
        $resultado = self::consultarSQL($query);

        return array_shift( $resultado ); //array shift toma el primer elemento del arreglo
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) { //mientras que haya un registro en la base de datos se hara lo siguiente y luego procedera a incrementar de valor
            $array[] = static::crearObjeto($registro); //Mandamos a crear un objeto con el $registro(es un array)
        }
        
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static; //new self crea un nuevo objeto de la clase actual

        foreach($registro as $key => $value) { //Este registro contiene un array con las llaves y valores de cada una
            if( property_exists( $objeto, $key ) ){ //Si en el objeto tiene una llave que se llame id o titulo, etc se hara lo siguiente
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
    
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value){
            /* CLASS367 */
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}
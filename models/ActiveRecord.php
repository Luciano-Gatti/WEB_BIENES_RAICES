<?php
namespace Model;
class ActiveRecord{
    //Base de Datos
    protected static $db;  
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];
 
    public function guardar(){
        if(!is_null($this-> id)){
            $this-> actualizar();
        }else{
            $this-> crear();
        }
    }
 
    public function crear(){
        $atributos = $this-> sanitizarAtributos(); 
        $query = "INSERT INTO " .static::$tabla ." (" .join(', ', array_keys($atributos)). " ) VALUES ( '" .join("', '", array_values($atributos)). " ') ";
        $resultado = self::$db->query($query);
        if($resultado){
            header('Location: /admin?resultado=1');
        }
    }
 
    public function eliminar(){
        //Eliminar la propiedad
        $query = "DELETE FROM " .static::$tabla ." WHERE id = ". self::$db->escape_string($this->id). " LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }
 
    public function actualizar(){
        $atributos = $this-> sanitizarAtributos(); 
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " .static::$tabla ." SET ".join(', ', $valores) ."WHERE id = '". self::$db->escape_string($this->id). "' LIMIT 1;";
        $resultado = self::$db->query($query);
        if($resultado){
            header('Location: /admin?resultado=2');
        }
    }
 
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
 
    public function sanitizarAtributos(){
        $atributos = $this-> atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }    
        return $sanitizado;
    }
 
    public function setImagen($imagen){
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }
 
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES. $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES. $this->imagen);
        }
    }
 
    public static function setDB($database){
        self::$db = $database;
    }
 
    public static function getErrores() {
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }
 
    public static function all(){
        $query = "SELECT * FROM ". static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function getCantPropiedades($cantidad){
        $query = "SELECT * FROM ". static::$tabla . " LIMIT ". $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
 
    public static function find($id){
        $query = "SELECT * FROM " .static::$tabla ." WHERE id = ".$id;
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
 
   public static function consultarSQL($query){
        $resultado = self::$db->query($query);         
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }
 
    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
 
    public function sincronizar($array = []){
        foreach($array as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value; 
           }
        }
    }
}
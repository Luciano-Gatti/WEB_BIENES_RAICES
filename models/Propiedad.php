<?php
namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'vendedor_id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado'];
    
    public $id;
    public $vendedor_id; 
    public $titulo; 
    public $precio;
    public $imagen; 
    public $descripcion; 
    public $habitaciones;
    public $wc; 
    public $estacionamiento; 
    public $creado; 

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null; 
        $this->vendedor_id = $args['vendedor_id'] ?? ''; 
        $this->titulo = $args['titulo'] ?? ''; 
        $this->precio = $args['precio'] ?? ''; 
        $this->imagen = $args['imagen'] ?? ''; 
        $this->descripcion = $args['descripcion'] ?? ''; 
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? ''; 
        $this->estacionamiento = $args['estacionamiento'] ?? ''; 
        $this->creado = date('Y/m/d');
    }
    
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un título";
        }
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = "Debes añadir una descripcion de al menos 50 caracteres.";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Debes ingresar la cantidad de habitaciones";
        }
        if(!$this->wc){
            self::$errores[] = "Debes ingresar la cantidad de baños";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "Debes ingresar la cantidad de estacionamientos";
        }
        if(!$this->vendedor_id){
            self::$errores[] = "Seleccione un vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }
}
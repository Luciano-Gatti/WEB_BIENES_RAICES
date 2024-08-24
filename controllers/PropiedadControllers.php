<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadControllers{

    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router-> render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $propiedad = new Propiedad($_POST['propiedad']);
    
            //Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            if($_FILES['propiedad']['tmp_name']['imagen']){
                // create new image instance (800 x 600)
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->coverDown(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            
            $errores = $propiedad->validar(); 
    
            if(empty($errores)){
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                $image->save(CARPETA_IMAGENES .$nombreImagen);
                $propiedad->guardar();
            }   
        }

        $router-> render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $array = $_POST['propiedad'];
            $propiedad-> sincronizar($array);
            $errores = $propiedad->validar(); 
            
            if($_FILES['propiedad']['tmp_name']['imagen']){
                // create new image instance (800 x 600)
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->coverDown(800, 600);
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $propiedad->setImagen($nombreImagen);
            }
    
            if(empty($errores)){
                if(isset($image)){
                    $image->save(CARPETA_IMAGENES .$nombreImagen);
                }
                $propiedad->guardar();
            }   
        }

        $router-> render('propiedades/actualizar', [
            'id' => $id,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                if(validarTipo($_POST['tipo'])){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
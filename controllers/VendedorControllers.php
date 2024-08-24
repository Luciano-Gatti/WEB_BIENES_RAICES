<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorControllers{
    public static function crear(Router $router){
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor = new Vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router-> render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $array = $_POST['vendedor'];
            
            $vendedor-> sincronizar($array);
            $errores = $vendedor->validar();
    
            if(empty($errores)){
                $vendedor->guardar();
            }  
        }
        
        $router-> render('vendedores/actualizar', [
            'id' => $id,
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                if(validarTipo($_POST['tipo'])){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
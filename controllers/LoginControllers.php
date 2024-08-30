<?php
namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginControllers{
    public static function login(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST['admin']);
            $errores = $auth->validar();
            if(empty($errores)){
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado){
                        $auth->autenticar();
                    }else{
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout(Router $router){
        if(!$_SESSION){
            session_start();
        }
        $_SESSION = [];
        header('Location: /');
    }
}
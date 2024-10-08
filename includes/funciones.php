<?php
define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL', __DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL."/". $nombre . ".php";
}

function estaAutenticado() {
    if(!$_SESSION){
        session_start();
    }
    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar el HTML
function sanitizar($html){
    $s = htmlspecialchars($html);
    return $s;
}

function validarTipo($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo){
    switch($codigo){
        case 1: $mensaje = 'Creado Correctamente';
        break;
        case 2: $mensaje = 'Actualizado Correctamente';
        break;
        case 3: $mensaje = 'Eliminado Correctamente';
        break;
        default: $mensaje = false;
        break;
    }
    return $mensaje;
}

function validarORedireccionar($url){ //Validar la URL por el ID 
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: " . $url);
    }
    return $id;
}
<?php 
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

class PaginasControllers{

    public static function index(Router $router){
        $propiedades = Propiedad::getCantPropiedades(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }
    public static function anuncios(Router $router){
        $propiedades = Propiedad::all();
        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }
    public static function anuncio(Router $router){
        $id = validarORedireccionar('/anuncios');
        $propiedad = Propiedad::find($id);
        if($propiedad){
            $router->render('paginas/anuncio', [
                'propiedad' => $propiedad
            ]);
        }else{
            header('Location: /anuncios');
        }
    }
    public static function blog(Router $router){
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $phpmailer = new PHPMailer();

            //Configurar SMTP
            $phpmailer->isSMTP();
            $phpmailer->Host = EMAIL_HOST;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = EMAIL_PORT;
            $phpmailer->Username = EMAIL_USER;
            $phpmailer->Password = EMAIL_PASS;

            //Configurar el contenido del email
            $phpmailer->setFrom('admin@bienesraices.com');
            $phpmailer->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $phpmailer->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';  
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p>Nombre: '. $respuestas['nombre'].'</p>';
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p> Eligio ser contactado por Teléfono: </p>';
                $contenido .= '<p>Telefono: '. $respuestas['telefono'].'</p>';
                $contenido .= '<p>Fecha Contacto: '. $respuestas['fecha'].'</p>';
                $contenido .= '<p>Hora: '. $respuestas['hora'].'</p>';
            }else{
                $contenido .= '<p> Eligio ser contactado por Email: </p>';
                $contenido .= '<p>Email: '. $respuestas['email'].'</p>';
            }
            $contenido .= '<p>Mensaje: '. $respuestas['mensaje'].'</p>';
            $contenido .= '<p>Vende o Compra: '. $respuestas['tipo'].'</p>';
            $contenido .= '<p>Precio o Presupuesto: $'. $respuestas['precio'].'</p>';
            $contenido .= '</html>';

            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email
            if($phpmailer->send()){
                $mensaje = "Mensaje enviado correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar";
            }
        }
        
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}
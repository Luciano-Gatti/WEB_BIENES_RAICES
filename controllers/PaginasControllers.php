<?php 
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
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

            // Crear el transporte para Gmail
            // Asegúrate de codificar la contraseña y otros valores si es necesario
            $emailUser = $_ENV['EMAIL_USER'];
            $emailPass = $_ENV['EMAIL_PASS']; 
            $emailSmtp = $_ENV['EMAIL_SMTP'];
            $emailPort = $_ENV['EMAIL_PORT'];

            // Construcción del DSN
            $dsn = sprintf('smtp://%s:%s@%s:%s', $emailUser, $emailPass, $emailSmtp, $emailPort);

            // Crear el transporte de correo
            $transport = Transport::fromDsn($dsn);

            // Crear el Mailer usando el transporte
            $mailer = new Mailer($transport);

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

            // Crear el mensaje
            $email = (new Email())
            ->from($_ENV['EMAIL_USER']) // Cambia esto a tu dirección de correo
            ->to($_ENV['EMAIL_USER'])
            ->subject('Contacto Propiedad')
            ->html($contenido);

            $mailer->send($email);
        }
        
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}
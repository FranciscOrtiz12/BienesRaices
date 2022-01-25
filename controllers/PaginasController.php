<?php

namespace Controllers;

use GuzzleHttp\Psr7\Response;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index( Router $router ){
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades

        ]);
    }

    public static function propiedad(Router $router){

        $id = validarORedireccionar('/propiedades'); //Esta funcion nos esta tomando el id con un get - EL PARAMETRO QUE LE PASAMOS INDICA A DONDE NOS REDIRIJIRA SI ESTE NO ES VALIDO
        //Buscar la propiedad por su ID
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada', []);
    }

    public static function contacto( Router $router ){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            
            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            
            //Configurar SMTP(Se utiliza para el envio de Mails)
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '176884d80af054';
            $mail->Password = '342a04ca71db54';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com'); //Quienes lo envian
            $mail->addAddress('Thyaretekieromusho@gmail.com', 'BienesRaices.com'); //a quienes se le envia
            $mail->Subject = 'Primera vez que mando un Mail :3'; //El titulo o asunto

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: '. $respuestas['nombre'] . ' </p>';

            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){

                $contenido .= '<p> Eligió ser contactado por Telefono </p>';
                $contenido .= '<p>Telefono: '. $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha: '. $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: '. $respuestas['hora'] . ' </p>';
            
            }else{
                //Es email, entonces agregamos el campo de email
                $contenido .= '<p> Eligió ser contactado por email </p>';
                $contenido .= '<p>Email: '. $respuestas['email'] . ' </p>';
            }

            $contenido .= '<p>Mensaje: '. $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Tipo: '. $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $'. $respuestas['precio'] . ' </p>';
            $contenido .= '<p>Contactado Por: '. $respuestas['contacto'] . ' </p>';
            $contenido .= '</html>';
            
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            //Enviar el Email
            if($mail->send()) {
                $mensaje = "Mail Enviado Correctamente";
            }else{
                $mensaje = "El mensaje no se envio pa";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
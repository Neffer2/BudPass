<?php 

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait Mail 
{
    public function welcome($user){   
        $subject = "¡Celebramos tu grandeza, bienvenido a Budpass!";
        $content = [
            'view' => 'mail.main',
            'title' => "<h1>¡REGISTRO EXITOSO! Sube tus facturas y gana boletas al FEP y más.</h1>",
            'body' => "<p>
                <h2>¡Hola {$user->name}!</h2><br>
                Ya estás registrado, ahora acumula puntos con tus compras de Budweiser para redimirlos por entradas, transporte y mucho más.
            </p>"
        ];
        $altBody = "¡REGISTRO EXITOSO! Sube tus facturas y gana boletas al FEP y más!"; 

        $this->sendMail($subject, $content, $altBody, $user);
    } 
 
    public function validated($regsitro, $estado){
        
        if ($estado){
            $subject = "¡Budweiser te informa! ¡Tus puntos se registraron con éxito!";
            $content = [
                'view' => 'mail.main',
                'title' => "<h1>¡Tus puntos han sido acumulados!</h1>",
                'body' => "<p>
                    <h2>¡Hola {$regsitro->shopper->name}!<br></h2>
                    Acabas de acumular puntos, continua acumulando por el Ranking por las entradas para el FEP2024. fila rápida, transporte o redimelos por muchos más.
                </p>"    
            ];
            $altBody = "Registro de Factura Validado, haz ganado {$regsitro->puntos_sumados} puntos en el canal {$regsitro->canal->descripcion}."; 
        }else {
            $subject = "¡Ups, tu factura fue rechazada!";
            $content = [
                'view' => 'mail.main',
                'title' => "h1>¡Lo sentimos! tu factura no es valida.</h1>",
                'body' => "<p> Por favor toma una foto legible y aplicable de acuerdo a los términos y condiciones y vuelve a cargarla para acumular tus puntos.</p>"
            ]; 
            $altBody = "Registro de Factura Validado."; 
        }

        $this->sendMail($subject, $content, $altBody, $regsitro->shopper);
    }

    public function redencion($premio, $user){
        $subject = "¡Felicidades por tu logro! ¡Disfruta tu premio Budweiser!";
        $content = [
            'view' => 'mail.main',
            'title' => "<h1>¡Redención exitosa!</h1>",
            'body' => "<p>
                <h2>¡Felicitaciones {$user->name}!</h2><br>
                Redimiste tus puntos, muy pronto recibirás tu beneficio. En caso de ser físico el tiempo de entrega dependerá de tu ubicación, si es una entrada o un beneficio digital, muy pronto llegará a tu correo.
            </p>"    
        ];
        $altBody = "Premio redimido con éxito."; 

        $this->sendMail($subject, $content, $altBody, $user);
    }

    public function sendMail($subject, $content, $altBody, $user)
    { 
        require base_path("vendor/autoload.php");
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = env('MAIL_PORT', 465);

            //Recipients
            $mail->setFrom(env('MAIL_USERNAME'), env('MAIL_USERNAME')); 

            $mail->addAddress($user->email, $user->name);
            $mail->addReplyTo('noreply@noreply.com', 'noreply');

            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';
 
            //Content 
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            // $body
            $mail->Body    = view($content['view'], $content);
            $mail->AltBody = $altBody;

            $mail->send();
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Error: {$mail->ErrorInfo}");
        }
    }
} 
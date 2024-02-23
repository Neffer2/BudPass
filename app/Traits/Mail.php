<?php 

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait Mail 
{
    public function welcome($user){   
        $subject = "Bienvenido";
        $content = [
            'view' => 'mail.main',
            'body' => "Hola {$user->name}, Esta es mi canción de bienvenida. Soy un correo electrónico. Necesito Copies y Diseño :("
        ];
        $altBody = "Esta es mi canción de bienvenida"; 

        $this->sendMail($subject, $content, $altBody, $user);
    } 

    public function validated($regsitro, $estado){
        $subject = "Registro de Factura Validado";        

        if ($estado){
            $content = [
                'view' => 'mail.main',
                'body' => "Hola {$regsitro->shopper->name}, tu factura ha sido validada. Has ganado {$regsitro->puntos_sumados} puntos en el canal {$regsitro->canal->descripcion}."
            ]; 
            $altBody = "Registro de Factura Validado, haz ganado {$regsitro->puntos_sumados} puntos en el canal {$regsitro->canal->descripcion}."; 
        }else {
            $content = [
                'view' => 'mail.main',
                'body' => "Hola {$regsitro->shopper->name}, tu factura ha sido rechazada."
            ]; 
            $altBody = "Registro de Factura Validado."; 
        }

        $this->sendMail($subject, $content, $altBody, $regsitro->shopper);
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
            $mail->Port       = env('MAIL_PORT', 587);

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
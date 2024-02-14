<?php 

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait Mail
{
    public function welcome(){
        $subject = "Bienvenido";
        $body = "Esta es mi canción de bienvenida";
        $altBody = "Esta es mi canción de bienvenida";
    }

    public function sendMail($subject, $body, $altBody)
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
            $mail->setFrom(env('MAIL_USERNAME'), 'BullMarketing'); 

            $mail->addAddress('neffer.barragan@bullmarketing.com.co', 'Neffer Barragan');
            $mail->addReplyTo('noreply@noreply.com', 'noreply');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} 
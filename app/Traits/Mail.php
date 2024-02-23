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
            'title' => "Budweiser transforma tus compras en momentos inolvidables. ¡Registra y redime tus premios ahora!",
            'body' => "<p>
                ¡Bienvenido {$user->name}!<br>
                Budweiser premia tu lealtad con experiencias únicas y grandes premios.<br>
                ¡Empieza a registrar tus facturas y participa ahora por excelentes recompensas!<br>
                <strong>Premios Exclusivos:</strong><br>
                Mercancia oficial de Budweiser hasta experiencias VIP, tenemos premios que te harán sentir la grandeza en cada detalle.<br>
                <strong>Experiencias Inolvidables:</strong><br>
                Con el ranking de premios vive momentos únicos que solo Budweiser puede ofrecerte.<br>
                No pierdas la oportunidad de ser parte de esta experiencia única. Registra tus facturas ahora. ¡Los premios te están esperando!<br>
                <a href='https://www.budpass.co/'>Haz clic aquí para empezar</a><br>
                ¡Celebremos juntos la grandeza con Budweiser!<br>
                Equipo Budweiser<br>
                P.S.: Recuerda, la grandeza está al alcance de tu mano. Registra tus facturas y prepárate para ganar grandes premios con Budweiser.
            </p>"
        ];
        $altBody = "Esta es mi canción de bienvenida"; 

        $this->sendMail($subject, $content, $altBody, $user);
    } 
 
    public function validated($regsitro, $estado){
        
        if ($estado){
            $subject = "¡Budweiser te informa! ¡Tus puntos se registraron con éxito!";
            $content = [
                'view' => 'mail.main',
                'title' => "¡Felicidades! Tus puntos Budweiser han sido registrados con éxito. ¡Descúbrelos ahora!",
                'body' => "<p>
                    ¡Hola {$regsitro->shopper->name}!<br>
                    Nos alegra saludarte de nuevo<br>
                    En Budweiser, reconocemos y celebramos la grandeza en cada uno de nuestros seguidores. Es por eso por lo que estamos emocionados de informarte que tu registro de puntos ha sido exitoso.<br>
                    Ahora, es momento de que disfrutes de todas las recompensas que te mereces.<br>
                    Por tu compra en {$regsitro->canal->descripcion}<br>
                    Acumulaste {$regsitro->puntos_sumados} puntos.<br>
                    Tu nos inspiras a ofrecerte experiencias únicas y premios exclusivos que reflejen la grandeza que compartimos.<br>
                    ¡Sigue acumulando puntos con cada compra y descubre todo lo que Budweiser tiene para ti!<br>
                    No pierdas más tiempo y comienza a disfrutar de tus beneficios como miembro de nuestra familia Budweiser.<br>
                    ¡Registra el resto de tus puntos hoy mismo y descubre la grandeza que te espera!<br>
                    Haz clic <a href='https://www.budpass.co/'>aquí</a> para empezar:<br>
                    ¡Celebremos juntos la grandeza con Budweiser!<br>
                    Equipo Budweiser<br>
                    P.S.: Recuerda, la grandeza está al alcance de tu mano. Registra tus facturas y prepárate para ganar grandes premios con Budweiser.
                </p>"    
            ];
            $altBody = "Registro de Factura Validado, haz ganado {$regsitro->puntos_sumados} puntos en el canal {$regsitro->canal->descripcion}."; 
        }else {
            $subject = "¡Ups, tu factura fue rechazada!";
            $content = [
                'view' => 'mail.main',
                'title' => "No pierdas tu grandeza, en Budweiser creemos en las segundas oportunidades",
                'body' => "<p>
                    ¡{$regsitro->shopper->name}, no te preocupes!<br>
                    En Budweiser recompensamos tu lealtad y queremos que redimas tus premios.<br>
                    Registra nuevamente tu factura y ten presente la siguiente información:<br>
                    1. Revisa que los datos que ingresaste en la plataforma coincidan con la factura.<br>
                    2. Que la fotografía que cargaste sea legible<br>
                    3. Que tu factura no se encuentre registrada en la DIAN<br>
                    Haz clic <a href='https://www.budpass.co/'>aquí</a> para realizar tu registro nuevamente<br>
                    ¡Celebremos juntos la grandeza con Budweiser!<br>
                    Equipo Budweiser<br>
                    P.S.: Recuerda, la grandeza está al alcance de tu mano. Registra tus facturas y prepárate para ganar grandes premios con Budweiser.
                </p>"
            ]; 
            $altBody = "Registro de Factura Validado."; 
        }

        $this->sendMail($subject, $content, $altBody, $regsitro->shopper);
    }

    public function redencion($premio, $user){
        $subject = "¡Felicidades por tu logro! ¡Disfruta tu premio Budweiser!";
        $content = [
            'view' => 'mail.main',
            'title' => "¡Felicidades! Tus puntos Budweiser han sido registrados con éxito. ¡Descúbrelos ahora!",
            'body' => "<p>
                ¡Felicitaciones {$user->name}!<br>
                Es un honor para nosotros formar parte de tu grandeza y recompensar tu lealtad con experiencias únicas.<br>
                ¡El premio que has seleccionado es {$premio->nombre}!<br>
                Tu dedicación y preferencia por Budweiser nos inspiran a seguir brindándote momentos extraordinarios. Queremos que disfrutes al máximo tu premio y que continúes celebrando la grandeza en cada sorbo de nuestras cervezas.<br>
                No olvides que tú eres nuestra inspiración y nos impulsa a seguir ofreciéndote lo mejor.<br>
                ¡Felicidades nuevamente por tu premio y gracias por ser parte de la familia Budweiser!<br>
                ¡Celebremos juntos tu grandeza!<br>
                Equipo Budweiser<br>
                P.S.: Recuerda, la grandeza está al alcance de tu mano.<br>
                <em>*Te llamaremos al número registrado, recuerda que realizaremos máximo tres intentos de contacto*</em>
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
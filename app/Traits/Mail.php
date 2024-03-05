<?php 

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait Mail 
{
    public function welcome($user){
        // $subject = "¡Celebramos tu grandeza, bienvenido a Budpass!";
        // $content = [
        //     'view' => 'mail.main',
        //     'title' => "<h1>¡REGISTRO EXITOSO! Sube tus facturas y gana boletas al FEP y más.</h1>",
        //     'body' => "<p>
        //         <h2>¡Hola {$user->name}!</h2><br>
        //         Ya estás registrado, ahora acumula puntos con tus compras de Budweiser para redimirlos por entradas, transporte y mucho más.
        //     </p>"
        // ];
        // $altBody = "¡REGISTRO EXITOSO! Sube tus facturas y gana boletas al FEP y más!";          
        
        // $this->sendMail($subject, $content, $altBody, $user);
        $this->sendMail("6e09d9b1-96ee-41b9-a373-e81dbc317860", $user, ['recuperacion_contrasena' => 'https://budpass.co/']);             
    } 
 
    public function validated($regsitro, $estado){        
        if ($estado){
            // $subject = "¡Budweiser te informa! ¡Tus puntos se registraron con éxito!";
            // $content = [
            //     'view' => 'mail.main',
            //     'title' => "<h1>¡Tus puntos han sido acumulados!</h1>",
            //     'body' => "<p>
            //         <h2>¡Hola {$regsitro->shopper->name}!<br></h2>
            //         Acabas de acumular puntos, continua acumulando por el Ranking por las entradas para el FEP2024. fila rápida, transporte o redimelos por muchos más.
            //     </p>"    
            // ];
            // $altBody = "Registro de Factura Validado, haz ganado {$regsitro->puntos_sumados} puntos en el canal {$regsitro->canal->descripcion}."; 
            $this->sendMail("8978cb08-c23a-44cc-b8cc-b7475927000c", $regsitro->shopper);
        }else {
            // $subject = "¡Ups, tu factura fue rechazada!";
            // $content = [
            //     'view' => 'mail.main',
            //     'title' => "h1>¡Lo sentimos! tu factura no es valida.</h1>",
            //     'body' => "<p> Por favor toma una foto legible y aplicable de acuerdo a los términos y condiciones y vuelve a cargarla para acumular tus puntos.</p>"
            // ]; 
            // $altBody = "Registro de Factura Validado."; 
        }
    }

    public function redencion($premio, $user){
        // $subject = "¡Felicidades por tu logro! ¡Disfruta tu premio Budweiser!";
        // $content = [
        //     'view' => 'mail.main',
        //     'title' => "<h1>¡Redención exitosa!</h1>",
        //     'body' => "<p>
        //         <h2>¡Felicitaciones {$user->name}!</h2><br>
        //         Redimiste tus puntos, muy pronto recibirás tu beneficio. En caso de ser físico el tiempo de entrega dependerá de tu ubicación, si es una entrada o un beneficio digital, muy pronto llegará a tu correo.
        //     </p>"    
        // ];
        // $altBody = "Premio redimido con éxito."; 

        // $this->sendMail($subject, $content, $altBody, $user);

        // $data = [
        //     "campaign_id" => "3043cd89-df63-45d8-9e38-73b986e3007e",
        //     "recipients" => [
        //         [
        //             "external_user_id" =>"nati_test_user",
        //             "trigger_properties" => [],
        //             "send_to_existing_only" => false,
        //             "attributes" => [
        //                 "first_name" => "{{ $user->name }}",
        //                 "email" => "{{ $user->email }}"
        //             ]
        //         ]
        //     ],
        //     "broadcast" => false
        // ];
        $this->sendMail("3043cd89-df63-45d8-9e38-73b986e3007e", $user);
    }

    public function contraseña_recuperada($user){ 
        $this->sendMail("5d3b5e54-faad-4b89-a96a-4cd48fb770d0", $user);
    }

    // public function sendMail($subject, $content, $altBody, $user)
    // { 
    //     require base_path("vendor/autoload.php");
    //     //Create an instance; passing `true` enables exceptions
    //     $mail = new PHPMailer(true);

    //     try {
    //         //Server settings
    //         // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //         $mail->isSMTP();
    //         $mail->Host       = config('mail.mailers.smtp.host');
    //         $mail->SMTPAuth   = true;
    //         $mail->Username   = config('mail.mailers.smtp.username');
    //         $mail->Password   = config('mail.mailers.smtp.password');
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //         $mail->Port       = config('mail.mailers.smtp.port');

    //         //Recipients
    //         $mail->setFrom(config('mail.from.address'), config('mail.from.name')); 

    //         $mail->addAddress($user->email, $user->name);
    //         $mail->addReplyTo('noreply@noreply.com', 'noreply');

    //         // Activo condificacción utf-8
    //         $mail->CharSet = 'UTF-8';
 
    //         //Content
    //         $mail->isHTML(true);                                  //Set email format to HTML
    //         $mail->Subject = $subject;
    //         // $body
    //         $mail->Body    = view($content['view'], $content);
    //         $mail->AltBody = $altBody;

    //         $mail->send();
    //     } catch (Exception $e) {
    //         return redirect()->back()->withErrors("Error: {$mail->ErrorInfo}");
    //     }
    // }

    public function sendMail($camapin_id, $user, $properties = null){
        $url = 'https://rest.iad-05.braze.com/campaigns/trigger/send';
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer 6b30b900-36c2-4b05-a7d1-a8e19468918b',
        ];

        $data = [
            "campaign_id" => $camapin_id,
            "recipients" => [
                [
                    "external_user_id" =>"nati_test_user",
                    "trigger_properties" => $properties,
                    "send_to_existing_only" => false,
                    "attributes" => [
                        "first_name" => $user->name,
                        "email" => $user->email
                    ]
                ]
            ],
            "broadcast" => false
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;    
    }
} 
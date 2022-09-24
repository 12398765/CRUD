<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/Exception.php';
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';

$email = $_POST["email"];
$code = $_POST["code"];

$mail = new PHPMailer(true);

try {
    //Server settings
    //Se debe activar esta casilla del lado de gmail: https://www.google.com/settings/security/lesssecureapps
    //$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    // $mail->SMTPSecure = 'tls';
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('', 'Itzco');   //Desde dónde se envía el correo

    //Content
    $contenido = "
    <div style='display:flex;
    justify-content: center;
    align-items:center;
    width: 100%;
    height: 200px;
    background-color: #222;'>
        <img src='cid:imagen' style='height: 180px; margin:auto; border-radius: 15px' alt='logo'>
    </div>
    <div style='color: black; background-color:white'>
    <h3 style='color:red; text-align:center'>Confirmar cuenta</h3>
    Estimado Usuario <br>
    Agradezco su interes en visitar mi website. <br>
    <b>Su código de verificación es: </b>${code} <br>
    Recuerde no compartir su codigo de verificacion con nadie mas, ya que podrias perder tu cuenta.<br><br>
    Sin más por el momento, tenga un excelente dia.
    </div>
    ";

    $mail->AddEmbeddedImage('account.png', 'imagen');
    $mail->addAddress($email);                    //a quien se le envía al correo
    $mail->isHTML(true);
    $mail->Subject = 'Codigo de verificacion';
    $mail->Body = $contenido;

    $mail->send();
    echo 'ok';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

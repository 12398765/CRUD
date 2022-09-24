<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/Exception.php';
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';

$email = $_POST["email"];
$code = $_POST["code"];

$mail = new PHPMailer(true);


include("../procesosPhP/conexion.php");
$checkEmail = 0;
$query = $pdo->prepare("SELECT * FROM users");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $r) {
    if ($email == $r["email"]) {
        $checkEmail = 1;
    }
}
if ($checkEmail == 0) {
    echo "el email no se encuentra en la BD";
} else {
    $update = $pdo->prepare("UPDATE users set pass = :pass WHERE email= :email");
    $update->bindParam(":pass", $code);
    $update->bindParam(":email", $email);
    $update->execute();

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
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
    <h3 style='color:red; text-align:center'>Contraseña Actualizada</h3>
    Estimado Usuario <br>
    Agradezco su interes en visitar mi website. <br>
    <b>Su nueva contraseña es: </b>${code} <br>
    Recuerde no compartir su contraseña con nadie mas, ya que podrias perder tu cuenta.<br>
    Por favor, no responda a este correo.<br>
    Si desea contactarme, envíe un email a ix.obsid@gmail.com<br><br>
    Sin más por el momento, tenga un excelente dia.
    </div>
    ";

        $mail->AddEmbeddedImage('account.png', 'imagen');
        $mail->addAddress($email);                    //a quien se le envía al correo
        $mail->isHTML(true);
        $mail->Subject = 'Contrasenia Actualizada';
        $mail->Body = $contenido;

        $mail->send();
        echo 'ok';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

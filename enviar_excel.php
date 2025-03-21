<?php
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'barbosajesus505@gmail.com'; // Tu correo
    $mail->Password = 'qvwk ucnk xlji qfjn'; // "Contraseñas de Aplicaciones" en Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('barbosajesus505@gmail.com', 'Formulario Landing Page');
    $mail->addAddress('soycomunitymanager@gmail.com'); //  Correo del administrador
    $mail->Subject = 'Nuevo registro en la Landing Page';
    $mail->Body = 'Se ha recibido un nuevo mensaje. Se adjunta el archivo Excel con los datos.';
    $mail->addAttachment('clientes.xlsx'); //  Adjuntar el archivo Excel

    $mail->send();
    echo "Excel enviado correctamente al administrador.";
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>

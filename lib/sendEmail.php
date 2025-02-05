<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

// Carregar as variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendEmail($destinatario, $assunto, $mensagemHTML)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->Port = $_ENV['MAIL_PORT'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = $_ENV['MAIL_SMTPSECURE'];
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagemHTML;
    
    if ($mail->send()) {
        echo "Email enviado com sucesso";
    } else {
        echo "Falha ao enviar! " . $mail->ErrorInfo;
    }
}
?>

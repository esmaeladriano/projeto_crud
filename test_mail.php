<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclua o autoloader do Composer
$mail = new PHPMailer(true); // Cria uma nova instância do PHPMailer

try {
    // Configurações do servidor
    $mail->isSMTP(); // Define que será usado o SMTP
    $mail->Host = 'smtp.gmail.com'; // Especifique o servidor de envio
    $mail->SMTPAuth = true; // Habilita a autenticação SMTP
    $mail->Username = 'esmadriano2023@gmail.com'; // Seu e-mail
    $mail->Password = 'vydi nclc bkjx dkbt'; // Sua senha de aplicativo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ativa a criptografia TLS
    $mail->Port = 587; // Porta TCP para conexão

    // Destinatários
    $mail->setFrom('esmadriano2023@gmail.com', 'Esmael Adriano'); // De onde vem o e-mail
    $mail->addAddress('esmadriano2023@gmail.com', 'Ola USNA'); // Para quem vai o e-mail

    // Conteúdo do e-mail
    $mail->isHTML(true); // Define o formato do e-mail como HTML
    $mail->Subject = 'Teste de envio de e-mail com PHPMailer';
    $mail->Body = 'Este é um teste de envio de e-mail com <b>PHPMailer</b>';
    $mail->AltBody = 'Este é um teste de envio de e-mail com PHPMailer em texto simples';

    // Envia o e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "E-mail não pode ser enviado. Erro: {$mail->ErrorInfo}";
}

<?php

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Verifique se o autoload está correto

function enviarEmailConfirmacao($email, $token)
{
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Endereço do servidor SMTP
        $mail->SMTPAuth   = true; // Ativar autenticação SMTP
        $mail->Username   =  'esmadriano2023@gmail.com'; // Seu e-mail'
        $mail->Password   = 'vydi nclc bkjx dkbt'; // Sua senha de aplicativo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ativar criptografia TLS
        $mail->Port       = 587; // Porta TCP para TLS

        // Remetente e destinatário
        $mail->setFrom('seu_email@gmail.com', 'Seu Nome');
        $mail->addAddress($email); // Adiciona um destinatário

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Confirmação de Cadastro';
        $mail->Body    = 'Clique no link para confirmar: <a href="http://seusite.com/confirmar.php?token=' . $token . '">Confirmar</a>';

        $mail->send();
        echo 'Mensagem enviada com sucesso.';
    } catch (Exception $e) {
        echo "Mensagem não pode ser enviada. Erro do Mailer: {$mail->ErrorInfo}";
    }
}

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // PHPMailer autoload
require_once './models/Database.php'; // Conexão com o banco de dados

// Configurações de e-mail
$meu = 'esmadriano2023@gmail.com'; // Seu e-mail
$minha = 'vydi nclc bkjx dkbt'; // Sua senha de aplicativo

// Função para enviar o e-mail de redefinição de senha
function enviarEmailRecuperacao($email, $token) {
    global $meu, $minha;

    $mail = new PHPMailer(true); // Instância do PHPMailer
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $meu;
    $mail->Password = $minha; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurações do e-mail
    $mail->setFrom($meu, 'Esmael Adriano');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Redefinição de senha';

    $link = "http://localhost/sistema/reset_password.php?token=" . $token;
    $mail->Body = "Clique no link para redefinir sua senha: <a href='$link'>Redefinir Senha</a>";

    return $mail->send();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Conexão com o banco de dados
    $db = new Database();
    $pdo = $db->connect();

    // Verifica se o e-mail existe no banco de dados
    $sql = "SELECT id FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() > 0) {
        var_dump($email. "Sim, existe");
        // Gerar token único e definir expiração (1 hora)
        $token = bin2hex(random_bytes(50));
        $token_expira = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Salvar o token no banco de dados
        $sql_token = "INSERT INTO password_resets (email, token, token_expira) VALUES (:email, :token, :token_expira)";
        $stmt_token = $pdo->prepare($sql_token);
        $stmt_token->execute([':email' => $email, ':token' => $token, ':token_expira' => $token_expira]);

        // Enviar o e-mail de recuperação de senha
        if (enviarEmailRecuperacao($email, $token)) {
            echo "Um link de redefinição de senha foi enviado para o seu e-mail.";
        } else {
            echo "Erro ao enviar e-mail de recuperação.";
        }
    } else {
        echo "Este e-mail não está registrado no sistema.";
    }
}
?>

<?php

    $meu = 'esmadriano2023@gmail.com'; // Seu e-mail
    $minha= 'vydi nclc bkjx dkbt'; // Sua senha de aplicativo
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once './models/Database.php';
    require 'vendor/autoload.php'; // Inclua o autoloader do Composer

    $mail = new PHPMailer(true); // Cria uma nova instância do PHPMailer

    // Conexão com o banco de dados
    $db = new Database();
    $pdo = $db->connect();

    // Função para enviar e-mail de confirmação
    function enviarEmailConfirmacao($email, $token) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'esmadriano2023@gmail.com';
    $mail->Password = 'vydi nclc bkjx dkbt'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('esmadriano2023@gmail.com', 'Esmael Adriano');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Confirme seu cadastro';

    $link = "http://localhost/projeto_crud/m.php?token=" . $token;
    $mail->Body = "Clique no link para confirmar seu cadastro: <a href='$link'>Confirmar Cadastro</a>";

    return $mail->send();
    }

    // Função para enviar e-mail de boas-vindas
    function enviarEmailBoasVindas($email) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'esmadriano2023@gmail.com';
        $mail->Password = 'vydi nclc bkjx dkbt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('esmadriano2023@gmail.com', 'Esmael Adriano');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Bem-vindo!';
        $mail->Body = "Seu cadastro foi confirmado com sucesso!";

        return $mail->send();
    }

    // Verifica se o formulário foi enviado
    if (isset($_POST['cadastro'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(16)); // Gera token de confirmação

        // Insere o usuário em uma tabela temporária ou em status 'pending'
        $stmt = $pdo->prepare("INSERT INTO user (nome, email, telefone, senha, status, token) 
        VALUES (:nome, :email, :telefone, :senha, 'pending', :token)");
        $stmt->execute([':nome' => $nome, ':email' => $email, ':telefone' => $telefone, ':senha' => $senha, ':token' => $token]);

        // Envia e-mail de confirmação
        if (enviarEmailConfirmacao($email, $token)) {
            echo "Cadastro realizado com sucesso! Verifique seu e-mail para confirmar.";
        } else {
            echo "Erro ao enviar e-mail de confirmação.";
        }
    }

// Verifica se o token foi enviado
    if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica o token no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM user WHERE token = :token AND status = 'pending'");
    $stmt->execute([':token' => $token]);

    if ($stmt->rowCount() > 0) {
        // Atualiza o status do usuário para 'confirmed'
        $stmt = $pdo->prepare("UPDATE user SET status = 'confirmed', token = NULL WHERE token = :token");
        $stmt->execute([':token' => $token]);

        // Envia e-mail de boas-vindas
        $user = $stmt->fetch();
        enviarEmailBoasVindas($user['email']);

        echo "Cadastro confirmado com sucesso!";
    } else {
        echo "Token inválido ou usuário já confirmado.";
    }
    }


?>

<!-- Formulário de Cadastro -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit" name="cadastro">Cadastrar</button>
        <a href="./esqueciSenha.php" target="_blank" rel="noopener noreferrer"> Esqueci senha</a>
    </form>
</body>
</html>

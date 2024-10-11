<?php
if (isset($_POST['submit']) && !empty($_POST['codigo']) && !empty($_POST['senha'])) {
    include_once('C:\xampp\htdocs\sistema\conexao.php');
    $S = md5($_POST['senha']);
    $codigo = $conexao->real_escape_string($_POST['codigo']);
    $senha = $conexao->real_escape_string($S);

    // Função para verificar login e retornar usuário
    function verificarUsuario($conexao, $sql) {
        $resultado = mysqli_query($conexao, $sql);
        return mysqli_num_rows($resultado) ? $resultado->fetch_assoc() : false;
    }

    // SQLs para os diferentes tipos de usuários
    $queries = [
        'aluno' => "SELECT u.id_aluno as aluno, u.tipo as tipo, u.id as id, u.login as login, u.senha as senha 
                    FROM `usuario` u 
                    JOIN aluno a on a.id = u.id_aluno 
                    WHERE u.login = '$codigo' AND u.senha = '$senha';",
        'prof' => "SELECT u.id_prof as prof, u.tipo as tipo, u.id as id, u.login as login, u.senha as senha 
                   FROM `usuario` u 
                   JOIN professores p on p.ID = u.id_prof 
                   WHERE u.login = '$codigo' AND u.senha = '$senha';",
        'adimin' => "SELECT u.id_adimin as adim, u.tipo as tipo, u.id as id, u.login as login, u.senha as senha 
                     FROM `usuario` u 
                     JOIN adimin ad on ad.id = u.id_adimin 
                     WHERE u.login = '$codigo' AND u.senha = '$senha';",
        'secretaria' => "SELECT u.id_secretaria as id_secretaria, u.tipo as tipo, u.id as id, u.login as login, u.senha as senha 
                         FROM `usuario` u 
                         JOIN secretaria secre on secre.id = u.id_secretaria 
                         WHERE u.login = '$codigo' AND u.senha = '$senha';"
    ];

    // Verifica o tipo de usuário
    $usuario = null;
    $tipoUsuario = null;

    foreach ($queries as $tipo => $sql) {
        $usuario = verificarUsuario($conexao, $sql);
        if ($usuario) {
            $tipoUsuario = $tipo;
            break;
        }
    }

    // Verifica se encontrou algum usuário
    if ($usuario) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = $usuario['id'];
        $_SESSION['tipo'] = $usuario['tipo'];

        // Direciona de acordo com o tipo de usuário
        switch ($tipoUsuario) {
            case 'aluno':
                $_SESSION['aluno'] = $usuario['aluno'];
                header("Location:http://localhost/sistema/painel/aluno");
                break;
            case 'prof':
                $_SESSION['prof'] = $usuario['prof'];
                header("Location:http://localhost/sistema/painel/professor");
                break;
            case 'adimin':
                $_SESSION['adimin'] = $usuario['adim'];
                header("Location:http://localhost/sistema/painel/adim");
                break;
            case 'secretaria':
                $_SESSION['secretaria'] = $usuario['id_secretaria'];
                header("Location:http://localhost/sistema/painel/secretaria");
                break;
        }
    } else {
        header("Location:http://localhost/sistema/Login/index.php?error");
    }
} else {
    header("Location:http://localhost/sistema/Login/index.php");
}
?>

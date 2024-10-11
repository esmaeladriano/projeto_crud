<?php
if (!isset($_SESSION)) {
    session_start();
}

// Função para validar o tipo de usuário e a sessão
function validarUsuario($tipoEsperado, $redirect) {
    if (!isset($_SESSION['user']) || $_SESSION['tipo'] != $tipoEsperado) {
        session_destroy();
        header("Location:http://localhost/sistema/LOgin/index.php?error");
        exit();
    }
}

// Verificação de tipo de usuário
function verificarAcesso($tipo) {
    switch ($tipo) {
        case 1:
            return isset($_SESSION['adimin']) ? $_SESSION['adimin'] : null;
        case 2:
            return isset($_SESSION['secretaria']) ? $_SESSION['secretaria'] : null;
        case 3:
            return isset($_SESSION['prof']) ? $_SESSION['prof'] : null;
        case 4:
            return isset($_SESSION['aluno']) ? $_SESSION['aluno'] : null;
        default:
            return null;
    }
}

// Chamadas para os diferentes tipos de usuário
$tipo = $_SESSION['tipo'];

switch ($tipo) {
    case 1: // Administrador
        validarUsuario(1, 'adimin');
        $id_adimin = verificarAcesso(1);
        break;
    case 2: // Secretaria
        validarUsuario(2, 'secretaria');
        $id_secretaria = verificarAcesso(2);
        break;
    case 3: // Professor
        validarUsuario(3, 'prof');
        $id_prof = verificarAcesso(3);
        break;
    case 4: // Aluno
        validarUsuario(4, 'aluno');
        $id_aluno = verificarAcesso(4);
        break;
    default:
        session_destroy();
        header("Location:http://localhost/sistema/LOgin/index.php");
        exit();
}
?>


<?php
include_once('C:\xampp\htdocs\sistema\conexao.php');

// Função para enviar resposta JSON
function sendResponse($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit; // Finaliza a execução do script após enviar a resposta
}

if (isset($_POST['action']) && $_POST['action'] === 'submit') {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $nomeP = $_POST['nomeP'];
    $nomeM = $_POST['nomeM'];
    $muni = $_POST['municipio'];
    $sexo = $_POST['sexo'];
    $BI = $_POST['BI'];
    $estado = $_POST['estadocivil'];
    $email = $_POST['email'];
    $nfone_aluno = $_POST['nfaluno'];
    $nume1 = $_POST['nf2'];
    $nume2 = $_POST['nf3'];
    $classe = $_POST['classe'];
    $curso = $_POST['curso'];
    $certificado = $_FILES['certificado'];
    $copia_BI = $_FILES['CoBI'];

    // Verifica se o email já existe
    $verfique_existencia_de_email = "SELECT email FROM `candidatura` WHERE email = ?";
    $stmt = $conexao->prepare($verfique_existencia_de_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_verifique_email = $stmt->get_result();

    if ($result_verifique_email->num_rows > 0) {
        sendResponse('error', 'Email já existe no DB');
    }

    // Verifica se os arquivos foram enviados e seu tamanho
    if (empty($certificado['name']) || empty($copia_BI['name'])) {
        sendResponse('error', 'Por favor, envie os documentos necessários.');
    } elseif ($certificado['size'] > 2097152 || $copia_BI['size'] > 2097152) {
        sendResponse('error', 'Arquivos muito grandes! Max: 2MB.');
    }

    // Verifica as extensões dos arquivos
    $extensao_certificado = strtolower(pathinfo($certificado['name'], PATHINFO_EXTENSION));
    $extensao_copia_BI = strtolower(pathinfo($copia_BI['name'], PATHINFO_EXTENSION));
    
    if ($extensao_certificado != 'pdf' || $extensao_copia_BI != 'pdf') {
        sendResponse('error', 'Só é aceita a extensão PDF.');
    }

    // Move os arquivos para as pastas
    $pasta_certificado = "cerificado/";
    $pasta_copia_BI = "copiaBI/";
    $novoNome_arquivo_certificado = uniqid() . '.' . $extensao_certificado;
    $novoNome_arquivo_copia_BI = uniqid() . '.' . $extensao_copia_BI;
    $path_certificado = $pasta_certificado . $novoNome_arquivo_certificado;
    $path_copia_BI = $pasta_copia_BI . $novoNome_arquivo_copia_BI;

    if (move_uploaded_file($certificado['tmp_name'], $path_certificado) && move_uploaded_file($copia_BI['tmp_name'], $path_copia_BI)) {
        // Insere os dados no banco
        $insert = "INSERT INTO `candidatura` (`nome`, `Data_nasc`, `Nome_pai`, `Nome_mae`, `Municipio`, `Sexo`, `BI`, `Estado_civil`, `email`, `Contacto_aluno`, `Contacto_enca1`, `Contacto_enca2`, `Classe`, `Curso`, `certificado`, `copia_BI`) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($insert);
        $stmt->bind_param("ssssssssssssssss", $nome, $data, $nomeP, $nomeM, $muni, $sexo, $BI, $estado, $email, $nfone_aluno, $nume1, $nume2, $classe, $curso, $path_certificado, $path_copia_BI);
        
        if ($stmt->execute()) {
            sendResponse('success', 'Inscrição realizada com sucesso.');
        } else {
            sendResponse('error', 'Erro ao inserir os dados.');
        }
    } else {
        sendResponse('error', 'Erro ao mover os arquivos.');
    }
}


?>

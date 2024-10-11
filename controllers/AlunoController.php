<?php
require_once '../models/AlunoModel.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'listar':
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
            $search = isset($_POST['search']) ? $_POST['search'] : '';

            $alunos = getAllAlunos($offset, $limit, $search);
            $totalAlunos = getAlunoCount($search);

            echo json_encode([
                'alunos' => $alunos,
                'total' => $totalAlunos
            ]);
            break;
        
        case 'adicionar':
            $nome = $_POST['nome'];
            $data_nasc = $_POST['data_nasc'];
            $nome_pai = $_POST['nome_pai'];
            $nome_mae = $_POST['nome_mae'];
            $municipio = $_POST['municipio'];
            $sexo = $_POST['sexo'];
            $bi = $_POST['bi'];
            $estado_civil = $_POST['estado_civil'];
            $email = $_POST['email'];
            $contacto_aluno = $_POST['contacto_aluno'];
            $contacto_enca1 = $_POST['contacto_enca1'];
            $contacto_enca2 = $_POST['contacto_enca2'];
            $classe = $_POST['classe'];
            $curso = $_POST['curso'];
            $certificado = $_POST['certificado'];
            $copia_bi = $_POST['copia_bi'];

            if (alunoExists($email)) {
                echo json_encode(['status' => 'error', 'message' => 'O aluno já existe!']);
            } else {
                $success = addAluno($nome, $data_nasc, $nome_pai, $nome_mae, $municipio, $sexo, $bi, $estado_civil, $email, $contacto_aluno, $contacto_enca1, $contacto_enca2, $classe, $curso, $certificado, $copia_bi);
                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Aluno adicionado com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar o aluno!']);
                }
            }
            break;
        
        case 'editar':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $data_nasc = $_POST['data_nasc'];
            $nome_pai = $_POST['nome_pai'];
            $nome_mae = $_POST['nome_mae'];
            $municipio = $_POST['municipio'];
            $sexo = $_POST['sexo'];
            $bi = $_POST['bi'];
            $estado_civil = $_POST['estado_civil'];
            $email = $_POST['email'];
            $contacto_aluno = $_POST['contacto_aluno'];
            $contacto_enca1 = $_POST['contacto_enca1'];
            $contacto_enca2 = $_POST['contacto_enca2'];
            $classe = $_POST['classe'];
            $curso = $_POST['curso'];
            $certificado = $_POST['certificado'];
            $copia_bi = $_POST['copia_bi'];

            $success = updateAluno($id, $nome, $data_nasc, $nome_pai, $nome_mae, $municipio, $sexo, $bi, $estado_civil, $email, $contacto_aluno, $contacto_enca1, $contacto_enca2, $classe, $curso, $certificado, $copia_bi);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Aluno atualizado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o aluno!']);
            }
            break;
        
        case 'deletar':
            $id = $_POST['id'];
            
            $success = deleteAluno($id);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Aluno deletado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o aluno!']);
            }
            break;
        
        case 'detalhes':
            $id = $_POST['id'];
            $aluno = getAlunoById($id);
            echo json_encode(['aluno' => $aluno]);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida!']);
            break;
    }
}
?>

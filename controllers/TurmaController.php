<?php
require_once '../models/TurmaModel.php'; // Certifique-se de que o modelo está corretamente incluído

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'listar':
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
            $search = isset($_POST['search']) ? $_POST['search'] : '';

            $turmas = getAllTurmas($offset, $limit, $search);
            $totalTurmas = getTurmaCount($search);

            echo json_encode([
                'turmas' => $turmas,
                'total' => $totalTurmas
            ]);
            break;
        
        case 'adicionar':
            $nome = $_POST['nome'];
            $id_classe = $_POST['id_classe']; // Obtém o ID da classe
            $id_curso = $_POST['id_curso']; // Obtém o ID do curso
            $ano = $_POST['ano']; // Obtém o ano

            // Verifica se a turma já existe
            if (turmaExists($nome)) {
                echo json_encode(['status' => 'error', 'message' => 'A turma já existe!']);
            } else {
                $success = addTurma($nome, $id_classe, $id_curso, $ano);
                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Turma adicionada com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar a turma!']);
                }
            }
            break;
        
        case 'editar':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $id_classe = $_POST['id_classe'];
            $id_curso = $_POST['id_curso'];
            $ano = $_POST['ano'];

            $success = updateTurma($id, $nome, $id_classe, $id_curso, $ano);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Turma atualizada com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar a turma!']);
            }
            break;
        
        case 'deletar':
            $id = $_POST['id'];
            
            $success = deleteTurma($id);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Turma deletada com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar a turma!']);
            }
            break;
        
        case 'detalhes':
            $id = $_POST['id'];
            $turma = getTurmaById($id);
            echo json_encode(['turma' => $turma]);
            break;

        case 'getClasses':
            $classes = getAllClasses(); // Função para obter todas as classes
            echo json_encode(['classes' => $classes]);
            break;

        case 'getCursos':
            $cursos = getAllCursos(); // Função para obter todos os cursos
            echo json_encode(['cursos' => $cursos]);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida!']);
            break;
    }
}
?>

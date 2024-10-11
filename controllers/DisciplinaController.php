<?php
require_once '../models/DisciplinaModel.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'listar':
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
            $search = isset($_POST['search']) ? $_POST['search'] : '';

            $disciplinas = getAllDisciplinas($offset, $limit, $search);
            $totalDisciplinas = getDisciplinaCount($search);

            echo json_encode([
                'disciplinas' => $disciplinas,
                'total' => $totalDisciplinas
            ]);
            break;
        
        case 'adicionar':
            $nome = $_POST['nome'];
            $id_turma = $_POST['turma'];
            $id_professor = $_POST['professor'];
            
            if (disciplinaExists($nome)) {
                echo json_encode(['status' => 'error', 'message' => 'A disciplina já existe!']);
            } else {
                $success = addDisciplina($nome, $id_turma, $id_professor);
                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Disciplina adicionada com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar a disciplina!']);
                }
            }
            break;
        
        case 'editar':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $id_turma = $_POST['turma'];
            $id_professor = $_POST['professor'];
            
            $success = updateDisciplina($id, $nome, $id_turma, $id_professor);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Disciplina atualizada com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar a disciplina!']);
            }
            break;
        
        case 'deletar':
            $id = $_POST['id'];
            
            $success = deleteDisciplina($id);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Disciplina deletada com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar a disciplina!']);
            }
            break;
        
        case 'detalhes':
            $id = $_POST['id'];
            $disciplina = getDisciplinaById($id);
            echo json_encode(['disciplina' => $disciplina]);
            break;
        
        case 'getTurmas':
            $turmas = getTurmas();
            echo json_encode($turmas);
            break;
        
        case 'getProfessores':
            $professores = getProfessores();
            echo json_encode($professores);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida!']);
            break;
    }
}
?>

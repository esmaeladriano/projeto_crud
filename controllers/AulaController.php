<?php
require_once '../models/AulaModel.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'listar':
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
            $search = isset($_POST['search']) ? $_POST['search'] : '';

            $aulas = getAllAulas($offset, $limit, $search);
            $totalAulas = getAulaCount($search);

            echo json_encode([
                'aulas' => $aulas,
                'total' => $totalAulas
            ]);
            break;

        case 'adicionar':
            $id_disciplina = $_POST['id_disciplina'];
            $id_turma = $_POST['id_turma'];
            $id_professor = $_POST['id_professor'];
            $ano = $_POST['ano'];
            $status = $_POST['status'];

            $success = addAula($id_disciplina, $id_turma, $id_professor, $ano, $status);
            echo json_encode([
                'status' => $success ? 'success' : 'error',
                'message' => $success ? 'Aula adicionada com sucesso!' : 'Erro ao adicionar a aula!'
            ]);
            break;

        case 'editar':
            $id = $_POST['id'];
            $id_disciplina = $_POST['id_disciplina'];
            $id_turma = $_POST['id_turma'];
            $id_professor = $_POST['id_professor'];
            $ano = $_POST['ano'];
            $status = $_POST['status'];

            $success = updateAula($id, $id_disciplina, $id_turma, $id_professor, $ano, $status);
            echo json_encode([
                'status' => $success ? 'success' : 'error',
                'message' => $success ? 'Aula atualizada com sucesso!' : 'Erro ao atualizar a aula!'
            ]);
            break;

        case 'deletar':
            $id = $_POST['id'];

            $success = deleteAula($id);
            echo json_encode([
                'status' => $success ? 'success' : 'error',
                'message' => $success ? 'Aula deletada com sucesso!' : 'Erro ao deletar a aula!'
            ]);
            break;

        case 'detalhes':
            $id = $_POST['id'];
            $aula = getAulaById($id);
            echo json_encode(['aula' => $aula]);
            break;

        case 'listar_disciplinas':
            echo json_encode(getDisciplinas());
            break;

        case 'listar_turmas':
            echo json_encode(getTurmas());
            break;

        case 'listar_professores':
            echo json_encode(getProfessores());
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida!']);
            break;
    }
}
?>

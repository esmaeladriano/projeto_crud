<?php
require_once '../models/TurmaModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'getTurmas':
            $offset = $_POST['offset'];
            $limit = $_POST['limit'];
            $search = $_POST['search'];
            $turmas = getAllTurmas($offset, $limit, $search);
            $total = getTurmaCount($search);
            echo json_encode(['turmas' => $turmas, 'total' => $total]);
            break;

        case 'add':
            $nome = $_POST['nome'];
            $id_curso = $_POST['id_curso'];
            $id_classe = $_POST['id_classe'];
            $id_turno = $_POST['id_turno'];
        
            // Verificar se a turma já existe
            if (turmaExists($nome)) {
                echo json_encode(['success' => false, 'message' => 'A turma já existe!']);
            } else {
                // Adicione a turma
                if (addTurma($nome, $id_curso, $id_classe, $id_turno)) {
                    echo json_encode(['success' => true, 'message' => 'Turma adicionada com sucesso!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar a turma.']);
                }
            }
            break;
            
        case 'update':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $id_curso = $_POST['id_curso'];
            $id_classe = $_POST['id_classe'];
            $id_turno = $_POST['id_turno'];
            updateTurma($id, $nome, $id_curso, $id_classe, $id_turno);
            echo json_encode(['status' => 'success']);
            break;

        case 'delete':
            $id = $_POST['id'];
            deleteTurma($id);
            echo json_encode(['status' => 'success']);
            break;

        case 'getSingleTurma':
            $id = $_POST['id'];
            $turma = getTurmaById($id);
            echo json_encode($turma);
            break;

        case 'getCursos':
            $cursos = getCursos();
            echo json_encode($cursos);
            break;

        case 'getClasses':
            $classes = getClasses();
            echo json_encode($classes);
            break;

        case 'getTurnos':
            $turnos = getTurnos();
            echo json_encode($turnos);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
            break;
    }
}
?>

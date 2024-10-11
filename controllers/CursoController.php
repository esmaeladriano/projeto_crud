<?php
require_once '../models/CursoModel.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'listar':
            $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
            $search = isset($_POST['search']) ? $_POST['search'] : '';

            $cursos = getAllCursos($offset, $limit, $search);
            $totalCursos = getCursoCount($search);

            echo json_encode([
                'cursos' => $cursos,
                'total' => $totalCursos
            ]);
            break;
        
        case 'adicionar':
            $nome = $_POST['nome'];
            
            if (cursoExists($nome)) {
                echo json_encode(['status' => 'error', 'message' => 'O curso já existe!']);
            } else {
                $success = addCurso($nome);
                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Curso adicionado com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar o curso!']);
                }
            }
            break;
        
        case 'editar':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            
            $success = updateCurso($id, $nome);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Curso atualizado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o curso!']);
            }
            break;
        
        case 'deletar':
            $id = $_POST['id'];
            
            $success = deleteCurso($id);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Curso deletado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o curso!']);
            }
            break;
        
        case 'detalhes':
            $id = $_POST['id'];
            $curso = getCursoById($id);
            echo json_encode(['curso' => $curso]);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida!']);
            break;
    }
}
?>

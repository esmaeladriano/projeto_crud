<?php
require_once '../conf/Database.php';

function getAllDisciplinas($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT d.id as id, d.nome as nome, p.nome as prof, t.nome as turma 
              FROM disciplina d
              LEFT JOIN disciplina_prof dp on dp.id_disciplina = d.id
              LEFT JOIN professores p on p.id = dp.id_prof
              LEFT JOIN disciplina_turma dt on dt.id_disciplina = d.id
              LEFT JOIN turma t on t.id = dt.id_turma
              WHERE d.nome LIKE :search 
              ORDER BY d.id DESC 
              LIMIT :offset, :limit";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDisciplinaCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as total FROM disciplina WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addDisciplina($nome, $id_turma, $id_prof) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO disciplina (nome) VALUES (:nome)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    
    $disciplina_id = $conn->lastInsertId();

    $queryTurma = "INSERT INTO disciplina_turma (id_disciplina, id_turma) VALUES (:id_disciplina, :id_turma)";
    $stmtTurma = $conn->prepare($queryTurma);
    $stmtTurma->bindValue(':id_disciplina', $disciplina_id);
    $stmtTurma->bindValue(':id_turma', $id_turma);
    $stmtTurma->execute();
    
    $queryProf = "INSERT INTO disciplina_prof (id_disciplina, id_prof) VALUES (:id_disciplina, :id_prof)";
    $stmtProf = $conn->prepare($queryProf);
    $stmtProf->bindValue(':id_disciplina', $disciplina_id);
    $stmtProf->bindValue(':id_prof', $id_prof);
    return $stmtProf->execute();
}

function updateDisciplina($id, $nome, $id_turma, $id_prof) {
    $db = new Database();
    $conn = $db->connect();

    $query = "UPDATE disciplina SET nome = :nome WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();

    // Atualizar turma e professor
    $queryTurma = "UPDATE disciplina_turma SET id_turma = :id_turma WHERE id_disciplina = :id";
    $stmtTurma = $conn->prepare($queryTurma);
    $stmtTurma->bindValue(':id_turma', $id_turma);
    $stmtTurma->bindValue(':id', $id);
    $stmtTurma->execute();

    $queryProf = "UPDATE disciplina_prof SET id_prof = :id_prof WHERE id_disciplina = :id";
    $stmtProf = $conn->prepare($queryProf);
    $stmtProf->bindValue(':id_prof', $id_prof);
    $stmtProf->bindValue(':id', $id);
    return $stmtProf->execute();
}

function deleteDisciplina($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "DELETE FROM disciplina WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

function getDisciplinaById($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT d.id as id, d.nome as nome, p.nome as prof, t.nome as turma
              FROM disciplina d
              LEFT JOIN disciplina_prof dp on dp.id_disciplina = d.id
              LEFT JOIN professores p on p.id = dp.id_prof
              LEFT JOIN disciplina_turma dt on dt.id_disciplina = d.id
              LEFT JOIN turma t on t.id = dt.id_turma
              WHERE d.id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function disciplinaExists($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id FROM disciplina WHERE nome = :nome";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTurmas() {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, nome FROM turma";
    $stmt = $conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProfessores() {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, nome FROM professores";
    $stmt = $conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

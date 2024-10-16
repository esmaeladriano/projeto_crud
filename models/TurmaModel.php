<?php
require_once '../conf/Database.php';

function getAllTurmas($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, nome, id_classe, id_curso, ano 
              FROM turma 
              WHERE nome LIKE :search 
              ORDER BY id DESC 
              LIMIT :offset, :limit";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTurmaCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as total FROM turma WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addTurma($nome, $id_classe, $id_curso, $ano) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO turma (nome, id_classe, id_curso, ano) VALUES (:nome, :id_classe, :id_curso, :ano)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id_classe', $id_classe);
    $stmt->bindValue(':id_curso', $id_curso);
    $stmt->bindValue(':ano', $ano);
    return $stmt->execute();
}

function updateTurma($id, $nome, $id_classe, $id_curso, $ano) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "UPDATE turma SET nome = :nome, id_classe = :id_classe, id_curso = :id_curso, ano = :ano WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id_classe', $id_classe);
    $stmt->bindValue(':id_curso', $id_curso);
    $stmt->bindValue(':ano', $ano);
    return $stmt->execute();
}

function deleteTurma($id) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "DELETE FROM turma WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

function getTurmaById($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM turma WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function turmaExists($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id FROM turma WHERE nome = :nome";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funções para obter classes e cursos
function getAllClasses() {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "SELECT id, nome FROM classe";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllCursos() {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "SELECT id, nome FROM curso";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

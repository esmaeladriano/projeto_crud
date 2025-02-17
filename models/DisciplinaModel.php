<?php
require_once '../conf/Database.php';

function getAllDisciplinas($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, nome 
              FROM disciplina 
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

function getDisciplinaCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as total FROM disciplina WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addDisciplina($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO disciplina (nome) VALUES (:nome)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    return $stmt->execute();
}

function updateDisciplina($id, $nome) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "UPDATE disciplina SET nome = :nome WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    return $stmt->execute();
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

    $query = "SELECT * FROM disciplina WHERE id = :id"; // Corrigido: adicionado 'disciplina' na consulta
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
?>

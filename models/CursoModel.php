<?php
require_once '../conf/Database.php';

function getAllCursos($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, nome 
              FROM curso 
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

function getCursoCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as total FROM curso WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addCurso($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO curso (nome) VALUES (:nome)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    return $stmt->execute();
}

function updateCurso($id, $nome) {
    $db = new Database();
    $conn = $db->connect();
    $query = "UPDATE curso SET nome = :nome WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    return $stmt->execute();
}

function deleteCurso($id) {
    $db = new Database();
    $conn = $db->connect();
    $query = "DELETE FROM curso WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

function getCursoById($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM curso WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function cursoExists($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id FROM curso WHERE nome = :nome";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

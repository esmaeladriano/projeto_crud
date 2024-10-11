<?php
require_once 'Database.php';

function getAllUsers($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM users WHERE nome LIKE :search ORDER BY id DESC LIMIT :offset, :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) AS total FROM users WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addUser($nome, $email, $telefone, $foto) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO users (nome, email, telefone, foto) VALUES (:nome, :email, :telefone, :foto)";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->bindValue(':foto', $foto);
    return $stmt->execute();
}

function deleteUser($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

function updateUser($id, $nome, $email, $telefone) {
    $db = new Database();
    $conn = $db->connect();

    $query = "UPDATE users SET nome = :nome, email = :email, telefone = :telefone";
    // if ($foto) {
    //     $query .= ", foto = :foto";
    // }
    $query .= " WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);
    // if ($foto) {
    //     $stmt->bindValue(':foto', $foto);
    // }
    return $stmt->execute();
}

// Função para buscar um usuário pelo ID
function getUserById($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php
require_once '../conf/Database.php';

function getAllTurmas($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT t.id as id, t.nome as turma, c.nome curso, cl.nome as classe, tu.nome as turno 
              FROM turma t 
              JOIN curso c on t.id_curso = c.id 
              JOIN classe cl on t.id_classe = cl.id 
              JOIN turno tu on t.id_turno = tu.id 
              WHERE t.nome LIKE :search 
              ORDER BY t.id DESC 
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

    $query = "SELECT COUNT(*) AS total FROM turma WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addTurma($nome, $id_curso, $id_classe, $id_turno) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO turma (nome, id_curso, id_classe, id_turno) 
              VALUES (:nome, :id_curso, :id_classe, :id_turno)";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id_curso', $id_curso);
    $stmt->bindValue(':id_classe', $id_classe);
    $stmt->bindValue(':id_turno', $id_turno);
    return $stmt->execute();
}

function updateTurma($id, $nome, $id_curso, $id_classe, $id_turno) {
    $db = new Database();
    $conn = $db->connect();

    $query = "UPDATE turma 
              SET nome = :nome, id_curso = :id_curso, id_classe = :id_classe, id_turno = :id_turno 
              WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':id_curso', $id_curso);
    $stmt->bindValue(':id_classe', $id_classe);
    $stmt->bindValue(':id_turno', $id_turno);
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
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função para obter cursos
function getCursos() {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM curso";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para obter classes
function getClasses() {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM classe";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para obter turnos
function getTurnos() {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM turno";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Função para verificar se a turma já existe
function turmaExists($nome) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as count FROM turma WHERE nome = :nome";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Usando o método fetch diretamente para PDO
    return $result['count'] > 0; // Retorna true se a turma já existir
}


?>

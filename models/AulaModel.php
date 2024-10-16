<?php
require_once '../config/Database.php';

// Funções para gerenciar aulas
function getAllAulas($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();
    $searchQuery = !empty($search) ? "WHERE d.nome LIKE :search OR t.nome LIKE :search OR p.nome LIKE :search" : "";

    $sql = "SELECT a.id, d.nome AS nome_disciplina, t.nome AS nome_turma, p.nome AS nome_professor, 
            a.ano, a.status 
            FROM aula a
            JOIN disciplina d ON a.id_disciplina = d.id
            JOIN turma t ON a.id_turma = t.id
            JOIN professor p ON a.id_professor = p.id
            $searchQuery
            LIMIT :offset, :limit";

    $stmt = $conn->prepare($sql);
    
    if (!empty($search)) {
        $stmt->bindValue(':search', "%$search%");
    }
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAulaCount($search = '') {
    $db = new Database();
    $conn = $db->connect();
    $searchQuery = !empty($search) ? "WHERE d.nome LIKE :search OR t.nome LIKE :search OR p.nome LIKE :search" : "";

    $sql = "SELECT COUNT(*) as total 
            FROM aula a
            JOIN disciplina d ON a.id_disciplina = d.id
            JOIN turma t ON a.id_turma = t.id
            JOIN professor p ON a.id_professor = p.id
            $searchQuery";
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($search)) {
        $stmt->bindValue(':search', "%$search%");
    }
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function addAula($id_disciplina, $id_turma, $id_professor, $ano, $status) {
    $db = new Database();
    $conn = $db->connect();
    $sql = "INSERT INTO aula (id_disciplina, id_turma, id_professor, ano, status) 
            VALUES (:id_disciplina, :id_turma, :id_professor, :ano, :status)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id_disciplina', $id_disciplina);
    $stmt->bindValue(':id_turma', $id_turma);
    $stmt->bindValue(':id_professor', $id_professor);
    $stmt->bindValue(':ano', $ano);
    $stmt->bindValue(':status', $status);
    
    return $stmt->execute();
}

function updateAula($id, $id_disciplina, $id_turma, $id_professor, $ano, $status) {
    $db = new Database();
    $conn = $db->connect();
    $sql = "UPDATE aula SET id_disciplina = :id_disciplina, 
            id_turma = :id_turma, id_professor = :id_professor, ano = :ano, status = :status 
            WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':id_disciplina', $id_disciplina);
    $stmt->bindValue(':id_turma', $id_turma);
    $stmt->bindValue(':id_professor', $id_professor);
    $stmt->bindValue(':ano', $ano);
    $stmt->bindValue(':status', $status);
    
    return $stmt->execute();
}

function deleteAula($id) {
    $db = new Database();
    $conn = $db->connect();
    $sql = "DELETE FROM aula WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    
    return $stmt->execute();
}

function getAulaById($id) {
    $db = new Database();
    $conn = $db->connect();
    $sql = "SELECT * FROM aula WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funções para carregar disciplinas, turmas e professores
function getDisciplinas() {
    $db = new Database();
    $conn = $db->connect();
    $sql = "SELECT id, nome FROM disciplina";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTurmas() {
    $db = new Database();
    $conn = $db->connect();
    $sql = "SELECT id, nome FROM turma";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProfessores() {
    $db = new Database();
    $conn = $db->connect();
    $sql = "SELECT id, nome FROM professor";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

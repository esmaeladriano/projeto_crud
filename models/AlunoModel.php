<?php
require_once '../conf/Database.php';

function getAllAlunos($offset, $limit, $search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT a.id as id, a.nome as nome , t.nome AS turma, c.nome AS curso, cl.nome AS classe 
              FROM aluno a
              JOIN matricula m ON m.id_aluno = a.id
              JOIN turma t ON t.id = m.id_turma
              JOIN curso c ON c.id = t.id_curso
              JOIN classe cl ON cl.id = t.id_classe
              WHERE a.nome LIKE :search 
              ORDER BY a.id DESC 
              LIMIT :offset, :limit";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAlunoCount($search = '') {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT COUNT(*) as total FROM aluno WHERE nome LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function alunoExists($email) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id FROM aluno WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addAluno($nome, $data_nasc, $nome_pai, $nome_mae, $municipio, $sexo, $bi, $estado_civil, $email, $contacto_aluno, $contacto_enca1, $contacto_enca2, $classe, $curso, $certificado, $copia_bi) {
    $db = new Database();
    $conn = $db->connect();

    $query = "INSERT INTO aluno (nome, Data_nasc, Nome_pai, Nome_mae, Municipio, Sexo, BI, Estado_civil, email, Contacto_aluno, Contacto_enca1, Contacto_enca2, Classe, Curso, certificado, copia_BI) 
              VALUES (:nome, :data_nasc, :nome_pai, :nome_mae, :municipio, :sexo, :bi, :estado_civil, :email, :contacto_aluno, :contacto_enca1, :contacto_enca2, :classe, :curso, :certificado, :copia_bi)";
    
    $stmt = $conn->prepare($query);
    return $stmt->execute([
        ':nome' => $nome,
        ':data_nasc' => $data_nasc,
        ':nome_pai' => $nome_pai,
        ':nome_mae' => $nome_mae,
        ':municipio' => $municipio,
        ':sexo' => $sexo,
        ':bi' => $bi,
        ':estado_civil' => $estado_civil,
        ':email' => $email,
        ':contacto_aluno' => $contacto_aluno,
        ':contacto_enca1' => $contacto_enca1,
        ':contacto_enca2' => $contacto_enca2,
        ':classe' => $classe,
        ':curso' => $curso,
        ':certificado' => $certificado,
        ':copia_bi' => $copia_bi
    ]);
}

function updateAluno($id, $nome, $data_nasc, $nome_pai, $nome_mae, $municipio, $sexo, $bi, $estado_civil, $email, $contacto_aluno, $contacto_enca1, $contacto_enca2, $classe, $curso, $certificado, $copia_bi) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "UPDATE aluno SET 
              nome = :nome, 
              Data_nasc = :data_nasc, 
              Nome_pai = :nome_pai, 
              Nome_mae = :nome_mae, 
              Municipio = :municipio, 
              Sexo = :sexo, 
              BI = :bi, 
              Estado_civil = :estado_civil, 
              email = :email, 
              Contacto_aluno = :contacto_aluno, 
              Contacto_enca1 = :contacto_enca1, 
              Contacto_enca2 = :contacto_enca2, 
              Classe = :classe, 
              Curso = :curso, 
              certificado = :certificado, 
              copia_BI = :copia_bi 
              WHERE id = :id";
    
    $stmt = $conn->prepare($query);
    return $stmt->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':data_nasc' => $data_nasc,
        ':nome_pai' => $nome_pai,
        ':nome_mae' => $nome_mae,
        ':municipio' => $municipio,
        ':sexo' => $sexo,
        ':bi' => $bi,
        ':estado_civil' => $estado_civil,
        ':email' => $email,
        ':contacto_aluno' => $contacto_aluno,
        ':contacto_enca1' => $contacto_enca1,
        ':contacto_enca2' => $contacto_enca2,
        ':classe' => $classe,
        ':curso' => $curso,
        ':certificado' => $certificado,
        ':copia_bi' => $copia_bi
    ]);
}

function deleteAluno($id) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = "DELETE FROM aluno WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

function getAlunoById($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM aluno WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

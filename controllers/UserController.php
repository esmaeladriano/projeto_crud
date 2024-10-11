<?php
require_once '../models/UserModel.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $foto = '';

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = '../uploads/' . time() . '_' . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
        }

        $success = addUser($nome, $email, $telefone, $foto);
        echo $success ? 'success' : 'error';
    }

    if ($action == 'delete') {
        $id = $_POST['id'];
        $success = deleteUser($id);
        echo $success ? 'success' : 'error';
    }


    if ($action == 'update') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        // $foto = '';

        // if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        //     $foto = '../uploads/' . time() . '_' . $_FILES['foto']['name'];
        //     move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
        // }

        $success = updateUser($id, $nome, $email, $telefone);
        // echo $success ? 'success' : 'error';
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode([
            'status' => 'error', 
            'message' => 'Não foi possível'
        ]);
        }
    }

    if ($action == 'getUsers') {
        $offset = $_POST['offset'];
        $limit = $_POST['limit'];
        $search = $_POST['search'] ?? '';
        $users = getAllUsers($offset, $limit, $search);
        $total = getUserCount($search);
        echo json_encode(['users' => $users, 'total' => $total]);
    }

    if ($_POST['action'] == 'getSingleUser') {
        $id = $_POST['id'];
        $user = getUserById($id);
    
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode([
            'status' => 'error', 
            'message' => 'Usuário não encontrado'
        ]);
        }
    }
}
?>

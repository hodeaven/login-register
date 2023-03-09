<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');

    if ($action === 'register') {
        // Recebe as informações enviadas pelo formulário de cadastro
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Chama a função para cadastrar um novo usuário
        $result = register_user($username, $email, $password);

        // Verifica se o cadastro foi realizado com sucesso
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Usuário criado com sucesso!'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Não foi possível criar o usuário, talvez ele já esteja cadastrado.'));
        }
    } elseif ($action === 'login') {
        // Recebe as informações enviadas pelo formulário de login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Chama a função para realizar o login
        $user = login_user($email, $password);

        // Verifica se o login foi realizado com sucesso
        if ($user) {
            echo json_encode(array('status' => 'usuário autenticado com sucesso', 'user' => $user));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Não foi possível realizar o login.'));
        }
    }
}
?>
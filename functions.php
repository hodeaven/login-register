<?php
require_once 'config.php';

function register_user($username, $email, $password)
{
    // Conectar ao banco de dados SQLite
    $db = new PDO('sqlite:teste.db');

    // Verificar se o email já existe na tabela `users`
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user) {
        return false;
    }

    // Criptografar a senha do usuário
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Instrução SQL para inserir um novo usuário na tabela `users`
    $sql = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, datetime('now'))";

    // Preparar a instrução SQL
    $stmt = $db->prepare($sql);

    // Passar os valores como parâmetros para a instrução SQL
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $hashed_password);

    // Executar a instrução SQL preparada
    $stmt->execute();

    return true;
}


function login_user($email, $password)
{
    // Conectar ao banco de dados SQLite
    $db = new PDO('sqlite:teste.db');

    // Buscar o usuário pelo email
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificar se o usuário existe e a senha está correta
    if (!$user || !password_verify($password, $user['password'])) {
        return false;
    }

    // Remover a senha do usuário antes de retornar
    unset($user['password']);

    return $user;
}
?>
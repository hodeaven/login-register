<?php

//Definindo as variáveis 

define('DB_NAME', 'teste.db');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');
define('HTTP_ORIGIN','');

$dsn = 'sqlite:' . DB_NAME;


try {
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

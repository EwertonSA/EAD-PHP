<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

// Carregar as variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Acessando as variáveis do .env
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db = $_ENV['DB_NAME'];

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "Conexão falhou: " . $mysqli->connect_error;
    exit();
}
?>

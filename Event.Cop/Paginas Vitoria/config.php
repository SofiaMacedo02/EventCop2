<?php
// Configuração de Conexão com o Banco de Dados - EventCop

$host   = "localhost";
$user   = "root";
$pass   = "";
$bdname = "event_cop";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$bdname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Log interno do erro e mensagem amigável para não expor credenciais
    error_log("Erro de Conexão PDO: " . $e->getMessage());
    die("Erro na conexão com o banco de dados. Verifique se o MySQL está ativo no XAMPP.");
}

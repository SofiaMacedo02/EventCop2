<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$bdname = "event_cop";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$bdname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
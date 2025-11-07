<?php
$dsn = "mysql:host=localhost;dbname=sistema_agendamento;charset=utf8mb4";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
?>
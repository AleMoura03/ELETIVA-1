<?php
session_start();
if (!isset($_SESSION['acesso']) || !$_SESSION['acesso']) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sistema de Agendamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
  <nav class="mb-3">
    <a href="principal.php" class="btn btn-outline-primary">Início</a>
    <a href="pacientes.php" class="btn btn-outline-primary">Pacientes</a>
    <a href="medicos.php" class="btn btn-outline-primary">Médicos</a>
    <a href="horarios.php" class="btn btn-outline-primary">Horários</a>
    <a href="agendamentos.php" class="btn btn-outline-primary">Agendamentos</a>
    <a href="logout.php" class="btn btn-danger">Sair</a>
  </nav>

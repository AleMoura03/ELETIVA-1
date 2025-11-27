<?php

session_start();


if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] !== true) {
    header('Location: index.php');
    exit;
}


$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sistema de Agendamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="principal.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link <?= $current=='pacientes.php' ? 'active' : '' ?>" href="pacientes.php">Pacientes</a></li>
        <li class="nav-item"><a class="nav-link <?= $current=='medicos.php' ? 'active' : '' ?>" href="medicos.php">Médicos</a></li>
        <li class="nav-item"><a class="nav-link <?= $current=='agendamentos.php' ? 'active' : '' ?>" href="agendamentos.php">Agendamentos</a></li>
        <li class="nav-item"><a class="nav-link <?= $current=='horarios.php' ? 'active' : '' ?>" href="horarios.php">Horários</a></li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item"><span class="nav-link">Olá, <?= htmlspecialchars($_SESSION['nome'] ?? '') ?></span></li>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Sair</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

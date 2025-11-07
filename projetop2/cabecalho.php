<?php
// cabecalho.php
if (session_status() == PHP_SESSION_NONE)
    session_start();

// Páginas públicas: index.php (login) e cadastro.php
$nomeArquivo = basename($_SERVER['PHP_SELF']);
$publicPages = ['index.php', 'cadastro.php'];

// proteger páginas privadas
if (!in_array($nomeArquivo, $publicPages)) {
    if (!isset($_SESSION['acesso']) || !$_SESSION['acesso']) {
        header('Location: index.php');
        exit;
    }
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="principal.php">Agenda</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION['acesso']) && $_SESSION['acesso']): ?>
                        <li class="nav-item"><a class="nav-link" href="pacientes.php">Pacientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="medicos.php">Médicos</a></li>
                        <li class="nav-item"><a class="nav-link" href="horarios.php">Horários</a></li>
                        <li class="nav-item"><a class="nav-link" href="agendamentos.php">Agendamentos</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['acesso']) && $_SESSION['acesso']): ?>
                        <li class="nav-item"><span class="nav-link">Olá, <?= htmlspecialchars($_SESSION['nome']) ?></span>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php">Entrar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
<?php
require("cabecalho.php");
require("conexao.php");

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header("Location: agendamentos.php");
    exit;
}

// selecionar agendamento com dados
$stmt = $pdo->prepare("
    SELECT a.*, p.nome AS paciente, m.nome AS medico 
    FROM agendamento a
    INNER JOIN paciente p ON p.id = a.paciente_id
    INNER JOIN medico m ON m.id = a.medico_id
    WHERE a.id = ?
");
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$a) {
    header("Location: agendamentos.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM agendamento WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: agendamentos.php?excluir=true");
        exit;
    } else {
        header("Location: agendamentos.php?excluir=false");
        exit;
    }
}
?>

<h2>Consultar Agendamento #<?= $a['id'] ?></h2>

<p><strong>Paciente:</strong> <?= htmlspecialchars($a['paciente']) ?></p>
<p><strong>Médico:</strong> <?= htmlspecialchars($a['medico']) ?></p>
<p><strong>Data e Hora:</strong> <?= date('d/m/Y H:i', strtotime($a['data_hora'])) ?></p>
<p><strong>Status:</strong> <?= htmlspecialchars($a['status'] ?? 'Agendado') ?></p>

<form method="post">
    <button class="btn btn-danger" type="submit">Excluir</button>
    <a href="agendamentos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("rodape.php"); ?>
<?php
require("cabecalho.php");
require("conexao.php");

$stmt = $pdo->prepare("
    SELECT a.*, p.nome AS paciente, m.nome AS medico, h.data_atendimento 
    FROM agendamento a
    INNER JOIN paciente p ON a.paciente_id=p.id
    INNER JOIN horario h ON a.horario_id=h.id
    INNER JOIN medico m ON h.medico_id=m.id
    WHERE a.id=?");
$stmt->execute([$_GET['id']]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $stmt = $pdo->prepare("DELETE FROM agendamento WHERE id=?");
    if ($stmt->execute([$_POST['id']])) {
        header("location: agendamentos.php?excluir=true");
    } else {
        header("location: agendamentos.php?excluir=false");
    }
}
?>

<h2>Consultar Agendamento</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $a['id'] ?>">

    <p><strong>Paciente:</strong> <?= $a['paciente'] ?></p>
    <p><strong>Médico:</strong> <?= $a['medico'] ?></p>
    <p><strong>Data:</strong> <?= date("d/m/Y H:i", strtotime($a['data_atendimento'])) ?></p>
    <p><strong>Status:</strong> <?= $a['status'] ?></p>

    <p class="text-danger mt-3">Deseja excluir este registro?</p>
    <button class="btn btn-danger">Excluir</button>
    <button type="button" onclick="history.back()" class="btn btn-secondary">Voltar</button>
</form>

<?php require("rodape.php"); ?>
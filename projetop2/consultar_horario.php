<?php
require("cabecalho.php");
require("conexao.php");

$stmt = $pdo->prepare("
SELECT h.*, p.nome AS paciente, m.nome AS medico 
FROM horario h
INNER JOIN paciente p ON h.paciente_id=p.id
INNER JOIN medico m ON h.medico_id=m.id
WHERE h.id = ?");
$stmt->execute([$_GET['id']]);
$h = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $stmt = $pdo->prepare("DELETE FROM horario WHERE id=?");
    if ($stmt->execute([$_POST['id']])) {
        header("location: horarios.php?excluir=true");
    } else {
        header("location: horarios.php?excluir=false");
    }
}
?>

<h2>Consultar Agendamento</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $h['id'] ?>">

    <p><strong>Paciente:</strong> <?= $h['paciente'] ?></p>
    <p><strong>Médico:</strong> <?= $h['medico'] ?></p>
    <p><strong>Data:</strong> <?= date("d/m/Y H:i", strtotime($h['data_atendimento'])) ?></p>

    <p class="mt-3 text-danger">Deseja excluir este registro?</p>

    <button class="btn btn-danger">Excluir</button>
    <button type="button" onclick="history.back()" class="btn btn-secondary">Voltar</button>
</form>

<?php require("rodape.php"); ?>
<?php
require("cabecalho.php");
require("conexao.php");

$stmt = $pdo->prepare("SELECT * FROM agendamento WHERE id=?");
$stmt->execute([$_GET['id']]);
$agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

$pacientes = $pdo->query("SELECT * FROM paciente")->fetchAll();
$horarios = $pdo->query("SELECT * FROM horario")->fetchAll();

if($_SERVER['REQUEST_METHOD']=="POST"){
    $paciente = $_POST['paciente'];
    $horario = $_POST['horario'];
    $status = $_POST['status'];
    $id = $_POST['id'];

    $stmt = $pdo->prepare("UPDATE agendamento SET paciente_id=?, horario_id=?, status=? WHERE id=?");
    if($stmt->execute([$paciente,$horario,$status,$id])){
        header("location: agendamentos.php?editar=true");
    } else {
        header("location: agendamentos.php?editar=false");
    }
}
?>

<h2>Editar Agendamento</h2>

<form method="POST">
<input type="hidden" name="id" value="<?= $agendamento['id'] ?>">

<label>Paciente:</label>
<select class="form-control mb-2" name="paciente">
    <?php foreach($pacientes as $p): ?>
    <option value="<?= $p['id'] ?>" <?= $p['id']==$agendamento['paciente_id']?"selected":"" ?>>
        <?= $p['nome'] ?>
    </option>
    <?php endforeach; ?>
</select>

<label>Horário:</label>
<select class="form-control mb-2" name="horario">
    <?php foreach($horarios as $h): ?>
    <option value="<?= $h['id'] ?>" <?= $h['id']==$agendamento['horario_id']?"selected":"" ?>>
        <?= $h['id'] ?> - <?= $h['data_atendimento'] ?>
    </option>
    <?php endforeach; ?>
</select>

<label>Status:</label>
<select name="status" class="form-control mb-3">
    <option <?= $agendamento['status']=="Agendado"?"selected":"" ?>>Agendado</option>
    <option <?= $agendamento['status']=="Cancelado"?"selected":"" ?>>Cancelado</option>
    <option <?= $agendamento['status']=="Realizado"?"selected":"" ?>>Realizado</option>
</select>

<button class="btn btn-primary">Salvar</button>
</form>

<?php require("rodape.php"); ?>

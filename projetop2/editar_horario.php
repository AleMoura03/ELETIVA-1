<?php
require("cabecalho.php");
require("conexao.php");

$stmt = $pdo->prepare("SELECT * FROM horario WHERE id = ?");
$stmt->execute([$_GET['id']]);
$horario = $stmt->fetch(PDO::FETCH_ASSOC);

$pacientes = $pdo->query("SELECT * FROM paciente")->fetchAll();
$medicos = $pdo->query("SELECT * FROM medico")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $paciente = $_POST['paciente'];
    $medico = $_POST['medico'];
    $data = $_POST['data_atendimento'];
    $id = $_POST['id'];

    $stmt = $pdo->prepare("UPDATE horario SET paciente_id=?, medico_id=?, data_atendimento=? WHERE id=?");

    if ($stmt->execute([$paciente, $medico, $data, $id])) {
        header("location: horarios.php?editar=true");
    } else {
        header("location: horarios.php?editar=false");
    }
}
?>

<h2>Editar Agendamento</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $horario['id'] ?>">

    <label>Paciente:</label>
    <select name="paciente" class="form-control mb-2" required>
        <?php foreach ($pacientes as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $horario['paciente_id'] ? "selected" : "" ?>>
                <?= $p['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Médico:</label>
    <select name="medico" class="form-control mb-2" required>
        <?php foreach ($medicos as $m): ?>
            <option value="<?= $m['id'] ?>" <?= $m['id'] == $horario['medico_id'] ? "selected" : "" ?>>
                <?= $m['nome'] ?> (<?= $m['especialidade'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Data e Hora:</label>
    <input type="datetime-local" class="form-control mb-3" name="data_atendimento"
        value="<?= date('Y-m-d\TH:i', strtotime($horario['data_atendimento'])) ?>" required>

    <button class="btn btn-primary">Salvar</button>
</form>

<?php require("rodape.php"); ?>
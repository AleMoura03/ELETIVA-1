<?php
require("cabecalho.php");
require("conexao.php");

$pacientes = $pdo->query("SELECT * FROM paciente")->fetchAll();
$medicos = $pdo->query("SELECT * FROM medico")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente = $_POST['paciente'];
    $medico = $_POST['medico'];
    $data = $_POST['data_atendimento'];

    try {
        $stmt = $pdo->prepare("INSERT INTO horario (paciente_id, medico_id, data_atendimento) VALUES (?, ?, ?)");
        if ($stmt->execute([$paciente, $medico, $data])) {
            header("location: horarios.php?cadastro=true");
        } else {
            header("location: horarios.php?cadastro=false");
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<h2>Novo Agendamento</h2>

<form method="POST">
    <label>Selecione o Paciente:</label>
    <select name="paciente" class="form-control mb-2" required>
        <?php foreach ($pacientes as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Selecione o Médico:</label>
    <select name="medico" class="form-control mb-2" required>
        <?php foreach ($medicos as $m): ?>
            <option value="<?= $m['id'] ?>"><?= $m['nome'] ?> (<?= $m['especialidade'] ?>)</option>
        <?php endforeach; ?>
    </select>

    <label>Data e Hora:</label>
    <input type="datetime-local" name="data_atendimento" class="form-control mb-3" required>

    <button class="btn btn-primary">Salvar</button>
</form>

<?php require("rodape.php"); ?>
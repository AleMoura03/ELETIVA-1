<?php
require("cabecalho.php");
require("conexao.php");

$pacientes = $pdo->query("SELECT * FROM paciente")->fetchAll();
$horarios = $pdo->query("
    SELECT h.*, m.nome AS medico, p.nome AS paciente
    FROM horario h
    INNER JOIN medico m ON h.medico_id = m.id
    LEFT JOIN agendamento a ON a.horario_id = h.id
    LEFT JOIN paciente p ON a.paciente_id = p.id
    WHERE a.id IS NULL
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $paciente = $_POST['paciente'];
    $horario = $_POST['horario'];

    try {
        $stmt = $pdo->prepare("INSERT INTO agendamento (paciente_id, horario_id) VALUES (?,?)");
        if ($stmt->execute([$paciente, $horario])) {
            header("location: agendamentos.php?cadastro=true");
        } else {
            header("location: agendamentos.php?cadastro=false");
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<h2>Novo Agendamento</h2>

<form method="POST">
    <label>Paciente:</label>
    <select name="paciente" class="form-control mb-3" required>
        <?php foreach ($pacientes as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Selecione um horário disponível:</label>
    <select name="horario" class="form-control mb-3" required>
        <?php foreach ($horarios as $h): ?>
            <option value="<?= $h['id'] ?>">
                <?= $h['medico'] ?> - <?= date("d/m/Y H:i", strtotime($h['data_atendimento'])) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="btn btn-primary">Salvar</button>
</form>

<?php require("rodape.php"); ?>
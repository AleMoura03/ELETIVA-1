<?php
require("cabecalho.php");
require("conexao.php");

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header("Location: agendamentos.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM agendamento WHERE id = ?");
$stmt->execute([$id]);
$ag = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ag) {
    header("Location: agendamentos.php");
    exit;
}

$errors = [];

$pacientes = $pdo->query("SELECT id, nome FROM paciente ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$medicos = $pdo->query("SELECT id, nome FROM medico ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

$hours = [];
for ($h = 8; $h <= 17; $h++)
    $hours[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';

$selected_paciente = $_POST['paciente'] ?? $ag['paciente_id'];
$selected_medico = $_POST['medico'] ?? $ag['medico_id'];
$selected_date = $_POST['data'] ?? date('Y-m-d', strtotime($ag['data_hora']));
$selected_time = $_POST['hora'] ?? date('H:i', strtotime($ag['data_hora']));

function get_booked_hours_excluding_self($pdo, $medico_id, $date, $exclude_agendamento_id)
{
    $sql = "SELECT TIME(data_hora) as hora FROM agendamento WHERE medico_id = ? AND DATE(data_hora) = ? AND id <> ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$medico_id, $date, $exclude_agendamento_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    $res = [];
    foreach ($rows as $r)
        $res[] = substr($r, 0, 5);
    return $res;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $paciente = intval($_POST['paciente'] ?? 0);
    $medico = intval($_POST['medico'] ?? 0);
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';

    if (!$paciente)
        $errors[] = "Selecione um paciente.";
    if (!$medico)
        $errors[] = "Selecione um médico.";
    if (!$data)
        $errors[] = "Selecione uma data.";
    if (!$hora)
        $errors[] = "Selecione um horário.";

    $today = new DateTime('today');
    try {
        $dt = new DateTime($data);
    } catch (Exception $e) {
        $errors[] = "Data inválida.";
    }
    if (empty($errors) && $dt < $today)
        $errors[] = "Escolha uma data futura.";

    if (empty($errors) && !in_array($hora, $hours))
        $errors[] = "Horário inválido.";

    if (empty($errors)) {
        $datetime_str = $data . ' ' . $hora . ':00';
        $sql = "SELECT COUNT(*) FROM agendamento WHERE medico_id = ? AND data_hora = ? AND id <> ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$medico, $datetime_str, $id]);
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Horário não disponível.";
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE agendamento SET paciente_id = ?, medico_id = ?, data_hora = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$paciente, $medico, $datetime_str, $id])) {
            header("Location: agendamentos.php?editar=true");
            exit;
        } else {
            $errors[] = "Erro ao atualizar.";
        }
    }
}

$available_hours = [];
if (!empty($selected_medico) && !empty($selected_date)) {
    $booked = get_booked_hours_excluding_self($pdo, $selected_medico, $selected_date, $id);
    foreach ($hours as $h)
        if (!in_array($h, $booked))
            $available_hours[] = $h;
}
?>

<h2>Editar Agendamento #<?= $id ?></h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $er)
            echo "<div>" . htmlspecialchars($er) . "</div>"; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Paciente</label>
        <select name="paciente" class="form-select" required>
            <?php foreach ($pacientes as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $selected_paciente == $p['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Médico</label>
        <select name="medico" class="form-select" required>
            <?php foreach ($medicos as $m): ?>
                <option value="<?= $m['id'] ?>" <?= $selected_medico == $m['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Data</label>
        <input type="date" name="data" value="<?= htmlspecialchars($selected_date) ?>" class="form-control" required
            min="<?= date('Y-m-d') ?>">
    </div>

    <div class="mb-3">
        <button class="btn btn-secondary" type="submit" name="action" value="show_times">Mostrar horários</button>
    </div>

    <?php if (!empty($available_hours)): ?>
        <div class="mb-3">
            <label class="form-label">Horários disponíveis</label>
            <select name="hora" class="form-select" required>
                <?php foreach ($available_hours as $ah): ?>
                    <option value="<?= $ah ?>" <?= $selected_time == $ah ? 'selected' : '' ?>><?= $ah ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit" name="action" value="save">Salvar</button>
            <a href="agendamentos.php" class="btn btn-secondary">Cancelar</a>
        </div>
    <?php else: ?>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'show_times'): ?>
            <div class="alert alert-warning">Nenhum horário disponível para esse dia e médico.</div>
        <?php endif; ?>
    <?php endif; ?>
</form>

<?php require("rodape.php"); ?>
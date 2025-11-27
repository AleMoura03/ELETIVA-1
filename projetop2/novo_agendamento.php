<?php
require("cabecalho.php");
require("conexao.php");

$errors = [];

// lista pacientes e medicos
$pacientes = $pdo->query("SELECT id, nome FROM paciente ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$medicos = $pdo->query("SELECT id, nome FROM medico ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// parâmetros do passo
$selected_paciente = $_POST['paciente'] ?? '';
$selected_medico = $_POST['medico'] ?? '';
$selected_date = $_POST['data'] ?? ''; // formato YYYY-MM-DD
$selected_time = $_POST['hora'] ?? ''; // formato HH:MM

// constante de horários: 08:00 até 17:00 (horas cheias)
$hours = [];
for ($h = 8; $h <= 17; $h++) {
    $hours[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
}

// função que retorna horários ocupados para médico+data
function get_booked_hours($pdo, $medico_id, $date)
{
    $sql = "SELECT TIME(data_hora) as hora FROM agendamento WHERE medico_id = ? AND DATE(data_hora) = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$medico_id, $date]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    // format: HH:MM:SS or HH:MM:SS -> convert to HH:MM
    $res = [];
    foreach ($rows as $r) {
        $res[] = substr($r, 0, 5);
    }
    return $res;
}

// === SALVAR AGENDAMENTO ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    // Validar campos
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
    if (empty($errors) && $dt < $today) {
        $errors[] = "Escolha uma data futura.";
    }


    if (empty($errors) && !in_array($hora, $hours)) {
        $errors[] = "Horário inválido.";
    }

    // validar disponibilidade (não pode haver agendamento para mesmo médico+data+hora)
    if (empty($errors)) {
        $date_str = $data;
        $datetime_str = $data . ' ' . $hora . ':00'; // YYYY-MM-DD HH:MM:00
        $sql = "SELECT COUNT(*) FROM agendamento WHERE medico_id = ? AND data_hora = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$medico, $datetime_str]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $errors[] = "Horário não disponível para o médico selecionado.";
        }
    }

    // inserir
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO agendamento (paciente_id, medico_id, data_hora, status) VALUES (?, ?, ?, 'Agendado')");
            if ($stmt->execute([$paciente, $medico, $datetime_str])) {
                header("Location: agendamentos.php?cadastro=true");
                exit;
            } else {
                $errors[] = "Erro ao salvar agendamento.";
            }
        } catch (Exception $e) {
            $errors[] = "Erro ao salvar: " . $e->getMessage();
        }
    }
}

// Se vier do passo "mostrar horários" (selecionou médico+data), vamos buscar horários livres
$available_hours = [];
if (!empty($selected_medico) && !empty($selected_date)) {
    $booked = get_booked_hours($pdo, $selected_medico, $selected_date); // ex: ["09:00","10:00"]
    foreach ($hours as $h) {
        if (!in_array($h, $booked))
            $available_hours[] = $h;
    }
}

?>

<h2>Novo Agendamento</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $er)
            echo "<div>" . htmlspecialchars($er) . "</div>"; ?>
    </div>
<?php endif; ?>

<form method="post">
    <!-- passo 1: selecionar paciente, medico e data -->
    <div class="mb-3">
        <label class="form-label">Paciente</label>
        <select name="paciente" class="form-select" required>
            <option value="">-- selecione --</option>
            <?php foreach ($pacientes as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $selected_paciente == $p['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Médico</label>
        <select name="medico" class="form-select" required>
            <option value="">-- selecione --</option>
            <?php foreach ($medicos as $m): ?>
                <option value="<?= $m['id'] ?>" <?= $selected_medico == $m['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Data (somente dias futuros)</label>
        <input type="date" name="data" value="<?= htmlspecialchars($selected_date) ?>" class="form-control" required
            min="<?= date('Y-m-d') ?>">
    </div>

    <div class="mb-3">
        <!-- botão para recarregar a página e exibir horários disponíveis -->
        <button class="btn btn-secondary" type="submit" name="action" value="show_times">Mostrar horários
            disponíveis</button>
    </div>

    <?php if (!empty($available_hours)): ?>
        <hr>
        <h5>Horários disponíveis em <?= date('d/m/Y', strtotime($selected_date)) ?> para o médico selecionado</h5>

        <div class="mb-3">
            <label class="form-label">Escolha o horário</label>
            <select name="hora" class="form-select" required>
                <option value="">-- selecione --</option>
                <?php foreach ($available_hours as $ah): ?>
                    <option value="<?= $ah ?>"><?= $ah ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <!-- ao salvar, enviamos action=save -->
            <button class="btn btn-primary" type="submit" name="action" value="save">Salvar Agendamento</button>
            <a href="agendamentos.php" class="btn btn-secondary">Cancelar</a>
        </div>
    <?php else: ?>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'show_times'): ?>
            <div class="alert alert-warning">Nenhum horário disponível para esse dia e médico.</div>
        <?php endif; ?>
    <?php endif; ?>
</form>

<?php require("rodape.php"); ?>
<?php
require("cabecalho.php");
require("conexao.php");

$medicos = $pdo->query("SELECT id, nome FROM medico ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$selected_medico = $_POST['medico'] ?? '';
$selected_date = $_POST['data'] ?? '';

$hours = [];
for ($h = 8; $h <= 17; $h++)
  $hours[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';

$available_hours = [];
if (!empty($selected_medico) && !empty($selected_date)) {
  // pegar horas ocupadas
  $stmt = $pdo->prepare("SELECT TIME(data_hora) as hora FROM agendamento WHERE medico_id = ? AND DATE(data_hora) = ?");
  $stmt->execute([$selected_medico, $selected_date]);
  $booked = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
  $booked_clean = [];
  foreach ($booked as $b)
    $booked_clean[] = substr($b, 0, 5);
  foreach ($hours as $h)
    if (!in_array($h, $booked_clean))
      $available_hours[] = $h;
}
?>

<h2>Horários disponíveis</h2>

<form method="post" class="row g-2 mb-3">
  <div class="col-md-5">
    <label class="form-label">Médico</label>
    <select name="medico" class="form-select" required>
      <option value="">-- selecione --</option>
      <?php foreach ($medicos as $m): ?>
        <option value="<?= $m['id'] ?>" <?= $selected_medico == $m['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($m['nome']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-4">
    <label class="form-label">Data</label>
    <input type="date" name="data" class="form-control" value="<?= htmlspecialchars($selected_date) ?>"
      min="<?= date('Y-m-d') ?>" required>
  </div>

  <div class="col-md-3 align-self-end">
    <button class="btn btn-primary" type="submit">Buscar</button>
    <a href="agendamentos.php" class="btn btn-outline-secondary">Agendar horário</a>
    <!-- botão que redireciona para novo agendamento -->
  </div>
</form>

<?php if ($selected_medico && $selected_date): ?>

  <?php
  $medicoNome = '';
  foreach ($medicos as $m) {
    if ($m['id'] == $selected_medico) {
      $medicoNome = $m['nome'];
      break;
    }
  }
  ?>

  <h5>Horários disponíveis para <?= htmlspecialchars($medicoNome) ?> em <?= date('d/m/Y', strtotime($selected_date)) ?>
</h5>


  <?php if (!empty($available_hours)): ?>
    <ul>
      <?php foreach ($available_hours as $ah): ?>
        <li><?= $ah ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <div class="alert alert-warning">Nenhum horário disponível nesta data.</div>
  <?php endif; ?>
<?php endif; ?>

<?php require("rodape.php"); ?>
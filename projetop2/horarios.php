<?php
require("cabecalho.php");
require("conexao.php");

try {
  $stmt = $pdo->query("SELECT h.*, p.nome AS paciente, m.nome AS medico
                        FROM horario h
                        INNER JOIN paciente p ON h.paciente_id = p.id
                        INNER JOIN medico m ON h.medico_id = m.id");
  $dados = $stmt->fetchAll();
} catch (Exception $e) {
  echo "Erro ao carregar dados: " . $e->getMessage();
}

if (isset($_GET['cadastro'])) {
  echo $_GET['cadastro'] == "true" ? "<p class='text-success'>Cadastro realizado!</p>" : "<p class='text-danger'>Erro ao cadastrar!</p>";
}
if (isset($_GET['editar'])) {
  echo $_GET['editar'] == "true" ? "<p class='text-success'>Registro atualizado!</p>" : "<p class='text-danger'>Erro ao editar!</p>";
}
if (isset($_GET['excluir'])) {
  echo $_GET['excluir'] == "true" ? "<p class='text-success'>Registro excluído!</p>" : "<p class='text-danger'>Erro ao excluir!</p>";
}
?>

<h2>Horários Agendados</h2>

<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Paciente</th>
    <th>Médico</th>
    <th>Data e Hora</th>
    <th>Ações</th>
  </tr>

  <?php foreach ($dados as $d): ?>
    <tr>
      <td><?= $d['id'] ?></td>
      <td><?= $d['paciente'] ?></td>
      <td><?= $d['medico'] ?></td>
      <td><?= date("d/m/Y H:i", strtotime($d['data_atendimento'])) ?></td>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require("rodape.php"); ?>
<?php
require("cabecalho.php");
require("conexao.php");

try {
  $stmt = $pdo->query("SELECT * FROM paciente");
  $pacientes = $stmt->fetchAll();
} catch (Exception $e) {
  echo "<p class='text-danger'>Erro ao consultar: " . $e->getMessage() . "</p>";
}

// mensagens de feedback
if (isset($_GET['cadastro']) && $_GET['cadastro']) {
  echo "<p class='text-success'>Cadastro realizado!</p>";
} elseif (isset($_GET['cadastro'])) {
  echo "<p class='text-danger'>Erro ao cadastrar!</p>";
}

if (isset($_GET['editar']) && $_GET['editar']) {
  echo "<p class='text-success'>Registro atualizado!</p>";
} elseif (isset($_GET['editar'])) {
  echo "<p class='text-danger'>Erro ao atualizar!</p>";
}

if (isset($_GET['excluir']) && $_GET['excluir']) {
  echo "<p class='text-success'>Registro excluído!</p>";
} elseif (isset($_GET['excluir'])) {
  echo "<p class='text-danger'>Erro ao excluir!</p>";
}
?>

<h2>Pacientes</h2>
<a href="novo_paciente.php" class="btn btn-success mb-3">Novo Paciente</a>

<table class="table table-hover table-striped">
  <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Data Nasc.</th>
        <th class="no-print">Ações</th>
    </tr>
</thead>

  <tbody>
    <?php foreach ($pacientes as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nome'] ?></td>
        <td><?= $p['telefone'] ?></td>
        <td class="d-flex gap-2">
          <a href="editar_paciente.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
          <a href="consultar_paciente.php?id=<?= $p['id'] ?>" class="btn btn-info btn-sm">Consultar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require("rodape.php"); ?>
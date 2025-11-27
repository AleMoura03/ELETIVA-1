<?php
require("cabecalho.php");
require("conexao.php");

try {
    $sql = "
        SELECT 
            a.id,
            p.nome AS paciente,
            m.nome AS medico,
            a.data_hora,
            a.status
        FROM agendamento a
        INNER JOIN paciente p ON p.id = a.paciente_id
        INNER JOIN medico m ON m.id = a.medico_id
        ORDER BY a.data_hora ASC
    ";
    $stmt = $pdo->query($sql);
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<p class='text-danger'>Erro ao consultar agendamentos: " . htmlspecialchars($e->getMessage()) . "</p>";
    require("rodape.php");
    exit;
}

if (isset($_GET['cadastro']))
    echo $_GET['cadastro'] == 'true' ? "<p class='text-success'>Agendamento realizado!</p>" : "<p class='text-danger'>Erro ao cadastrar!</p>";
if (isset($_GET['editar']))
    echo $_GET['editar'] == 'true' ? "<p class='text-success'>Registro editado!</p>" : "<p class='text-danger'>Erro ao editar!</p>";
if (isset($_GET['excluir']))
    echo $_GET['excluir'] == 'true' ? "<p class='text-success'>Registro excluído!</p>" : "<p class='text-danger'>Erro ao excluir!</p>";
?>

<h2>Agendamentos</h2>
<a href="novo_agendamento.php" class="btn btn-success mb-3">Novo Agendamento</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Data</th>
            <th>Hora</th>
            <th class="no-print">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($agendamentos): ?>
            <?php foreach ($agendamentos as $a):
                $dt = strtotime($a['data_hora']); ?>
                <tr>
                    <td><?= $a['id'] ?></td>
                    <td><?= htmlspecialchars($a['paciente']) ?></td>
                    <td><?= htmlspecialchars($a['medico']) ?></td>
                    <td><?= date('d/m/Y', $dt) ?></td>
                    <td><?= date('H:i', $dt) ?></td>
                    <td class="d-flex gap-2">
                        <a href="editar_agendamento.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="consultar_agendamento.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Nenhum agendamento registrado ainda.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require("rodape.php"); ?>
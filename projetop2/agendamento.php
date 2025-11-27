<?php
require("cabecalho.php");
require("conexao.php");

try {
    $stmt = $pdo->query("
        SELECT a.id, p.nome AS paciente, m.nome AS medico, h.data_atendimento, a.status
        FROM agendamento a
        INNER JOIN paciente p ON a.paciente_id = p.id
        INNER JOIN horario h ON a.horario_id = h.id
        INNER JOIN medico m ON h.medico_id = m.id
    ");
    $dados = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

// Mensagens padrão
function alert($param, $trueText, $falseText)
{
    if (isset($_GET[$param])) {
        echo $_GET[$param] == "true"
            ? "<p class='text-success'>$trueText</p>"
            : "<p class='text-danger'>$falseText</p>";
    }
}

alert("cadastro", "Agendamento realizado!", "Erro ao cadastrar!");
alert("editar", "Agendamento atualizado!", "Erro ao editar!");
alert("excluir", "Agendamento excluído!", "Erro ao excluir!");
?>

<h2>Agendamentos</h2>
<a href="novo_agendamento.php" class="btn btn-success mb-3">Novo Agendamento</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Data</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($dados as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['paciente'] ?></td>
            <td><?= $d['medico'] ?></td>
            <td><?= date("d/m/Y H:i", strtotime($d['data_atendimento'])) ?></td>
            <td><?= $d['status'] ?></td>
            <td>
                <a href="editar_agendamento.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="consultar_agendamento.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">Consultar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require("rodape.php"); ?>
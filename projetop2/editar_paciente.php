<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM paciente WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $data_nascimento = !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null;
    $id = intval($_POST['id']);

    try {
        $stmt = $pdo->prepare("UPDATE paciente SET nome = ?, telefone = ?, data_nascimento = ? WHERE id = ?");
        if ($stmt->execute([$nome, $telefone, $data_nascimento, $id])) {
            header("location: pacientes.php?editar=true");
            exit;
        } else {
            header("location: pacientes.php?editar=false");
            exit;
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<h1>Editar Paciente</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($paciente['id']) ?>">

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($paciente['nome']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($paciente['telefone']) ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Data de Nascimento</label>
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($paciente['data_nascimento']) ?>"
            class="form-control">
    </div>

    <button class="btn btn-primary" type="submit">Salvar</button>
    <a href="pacientes.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("rodape.php"); ?>
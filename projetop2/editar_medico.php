<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM medico WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $medico = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar: " . $e->getMessage() . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("UPDATE medico SET nome = ?, especialidade = ? WHERE id = ?");
        if ($stmt->execute([$nome, $especialidade, $id])) {
            header("location: medicos.php?editar=true");
        } else {
            header("location: medicos.php?editar=false");
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro: ".$e->getMessage()."</p>";
    }
}
?>

<h1>Editar Médico</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $medico['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" value="<?= $medico['nome'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Especialidade</label>
        <input type="text" name="especialidade" value="<?= $medico['especialidade'] ?>" class="form-control" required>
    </div>

    <button class="btn btn-primary" type="submit">Salvar</button>
    <a href="medicos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("rodape.php"); ?>

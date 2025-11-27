<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    try {
        $stmt = $pdo->prepare("INSERT INTO medico (nome, especialidade) VALUES (?, ?)");
        if ($stmt->execute([$nome, $especialidade])) {
            header("location: medicos.php?cadastro=true");
        } else {
            header("location: medicos.php?cadastro=false");
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro: " . $e->getMessage() . "</p>";
    }
}
?>

<h1>Novo Médico</h1>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Especialidade</label>
        <input type="text" name="especialidade" class="form-control" required>
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a href="medicos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("rodape.php"); ?>
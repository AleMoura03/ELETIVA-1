<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $data_nascimento = !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null;

    try {
        $stmt = $pdo->prepare("INSERT INTO paciente (nome, telefone, data_nascimento) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $telefone, $data_nascimento])) {
            header("location: pacientes.php?cadastro=true");
            exit;
        } else {
            header("location: pacientes.php?cadastro=false");
            exit;
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<h1>Novo Paciente</h1>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Nascimento</label>
        <input type="date" name="data_nascimento" class="form-control">
    </div>
    <button class="btn btn-primary" type="submit">Salvar</button>
    <a href="pacientes.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("rodape.php"); ?>
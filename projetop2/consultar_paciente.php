<?php
require("cabecalho.php");
require("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $pdo->prepare("SELECT * FROM paciente WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar: " . $e->getMessage() . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM paciente WHERE id = ?");
        if ($stmt->execute([$id])) {
            header("location: pacientes.php?excluir=true");
        } else {
            header("location: pacientes.php?excluir=false");
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao excluir: " . $e->getMessage() . "</p>";
    }
}
?>

<h1>Consultar Paciente</h1>

<form method="POST">
    <input type="hidden" name="id" value="<?= $paciente['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" value="<?= $paciente['nome'] ?>" class="form-control" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" value="<?= $paciente['telefone'] ?>" class="form-control" disabled>
    </div>

    <p class="text-danger fw-bold">Deseja excluir este registro?</p>

    <button class="btn btn-danger" type="submit">Excluir</button>
    <a href="pacientes.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("rodape.php"); ?>
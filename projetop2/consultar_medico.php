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
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM medico WHERE id = ?");
        if ($stmt->execute([$id])) {
            header("location: medicos.php?excluir=true");
        } else {
            header("location: medicos.php?excluir=false");
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao excluir: " . $e->getMessage() . "</p>";
    }
}
?>

<h1>Consultar Médico</h1>

<form method="POST">
    <input type="hidden" name="id" value="<?= $medico['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" value="<?= $medico['nome'] ?>" class="form-control" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Especialidade</label>
        <input type="text" value="<?= $medico['especialidade'] ?>" class="form-control" disabled>
    </div>

    <p class="text-danger fw-bold">Deseja excluir este registro?</p>

    <button class="btn btn-danger" type="submit">Excluir</button>
    <a href="medicos.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("rodape.php"); ?>
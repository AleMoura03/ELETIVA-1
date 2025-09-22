<?php

include("cabecalho.php");
?>
<form method="post">
    <div class="mb-3">
        <label for="valor1" class="form-label">1º valor</label>
        <input type="number" id="valor1" name="valor1" class="form-control" required="" step="any">
    </div>
    <div class="mb-3">
        <label for="valor2" class="form-label">2º valor</label>
        <input type="number" id="valor2" name="valor2" class="form-control" required="" step="any">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $soma = $valor1 + $valor2;
    if ($valor1 == $valor2) {
        $mult = $soma * 3;
        echo "<p> Os valores são iguais, o triplo da soma é: $mult</p>";
    } else {
        echo "<p>A soma dos valors é $soma</p>";
    }
}
?>

<?php
include("rodape.php");
?>
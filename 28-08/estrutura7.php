<?php
include("cabecalho.php");
?>
<form method="post">
    <div class="mb-3">

        <label for="valor1" class="form-label">Informe o número</label>
        <input type="number" id="valor1" name="valor1" class="form-control" required="">

    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor1 = $_POST['valor1'];
        $i = 1;
        $soma = 0;

    while ($i <= $valor1){
        $soma += $i;
        $i++;
    }
    echo "<p>A soma de todos os números de 1 até $valor1 é: $soma</p>";
}
?>
<?php
include("rodape.php");
?>
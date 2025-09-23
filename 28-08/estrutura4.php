<?php
    include("cabecalho.php");
?>
<form method="post">
    <div class="mb-3">
        <label for="valor1" class="form-label">Digite o valor do produto</label>
        <input type="number" id="valor1" name="valor1" class="form-control" required="" step="any">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor1 = $_POST['valor1'];
        if($valor1 > 100){
            $desconto = $valor1 - (15 / 100);
            $descontoFormatado = number_format($desconto,2,",",".");
            echo "<p>O novo valor com desconto é: R$ $descontoFormatado </p>";
        } else {
            echo "<p>Não há desconto para este produto</p>";
        }
    }
?>
<?php
    include("rodape.php");
?>
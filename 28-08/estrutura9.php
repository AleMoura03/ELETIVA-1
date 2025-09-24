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
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valor1 = $_POST['valor1'];
        $fatorial = 1;
    for ($i = $valor1; $i >= 1; $i--) {
        $fatorial *= $i;
    }
        echo "<p>O fatorial de $valor1 é: $fatorial</p>";
        
        
    }
    ?>
<?php
include("rodape.php");
?>
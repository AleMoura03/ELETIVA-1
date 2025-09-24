<?php
include("cabecalho.php");
?>
<form method="post">
    <div class="mb-3">
        
        <label for="valor1" class="form-label">Informe o número</label>
        <input type="number" id="valor1" name="valor1" class="form-control" required min="0">
        
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valor1 = $_POST['valor1'];
        echo "<h3>A tabuada de $valor1 é: </h3>";

        for ($i = 1; $i <= 10; $i++){
            $tabuada = $valor1 * $i;
            echo "$valor1 x $i = $tabuada<br>";

        }
       
    }
    ?>

<?php
include("rodape.php");
?>
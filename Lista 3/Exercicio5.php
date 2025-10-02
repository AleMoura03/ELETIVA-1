<?php 
include('cabecalho.php') 
?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercício 5</h1>
    <p class='text-center'>Descubra a raíz quadrada de um número</p>
    <form method="post">
        <div class="mb-3">
            <label for="numero" class="form-label"></label>
            <input type="number" id="numero" name="numero" class="form-control" required="" placeholder="Insira aqui o número">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    function raizquadrada($numero){
        echo "<p class='text-center'>A raíz de ".$numero." é ".sqrt($numero).".</p>";
    }
    raizquadrada($numero);
}
?>
<?php
include('rodape.php') 
?>
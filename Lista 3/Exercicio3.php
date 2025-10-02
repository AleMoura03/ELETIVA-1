<?php 
include('cabecalho.php')
?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercício 3</h1>
    <p class='text-center'>Confira se uma palavra está contida na frase</p>
    <form method="post">
        <div class="mb-3">
            <label for="palavra1" class="form-label">Frase: </label>
            <input type="text" id="frase" name="frase" class="form-control" required="" placeholder="Insira a frase aqui">
        </div>
        <div class="mb-3">
            <label for="palavra2" class="form-label">Palavra </label>
            <input type="text" id="palavra" name="palavra" class="form-control" required="" placeholder="Insira a palavra aqui">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Verificar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $frase = $_POST['frase'];
    $palavra = $_POST['palavra'];
    function contem($frase, $palavra){
        if (str_contains($frase, $palavra)){
            echo "<p class='text-center'> A palavra '{$palavra}' está contida na frase '{$frase}'.</p>";
        } else{
            echo "<p class='text-center'> A palavra '{$palavra}' não está contida na frase '{$frase}'.</p>";
        }
    }
    contem($frase, $palavra);
}
?>


<?php
include('rodape.php') 
?>
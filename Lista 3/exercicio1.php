<?php 
include('cabecalho.php') 
?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercício 1</h1>
    <p class='text-center'>Contador de caracteres</p>
    <form method="post">
        <div class="mb-3">
            <label for="palavra" class="form-label"></label>
            <input type="text" id="palavra" name="palavra" class="form-control" required=""
                placeholder="Insira aqui a palavra">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['palavra'];
    function contarcaracteres($texto)
    {
        echo "<p class='text-center'> O número de caracteres da palavra " . $texto . " é " . mb_strlen($texto) . "</p>";
    }
    contarcaracteres($texto);

}
?>
<?php
include('rodape.php') 
?>
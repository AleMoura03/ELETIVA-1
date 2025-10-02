<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercício 5</h1>
    <p class='text-center'>Estoque de livros</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p class="text-center fw-bold">Livro <?= $i ?></p>
            <div class="row inline-row mb-3">
                <div class="col-md-8">
                    <label for="nome<?= $i ?>" class="form-label">Nome do livro</label>
                    <input type="text" id="nome<?= $i ?>" name="nomes[]" class="form-control" required="" placeholder="Insira o nome do livro">
                </div>
                <div class="col-md-4">
                    <label for="estoque<?= $i ?>" class="form-label">Quantidade em estoque</label>
                    <input type="number" id="estoque<?= $i ?>" name="estoques[]" class="form-control" required="" placeholder="Insira o estoque">
                </div>
            </div>
        <?php endfor; ?>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nomes'];
    $estoques = $_POST['estoques'];
    $listaestoque = [];
    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $estoque = $estoques[$i];
        $listaestoque[$nome] = $estoque;
        if($estoque<5){
            echo "<p class='text-danger text-center'>O livro {$nome} está com o estoque baixo ({$estoque} unidades).</p>";
        }
    }

    ksort($listaestoque);
    echo "<p class='text-center fw-bold'>Estoque de livros</p>";
    foreach ($listaestoque as $nome => $estoque) {
        echo "<p class='text-center'>Livro: {$nome} - Quantidade: {$estoque}<p>";
    }
}
include('rodape.php') ?>
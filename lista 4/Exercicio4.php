<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-6 border ">
    <h1 class='text-center'>Exercício 4</h1>
    <p class='text-center'>Lista de itens para aplicar imposto de 15%</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p class="text-center fw-bold">Item <?= $i ?></p>
            <div class="row inline-row mb-3">
                <div class="col-md-8">
                    <label for="nome<?= $i ?>" class="form-label">Nome</label>
                    <input type="text" id="nome<?= $i ?>" name="nomes[]" class="form-control" required="" placeholder="Insira o item">
                </div>
                <div class="col-md-4">
                    <label for="preco<?= $i ?>" class="form-label">Preço</label>
                    <input type="number" id="preco<?= $i ?>" name="precos[]" class="form-control" required="" placeholder="Insira o preço" step="any">
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
    $precos = $_POST['precos'];
    $itens = [];
    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $preco = $precos[$i] + ($precos[$i] * 0.15);
        $itens[$nome] = $preco;
    }

    asort($itens);
    echo "<p class='text-center fw-bold'>Lista de itens</p>";
    foreach ($itens as $nome => $preco) {
        echo "<p class='text-center'>".$nome. " - R$".number_format($preco, 2, ',', '.')."<p>";
    }
}
include('rodape.php') ?>
<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercício 3</h1>
    <p class='text-center'>Lista de produtos</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p class="text-center">PRODUTO <?= $i ?></p>
            <div class="row inline-row mb-3">
                <div class="col-md-2"> 
                    <label for="codigos<?=$i?>" class="form-label">Código</label>
                    <input type="number" id="codigos<?=$i?>" name="codigos[]" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="nomes<?=$i?>" class="form-label">Nome</label>
                    <input type="text" id="nomes<?=$i?>" name="nomes[]" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="precos<?=$i?>" class="form-label">Preço</label>
                    <input type="number" id="precos<?=$i?>" name="precos[]" class="form-control">
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
    $codigos = $_POST['codigos'];
    $nomes = $_POST['nomes'];
    $precos = $_POST['precos'];
    $produtos = [];

    for ($i = 0; $i < 5; $i++) {
        $codigo = $codigos[$i];
        $nome = $nomes[$i];
        $preco = (float)$precos[$i];
        if (isset($produtos[$codigo])) {
            echo "<p class='text-danger text-center'>O código {$codigo[$i]} e/ou {$nome[$i]} já foi registrado, portanto elimina-se os repetidos.</p>";
        } else {
            if ($preco > 100) {
                $preco = $preco * 0.9;
                $produtos[$codigo] = ['nome' => $nome, 'preco' => $preco];
            } else {
                $produtos[$codigo] = ['nome' => $nome, 'preco' => $preco];
            }
        }
    }

    uasort($produtos, function ($a, $b) {
        return strcmp($a['nome'], $b['nome']);
    });

    echo "<p class='text-center fw-bold'>Lista de produtos</p>";
    foreach ($produtos as $codigo => $atributos) {
        echo "<p class='text-center'>Código: $codigo | Nome: {$atributos['nome']} | Preço: R$ " . number_format($atributos['preco'], 2, ',', '.') . "</p>";
    }
}
include('rodape.php') ?>
<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-10 border ">
    <h1 class='text-center'>Exercício 2</h1>
    <p class='text-center'>Calcule a média dos alunos.</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p> - Aluno <?= $i ?> - </p>
            <div class="row inline-row mb-3">
                <div class="col-md-9">
                    <label for="nomes<?=$i?>" class="form-label">Nome</label>
                    <input type="text" id="nomes<?=$i?>" name="nomes[]" class="form-control">
                </div>
                <div class="col-md-1">
                    <label for="nota1<?=$i?>" class="form-label">Nota 1</label>
                    <input type="number" id="nota1<?=$i?>" name="nota1[]" class="form-control" step="any">
                </div>
                <div class="col-md-1">
                    <label for="nota2<?=$i?>" class="form-label">Nota 2</label>
                    <input type="number" id="nota2<?=$i?>" name="nota2[]" class="form-control" step="any">
                </div>
                <div class="col-md-1">
                    <label for="nota3<?=$i?>" class="form-label">Nota 3</label>
                    <input type="number" id="nota3<?=$i?>" name="nota3[]" class="form-control" required="" step="any">
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
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $alunos = [];

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $media = (($nota1[$i]+$nota2[$i]+$nota3[$i])/3);

        if (isset($alunos[$nome])){
            echo "<p class='text-danger text-center'>O aluno {$nome} foi inserido mais de uma vez e registrado apenas a primeira.</p>";
        } else {
            $alunos[$nome] = $media;
        }
    }

    arsort($alunos);
    echo "<p class='text-center fw-bold'>Lista (Aluno e nota)</p>";
    foreach ($alunos as $nome => $media) {
        echo "<p class='text-center'>{$nome} - " . number_format($media, 2, ',', '.') . "</p>";
    }
}
include('rodape.php') ?>
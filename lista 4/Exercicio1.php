<?php include('cabecalho.php') ?>
<div class="container py-3 col-md-4 border ">
    <h1 class='text-center'>Exercício 1</h1>
    <p class='text-center'>Lista de contatos.</p>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <p class="text-center"> Contato <?= $i ?></p>
            <div class="mb-3">
                <label for="nome<?=$i?>" class="form-label">Nome:</label>
                <input type="text" id="nome<?=$i?>" name="nomes[]" class="form-control" required="" placeholder="Insira o nome">
            </div>
            <div class="mb-3">
                <label for="telefone<?=$i?>" class="form-label">Telefone:</label>
                <input type="number" id="telefone<?=$i?>" name="telefones[]" class="form-control" required="" placeholder="Insira o telefone">
            </div>
        <?php endfor; ?>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nomes'];
    $telefones = $_POST['telefones'];
    $contatos = [];

    for ($i=0; $i<5; $i++) {
        $nome = $nomes[$i];
        $telefone = $telefones[$i];

        if (isset($contatos[$nome]) or in_array($telefone, $contatos)) {
            echo "<p class='text-danger text-ce'>Contato com dado duplicado (não adicionado) - Nome:{$nome} // Telefone {$telefone}</p>";
        } else {
            $contatos[$nome] = $telefone;
        }
    }

    ksort($contatos);
    echo "<p class='text-center fw-bold'>Lista de contatos</p>";
    foreach ($contatos as $nome => $telefone) {
        echo "<p class='text-center'>{$nome} - {$telefone}<p>";
    }
}
include('rodape.php') 
?>
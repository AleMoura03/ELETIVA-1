<?php 
    include('cabecalho.php') 
?>
<div class="container py-3 col-md-8 border ">
    <h1 class='text-center'>Exercício 4</h1>
    <p class='text-center'>Formatador de data</p>
    <form method="post">
        <div class="mb-3">
            <label for="dia" class="form-label">Dia (01-31)</label>
            <input type="number" id="dia" name="dia" class="form-control" required="" placeholder="Insira o dia (com 2 dígitos)">
        </div>
        <div class="mb-3">
            <label for="mes" class="form-label">Mês (01-12)</label>
            <input type="number" id="mes" name="mes" class="form-control" required="" placeholder="Insira o mês (com 2 dígitos)">
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano (0000-9999)</label>
            <input type="number" id="ano" name="ano" class="form-control" required="" placeholder="Insira o ano (com 4 dígitos)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    function ajuste($dia, $mes, $ano)
    {
        if (strlen($dia)<2 or strlen($mes)<2 or strlen($ano)<4) {
            echo "<p class='text-center'>Por favor, insira a quantidade correta de dígitos por campo.</p>";
        } else {
            if (checkdate($mes, $dia, $ano)) {
                $data_formatada = sprintf("%02d/%02d/%04d", $dia, $mes, $ano);
                echo "<p class='text-center'>$data_formatada</p>";
            } else {
                echo "<p class=text-center>Algo de errado aconteceu! Veja se a data preenchida realmente existe.</p>";
            }
        }
    }
    ajuste($dia, $mes, $ano);
}
?>
<?php
include('rodape.php') 
?>
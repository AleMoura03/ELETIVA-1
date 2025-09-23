<?php
    include("cabecalho.php");
?>
<form method="post">
    <div class="mb-3">
        <label for="valor1" class="form-label">Digite o número do mês (1 - 12)</label>
        <input type="number" id="valor1" name="valor1" class="form-control" min="1" max="12" required="">
    </div>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor1 = $_POST['valor1'];
        switch ($valor1){
            case 1:
                $nomeMes = "Janeiro";
                break;
            case 2:
                $nomeMes = "Fevereiro";
                break;
            case 3:
                $nomeMes = "Março";
                break;
             case 4:
                $nomeMes = "Abril";
                break;
            case 5:
                $nomeMes = "Maio";
                break;
            case 6:
                $nomeMes = "Junho";
                break;
             case 7:
                $nomeMes = "Julho";
                break;
            case 8:
                $nomeMes = "Agosto";
                break;
            case 9:
                $nomeMes = "Setembro";
                break;
             case 10:
                $nomeMes = "Outubro";
                break;
            case 11:
                $nomeMes = "Novembro";
                break;
            case 12:
                $nomeMes = "Dezembro";
                break;
            default:
                $nomeMes = "<p> Número inválido. Digite um valor entre 1 e 12.</p>";
                break;
        }
        echo "<p>O mês correspondente ao número $valor1 é: $nomeMes</p>";
    }
    ?>
<?php
    include("rodape.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 18</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 18</h1>
         <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Digite o capital</label>
                <input type="number" id="valor1" name="valor1" class="form-control" required="" step="any">
            </div>
            <div class="mb-3">
                <label for="valor2" class="form-label">Digite a taxa de juros</label>
                <input type="number" id="valor2" name="valor2" class="form-control" required="" step="any">
                <select name="tipoTaxa" class="form-select mt-2">
                    <option value="aa">ao ano (a.a)</option>
                    <option value="am">ao mês (a.m)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="valor3" class="form-label">Digite o período</label>
                <input type="number" id="valor2" name="valor3" class="form-control" required="" step="any">
                <select name="tipoPeriodo" class="form-select mt-2">
                    <option value="anos">anos</option>
                    <option value="meses">meses</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $capital = $_POST['valor1'];
            $taxa = $_POST['valor2'];
            $tempo = $_POST['valor3'];
            $tipoTaxa = $_POST['tipoTaxa'];
            $tipoPeriodo = $_POST['tipoPeriodo'];
            if($capital < 0 || $taxa < 0 || $tempo < 0){
                echo "<div class='alert alert-danger mt-3>Insira valores não negativos para as 3 opções.</div>";
            } else {
                $taxaDecimal = $taxa / 100;

            if($tipoTaxa === 'aa'){
                if($tipoPeriodo === 'anos'){
                    $i = $taxaDecimal;
                    $n = $tempo;
                    $periodo_label = 'ano(s)';
        }else {
            $i = $taxaDecimal / 12;
            $n = $tempo;
            $periodo_label = 'mês(es)';
        }
    }else{
        if($tipoPeriodo === 'meses'){
            $i = $tacaDecimal;
            $n = $tempo;
            $periodo_label = 'mês(es)';
        }else{
            $i = $taxaDecimal;
            $n = $tempo * 12;
            $periodo_label = 'mês(es)';
        }
    }
    $montante = $capital * pow(1 + $i, $n);
    $juros = $montante - $capital;

    $capitalF = number_format($capital,2,",",".");
    $jurosF = number_format($juros, 2, ",",".");
    $montanteF = number_format($montante, 2, ",",".");

                echo "<div class='alert alert-success mt-3'>";
                echo "<p>Capital: R$ {$capitalF}</p>";
                echo "<p>Taxa por período considerada (decimal): <strong>" . number_format($i * 100, 6, ",", ".") . "%</strong></p>";
                echo "<p>Número de períodos (n): <strong>{$n}</strong> {$periodo_label}</p>";
                echo "<hr>";
                echo "<p>Juros compostos acumulados: <strong>R$ {$jurosF}</strong></p>";
                echo "<p>Montante (capital + juros): <strong>R$ {$montanteF}</strong></p>";
                echo "</div>";
            }
        }
?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
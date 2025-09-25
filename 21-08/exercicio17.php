<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 17</h1>
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $capital =$_POST['valor1'];
                $taxa = $_POST['valor2'];
                $tempo = $_POST['valor3'];
                $tipoTaxa = $_POST['tipoTaxa'];
                $tipoPeriodo = $_POST['tipoPeriodo'];
                if($tipoTaxa == "am" && $tipoPeriodo == "anos"){
                    $tempo = $tempo * 12;
                }
                if($tipoTaxa == "aa" && $tipoPeriodo == "meses"){
                    $taxa = $taxa / 12;
                }
                $taxaDecimal = $taxa / 100;
                $juros = $capital * $taxaDecimal * $tempo;
                $jurosFormatado = number_format($juros,2,",",".");
                $montante = $capital + $juros;
                $montanteFormatado = number_format($montante,2,",",".");
                echo "<p>Juros: R$ {$jurosFormatado}</p>";
                echo "<p>Montante (capital + juros): R$ {$montanteFormatado}</p>";

                
            }

?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
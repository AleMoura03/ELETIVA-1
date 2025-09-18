<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 15</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 15 - Calculardor de IMC</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Informe seu peso</label>
                <input type="number" id="valor1" name="valor1" class="form-control" required="" step="any">
            </div>
            <div class="mb-3">
                <label for="valor2" class="form-label">Informe sua altura</label>
                <input type="number" id="valor2" name="valor2" class="form-control" required="" step="any">
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = str_replace(',','.', $_POST["valor1"]);
            $valor2 = str_replace(',','.', $_POST["valor2"]);

            if (is_numeric($valor1) && is_numeric($valor2) && $valor1 > 0 && $valor2 >0){
            $calculo = $valor1 / ($valor2 ** 2);
            $calculoFormatado = number_format($calculo, 2, ",", ".");
            echo "<p> O IMC de alguém com peso $valor1 e altura $valor2 é de: $calculoFormatado</p>";
        } else 
        {
            echo "<p>Por favor, insita valores válidos para peso e altura.</p>";
        }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
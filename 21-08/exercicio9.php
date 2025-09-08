<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 9 - Cálculo de área de um círculo</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Digite o raio do círculo</label>
                <input type="number" id="valor1" name="valor1" class="form-control" required="">
            </div>

            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];
            $calculo = ($valor1 ** 2) * 3.14159;
            $calculoFormatado = number_format($calculo,2,",", ".");
            echo "<p> A área de um círculo com raio $valor1 é: $calculoFormatado</p>";

        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
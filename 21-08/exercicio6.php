<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 6</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Digite a temperatura em ºC</label>
                <input type="number" id="valor1" name="valor1" class="form-control" required="">
            </div>
           
            <button type="submit" class="btn btn-primary">Converter</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];
            $multiplicar = ($valor1 * 1.8) + 32;
            echo "<p> Convertendo: $valor1 ºC = $multiplicar ºF</p>";
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
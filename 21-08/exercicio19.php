<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 19</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Exercício 19</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Digite a quantidade de dias</label>
                <input type="number" id="valor1" name="valor1" class="form-control" required min="1" >
            </div>
                        <button type="submit" class="btn btn-primary">Converter</button>
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $valor1 = $_POST['valor1'];
            $horas = $_POST ['valor1'] * 24;
            $minutos = $_POST['valor1'] * 24 * 60;
            $segundos = $_POST['valor1'] * 24 * 60 * 60;
            $horasFormatado = number_format($horas, 0, ",",".");
            $minutosFormatado = number_format($minutos, 0, ",",".");
            $segundosFormatado = number_format($segundos, 0, ",",".");

            echo "<div class='alert alert-sucess mt-3'>";
            echo"<p><strong> $valor1 </strong> Dia(s)correspondem a: </p>";
            echo "<ul>";
            echo "<li><strong> $horasFormatado </strong>horas</li>";
            echo "<li><strong> $minutosFormatado </strong>minutos</li>";
            echo "<li><strong> $segundosFormatado </strong>segundos</li>";
            echo "</ul>";
            echo "</div>";
        }
?>
            
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
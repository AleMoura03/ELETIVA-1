<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Velocidade Média</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h1>Calculadora de Velocidade Média</h1>

  <form method="post">
    <div class="mb-3">
      <label for="distancia" class="form-label">Digite a distância percorrida (em km)</label>
      <input type="number" id="distancia" name="distancia" class="form-control" required step="any" min="0">
    </div>

    <div class="mb-3">
      <label for="tempo" class="form-label">Digite o tempo gasto (em horas)</label>
      <input type="number" id="tempo" name="tempo" class="form-control" required step="any" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Calcular</button>
  </form>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $distancia = $_POST['distancia'];
    $tempo = $_POST['tempo'];

    if ($tempo > 0){
        $velocidade = $distancia / $tempo;
        $velocidadeFormatada = number_format($velocidade,2,",",".");

         echo "<div class='alert alert-success mt-3'>";
          echo "<p>Distância: <strong>{$distancia} km</strong></p>";
          echo "<p>Tempo: <strong>{$tempo} h</strong></p>";
          echo "<p><strong>Velocidade média: {$velocidadeFormatada} km/h</strong></p>";
          echo "</div>";
      } else {
          echo "<div class='alert alert-danger mt-3'>O tempo deve ser maior que zero.</div>";
      }
    }
  
    ?>        
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
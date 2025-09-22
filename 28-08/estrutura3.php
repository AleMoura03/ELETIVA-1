<?php
    include("cabecalho.php");
?>
  <form method="post">
    <div class="mb-3">
        <label for="valorA" class="form-label">Digite o valor A</label>
        <input type="number" id="valorA" name="valorA" class="form-control" required="" step="any">
    </div>
    <div class="mb-3">
        <label for="valorB" class="form-label">Digite o valor B</label>
        <input type="number" id="valorB" name="valorB" class="form-control" required="" step="any">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $valorA = $_POST['valorA'];
    $valorB = $_POST['valorB'];
    if ($valorA == $valorB){
        echo "<p>Os valores são iguais. Valor $valorA</p>";
    }elseif ($valorA > $valorB){
        echo "<p>$valorA, $valorB</p>";
    }else{
        echo "<p>$valorB, $valorA</p>";
    }
  }
?>
  <?php
  include("rodape.php");
  ?>
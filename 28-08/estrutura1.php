
<?php
    include("cabecalho.php");
    ?>

    <form method="post">
      <div class="mb-3">
        <?php for($i=1;$i<=7;$i++): ?>
          <label for="valor[]" class="form-label">Informe <?= $i ?>º valor</label>
          <input type="number" id="valor[]" name="valor[]" class="form-control" step="any">
        <?php endfor; ?>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $valores = $_POST['valor'];
        $menorValor = min($valores);
        $posicao = array_search($menorValor, $valores) + 1;
        echo "<p>O menor valor informado é <strong>$menorValor</strong>.</p>";
        echo "<p>Ele está na posição <strong>$posicao </strong> da sequencia digitada.";
      }
    ?>
<?php
  include("rodape.php");
?>

  
 
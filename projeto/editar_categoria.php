<?php
require("cabecalho.php");
require("conexao.php");
if($SERVER['REQUEST_METHOD'] == "GET"){
    try{
        $stmt = $pdo->prepare("SELECT * from categoria WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(Exception $e){
        echo "Erro ao consultar categoria: ".$e->getMessage();
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    try {
        $stmt =
            $pdo->prepare("INSERT INTO categoria (nome) VALUES (?)");
        if ($stmt->execute([$nome])) {
            header('location: categorias.php?cadastro=true');
        } else {
            header('location: categorias.php?cadastro=false');
        }
    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

    <h1>Nova Categoria</h1>
    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Informe o nome da categoria:</label>
            <input type="text" id="nome" name="nome" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

<?php
require("rodape.php");
?>
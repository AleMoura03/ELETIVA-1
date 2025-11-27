<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<div class="container mt-5">
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require('conexao.php');
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
  try {
    $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senha])) {
      header('location: index.php?cadastro=true');
    } else {
      header('location: index.php?cadastro=false');
    }
  } catch (Exception $e) {
    echo "<p class='text-danger'>Erro: " . $e->getMessage() . "</p>";
  }
}
?>
  <h2 class="mb-4">Cadastro de Usuário</h2>
  <form method="POST">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="index.php" class="btn btn-secondary">Voltar</a>
  </form>
</div>
</body>
</html>

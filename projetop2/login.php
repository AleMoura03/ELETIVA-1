<?php
require_once 'conexao.php';
session_start();

if (isset($_SESSION['acesso']) && $_SESSION['acesso']) {
    header('Location: principal.php');
    exit;
}

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['acesso'] = true;
            $_SESSION['nome'] = $user['nome'];
            header('Location: principal.php');
            exit;
        } else {
            $mensagem = "<p class='text-danger'>Credenciais inválidas!</p>";
        }
    } catch (Exception $e) {
        $mensagem = "<p class='text-danger'>Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Agenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Acesso ao Sistema</h2>

    <?php
    if (isset($_GET['cadastro'])) {
        echo $_GET['cadastro'] === 'true'
            ? "<p class='text-success'>Cadastro realizado com sucesso!</p>"
            : "<p class='text-danger'>Erro ao realizar o cadastro!</p>";
    }
    echo $mensagem;
    ?>

    <form action="index.php" method="POST">
      <div class="mb-3">
        <label for="emailLogin" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Digite seu email" required />
      </div>
      <div class="mb-3">
        <label for="senhaLogin" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senhaLogin" name="senha" placeholder="Digite sua senha" required />
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="mt-3">
      Ainda não tem uma conta?
      <a href="cadastro.php">Cadastre-se aqui</a>
    </p>
  </div>
</body>
</html>

<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: bemvindo.php");
    exit;
}

$host = 'localhost';
$db   = 'seu_banco';
$user = 'seu_usuario';
$pass = 'sua_senha';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $senha_confirm = $_POST['senha_confirm'];

    if (!$nome || !$email || !$senha) {
        $error = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email inválido.";
    } elseif ($senha !== $senha_confirm) {
        $error = "As senhas não conferem.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email já cadastrado.";
        } else {
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            if ($stmt->execute([$nome, $email, $hashSenha])) {
                $_SESSION['usuario'] = [
                    'nome' => $nome,
                    'email' => $email
                ];
                header("Location: bemvindo.php");
                exit;
            } else {
                $error = "Erro ao cadastrar.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro - VerboPlay</title>
    <link rel="stylesheet" href="./stylephp.css" />
</head>
<body>
<div class="container">
    <h2>Cadastro</h2>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Nome completo" required />
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <input type="password" name="senha_confirm" placeholder="Confirme a senha" required />
        <button type="submit">Cadastrar</button>
    </form>
    <a href="login.php">Já tem conta? Login</a>
</div>
</body>
</html>

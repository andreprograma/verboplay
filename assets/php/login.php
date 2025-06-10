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
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (!$email || !$senha) {
        $error = "Preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = [
                'nome' => $user['nome'],
                'email' => $user['email']
            ];
            header("Location: bemvindo.php");
            exit;
        } else {
            $error = "Email ou senha inválidos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Login - VerboPlay</title>
    <link rel="stylesheet" href="./stylephp.css" />
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <button type="submit">Entrar</button>
    </form>
    <a href="cadastro.php">Cadastrar-se</a>
</div>
</body>
</html>

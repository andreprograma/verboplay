<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Usuário - VerboPlay</title>
    <link rel="stylesheet" href="./stylephp.css" />
</head>
<body>
<div class="container" style="text-align:center;">
    <h2>Olá, <?= htmlspecialchars($usuario['nome']) ?></h2>
    <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
    <!-- Se quiser incluir foto, pode fazer upload e armazenar no BD para exibir aqui -->
    <a href="bemvindo.php">Início</a>
    <a href="logout.php">Sair</a>
</div>
</body>
</html>

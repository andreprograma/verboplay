<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$nome = $_SESSION['usuario']['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Bem-vindo - VerboPlay</title>
    <link rel="stylesheet" href="./stylephp.css" />
</head>
<body>
<div class="container" style="text-align:center;">
    <h1>Bem-vindo, <?= htmlspecialchars($nome) ?>!</h1>
    <a href="usuario.php">Prosseguir</a>
    <a href="logout.php">Sair</a>
</div>
</body>
</html>

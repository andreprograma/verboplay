<?php
session_start();
session_destroy();
header("Location: login.php");
exit;

//1 - Criar o banco e tabela MySQL"" com o comando SQL que foi enviado.
//2 - Ajustar os dados de conexão no PHP ($host, $db, $user, $pass).
//3 - Colocar esses arquivos na sua pasta pública do servidor PHP.
//4 - Acessar login.php para fazer login e cadastro.php para cadastrar.
//5 - Testar o fluxo completo.
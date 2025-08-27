<?php
session_start();

$usuario = "Thomás";
$senha = "graduation";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeUser = $_POST['nome'];
    $senhaUser = $_POST['senha'];

    if ($nomeUser == "Thomás" && $senha == "graduation") {
        $_SESSION['nome'] = $nomeUser;
        echo "Login realizado com sucesso!";
        header("location: bem-vindo.php");
        exit();
    } else {
        echo "Usuário ou senha inválidos!";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="nome" placeholder="nome"><br>
    <input type="password" name="senha" placeholder="senha"><br>
    <input type="submit">
</form>
</body>
</html>

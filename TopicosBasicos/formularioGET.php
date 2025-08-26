<?php

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nome"]) && isset($_GET["senha"])) {
    $nome = $_GET["nome"];
    $senha = $_GET["senha"];

    echo "Essa requisicao foi GET <br>";
    echo "$nome <br>";
    echo "$senha <br>";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario GET</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="nome" placeholder="nome"><br>
        <input type="password" name="senha" placeholder="senha"><br>
        <input type="submit">
    </form>
</body>
</html>

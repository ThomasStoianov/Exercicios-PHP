<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    echo "Essa requisicao foi POST <br>";
    echo "$nome <br>";
    echo "$senha <br>";
}

?>

<!doctype html>
<html lang="">
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

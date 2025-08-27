<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: bem-vindo.php");
    exit();
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
    <form action="validar.php" method="post">
        <input type="text" name="nome" placeholder="nome"><br>
        <input type="password" name="senha" placeholder="senha"><br>
        <input type="submit">
    </form>
</body>
</html>

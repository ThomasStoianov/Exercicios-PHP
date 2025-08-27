<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "E-mail inválido ! <br>";
        }

    }else {
        echo "Preencha todos os campos! <br>";
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
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="senha" placeholder="senha"><br>
        <input type="submit">
    </form>
</body>
</html>
<?php

global $connection;
require "conexao.php";

$erro = '';
$sucesso = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    if($nome == "" || $email == "" || $senha == ""){
        echo 'Preencha todos os campos!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo  "E-mail inválido!";
    } else {
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $connection -> prepare($sql);
        if (!$stmt) {
            $erro = "Erro no banco: " . $connection->error;
        } else {
            $stmt -> bind_param("s", $email);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt -> num_rows() > 0) {
                $erro = "E-mail já cadastrado!";
                $stmt-> close();
            } else {
                $stmt -> close();

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $connection -> prepare($sql);
                if (!$stmt) {
                    $erro = "Erro no banco: " . $connection->error;
                } else {
                    $stmt -> bind_param("sss", $nome, $email, $senhaHash);
                    if ($stmt -> execute()) {
                        $sucesso = "Cadastro realizado com sucesso!";

                        $nome = $email = "";
                    } else {
                        $erro = "Erro no banco: " . $stmt->error;
                    }
                    $stmt-> close();
                }
            }
        }
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

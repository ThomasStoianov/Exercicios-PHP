<?php

global $connection;
require "conexao.php";

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);
    $confirmarSenha = trim($_POST["confirmarSenha"]);

    if(empty($nome) || empty($email) || empty($senha)){
        $erro = "Preencha todos os campos!";
        echo $erro;
    }
    elseif ($senha !== $confirmarSenha) {
        $erro = "Confirme a senha!";
        echo $erro;
    }
    elseif ((!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $erro = "E-mail inválido";
        echo $erro;
    }
    else {
        $sql  = "SELECT email FROM usuarios WHERE email = ?";
        $stmt = $connection->prepare($sql);

        if(!$stmt){
            echo "Erro no banco de dados" . $connection->error;
        }
        else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0){
                echo "E-mail já cadastrado";
            }
            else {
                echo "E-mail inserido";
                $stmt->close();

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $connection->prepare($sql);

                $stmt->bind_param("sss", $nome, $email, $senhaHash);
                $stmt->execute();

                echo "Cadastro realizado com sucesso!";

                $stmt->close();
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
    <title>Desafio</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="nome" placeholder="nome"><br>
    <input type="email" name="email" placeholder="email"><br>
    <input type="password" name="senha" placeholder="senha"><br>
    <input type="password" name="confirmarSenha" placeholder="confirmar senha"><br>
    <input type="submit">
</form>
</body>
</html>

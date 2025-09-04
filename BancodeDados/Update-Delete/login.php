<?php

global $connection;
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    if(empty($email) || empty($senha)){
        echo "Preencha todos os campos!";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
    }
    else {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row["senha"])) {
                session_start();
                $_SESSION["usuario"] = $row["id"];
                header("Location: bemvindo.php");
                exit;
            } else {
                echo "Senha incorreta!";
            }
        }
        else {
            echo "E-mail não encontrado!";
        }
    }

}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="">
</head>
<body>
<form action="" method="post">
    <input type="email" name="email" placeholder="Email" id="email"><br>
    <input type="password" name="senha" placeholder="Senha" id="senha"><br>
    <input type="submit" value="Entrar" id="enviar">
</form>
</body>
</html>

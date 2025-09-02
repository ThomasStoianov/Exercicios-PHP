<?php

global $connection;
require "conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    if(empty($email) || empty($senha)) {
        echo "Preencha todos os campos!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
    }
    else {
        $sql = "SELECT nome, email, senha FROM usuarios WHERE email = ?";
        $stmt = $connection->prepare($sql);

        if(!$stmt){
            echo "Erro no banco de dados" . $connection->error;
        }
        else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows == 1) {
                $usuario = $resultado->fetch_assoc();

                if(password_verify($senha, $usuario["senha"])){
                    echo "Login realizado com sucesso! Bem-vindo, " . $usuario["nome"];
                }
                else {
                    echo "Senha incorreta!";
                }
            }
            else {
                echo "Usuário não encontrado!";
            }

            $stmt->close();
        }
    }

}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../login.css">
</head>
<body>
<form action="" method="post">
    <input type="email" name="email" placeholder="Email" id="email"><br>
    <input type="password" name="senha" placeholder="Senha" id="email"><br>
    <input type="submit" value="Entrar" id="enviar">
</form>
</body>
</html>

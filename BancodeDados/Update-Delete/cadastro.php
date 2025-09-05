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
        //$erro = "Preencha todos os campos!";
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
    <title>cadastro</title>
    <link rel="stylesheet" href="CSS/cadastro.css">
</head>
<body>

<section id="secao-esquerda">
    <img src="img/imagem.png">
</section>
<section id="right">
    <form action="" method="post">
        <h1>Seja Bem vindo!</h1>
        <h3>Faça o cadastro</h3>
        <label>
            <p>Nome</p>
            <input type="text" name="nome" placeholder="nome"><br>
        </label>
        <label>
            <p>Email</p>
            <input type="email" name="email" placeholder="email"><br>
        </label>
        <label>
            <p>Senha</p>
            <input type="password" name="senha" placeholder="senha"><br>
        </label>
        <label>
            <p>Confirmar Senha</p>
            <input type="password" name="confirmarSenha" placeholder="confirmar senha"><br>
            <div id="esquecer-senha">
                <input type="checkbox">
                <p>Esqueceu sua senha?</p>
            </div>
        </label>
        <input id="botao" type="submit">
        <p>Já tem conta? <a href="login.php">Login</a> </p>

    </form>
</section>

</body>
</html>

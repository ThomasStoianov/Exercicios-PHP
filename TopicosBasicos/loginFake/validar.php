<?php

session_start();

$usuario = $_POST['nome'];
$senha = $_POST['senha'];

$usuarioCorreto = "Thomás";
$senhaCorreta = 284284;

if($usuario == $usuarioCorreto && $senha == $senhaCorreta){
    $_SESSION['usuario'] = $usuario;

    setcookie("usuario", $usuario, time() + (86400), "/");

    header('Location: saudacao.php');
    exit();
}else {
    echo "Usuário ou senha inválidos";
    echo "<br><a href='loginFake.php'>Tentar novamente</a>";
}

?>
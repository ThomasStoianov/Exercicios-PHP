<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "usuarios_db";

// Criar a conexão
$connection = new mysqli($host, $usuario, $senha, $banco);

// Checar conexão
if ($connection->connect_error) {
    die("conexao falhou: " . $connection->connect_error);
}
else {
    echo "Conexão realizada com sucesso!";
}

?>
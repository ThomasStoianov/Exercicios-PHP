<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "desafio";

$connection = new mysqli($host, $user, $password, $dbname);

if ($connection -> connect_errno) {
    echo "Erro no banco de dados: " . $connection -> connect_error;
} else {
    echo "Conexão realizada com sucesso!";
}

?>
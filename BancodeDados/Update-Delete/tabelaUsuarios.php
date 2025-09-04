<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
global $connection;
require "conexao.php";

// Buscar todos os usuários
$sql = "SELECT * FROM usuarios";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Tabela
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Senha</th><th>Editar</th><th>Excluir</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['senha'] . "</td>";
    echo "<td><a href='editarUsuario.php?id=" . $row['id'] . "'>Editar</a></td>";
    echo "<td><a href='excluirUsuario.php?id=" . $row['id'] . "'>Excluir</a></td>";
    echo "</tr>";
}

echo "</table>";

$stmt->close();
?>
</body>
</html>

<?php

global $connection;
require "../conexao.php";

// Verifica se veio um pedido de exclusão
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    echo "Usuário excluido com sucesso! <br>";
}

// Busca todos os usuários do banco
$sql = "SELECT * FROM usuarios";
$result = $connection->query($sql);

// Mostra numa tabela
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Senha</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['senha'] . "</td>";
        echo "<td><a href='?excluir=" . $row['id'] . "'>Excluir</a></td>";
        echo "<td><a href='?editar=" . $row['id'] . "'>Editar</a></td>";
        echo "</tr>";

    }
        echo "</table>";
} else {
    echo "nenhum uuário encontrado!";
}


?>
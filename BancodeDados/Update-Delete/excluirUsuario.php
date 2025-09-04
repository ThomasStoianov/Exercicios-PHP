<?php
global $connection;
require "conexao.php";

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID do usuário não informado!");
}

$id = intval($_GET['id']);

// Deletar usuário
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Usuário excluído com sucesso!";
} else {
    echo "Erro ao excluir usuário: " . $stmt->error;
}

$stmt->close();

// Redireciona de volta para a tabela
header("Location: tabelaUsuarios.php");
exit;
?>

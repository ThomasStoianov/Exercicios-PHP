
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="listagemTabela.css">
</head>
<body>
<?php

global $connection;
require "../conexao.php";

$sql = "SELECT * FROM usuarios";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Senha</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['senha'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$stmt->close();

?>

</body>
</html>

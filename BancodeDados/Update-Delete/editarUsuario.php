<?php
global $connection;
require "conexao.php";

$erro = "";
$sucesso = "";

// Pegar ID do usuário
if (!isset($_GET['id'])) {
    die("ID do usuário não informado!");
}
$id = intval($_GET['id']);

// Buscar dados atuais
$sql = "SELECT nome, email FROM usuarios WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Usuário não encontrado!");
}

$usuario = $result->fetch_assoc();
$nomeAtual = $usuario['nome'];
$emailAtual = $usuario['email'];

// Atualizar dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if ($nome == "" || $email == "") {
        $erro = "Preencha todos os campos!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } else {
        if ($senha != "") {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);
            $stmtUpdate->bind_param("sssi", $nome, $email, $senhaHash, $id);
        } else {
            $sqlUpdate = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ssi", $nome, $email, $id);
        }

        if ($stmtUpdate->execute()) {
            $sucesso = "Usuário atualizado com sucesso!";
            $nomeAtual = $nome;
            $emailAtual = $email;
        } else {
            $erro = "Erro ao atualizar usuário: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
<h2>Editar Usuário</h2>

<?php if ($erro != "") echo "<p style='color:red;'>$erro</p>"; ?>
<?php if ($sucesso != "") echo "<p style='color:green;'>$sucesso</p>"; ?>

<form action="" method="post">
    <input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($nomeAtual) ?>"><br><br>
    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($emailAtual) ?>"><br><br>
    <input type="password" name="senha" placeholder="Nova senha (opcional)"><br><br>
    <input type="submit" value="Atualizar">
</form>
</body>
</html>

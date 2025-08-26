<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nota = $_POST["nota"];

    if($nota >= 7) {
        echo "Aluno aprovado";
    }
    elseif($nota < 7 && $nota >=5) {
        echo "Aluno de recuperação";
    }
    else {
        echo "Aluno reprovado";
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
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="nota" placeholder="nota"><br>
        <input type="submit">
    </form>
</body>
</html>

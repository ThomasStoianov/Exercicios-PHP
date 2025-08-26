<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $numero = $_POST["numero"];

    for ($x = 1; $x <= 10; $x++) {
        $tabuada = $numero * $x;
        echo "$numero x $x = " . $tabuada . "<br>";
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
        <input type="number" name="numero" placeholder="numero"><br>
        <input type="submit">
    </form>
</body>
</html>

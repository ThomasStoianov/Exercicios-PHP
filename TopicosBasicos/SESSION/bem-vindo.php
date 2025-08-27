<?php

session_start();

if (isset($_SESSION['nome'])) {
    session_destroy();
    echo "Sessão encerrada!";
} else {
    echo "Nenhuma sessão ativa!";
}

?>
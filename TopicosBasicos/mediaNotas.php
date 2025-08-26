<?php

function mediaNotas($nota1, $nota2, $nota3, $nota4)
{
    $media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
    echo "Sua media foi " . $media;
}

echo mediaNotas(8, 7, 8,5)

?>
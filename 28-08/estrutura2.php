<?php

    include("cabecalho.php");

    $valor = 10;

    if ($valor > 10){
        echo "Valor maior que 10";
    } elseif($valor < 10){
        echo "valor menor que 10";
    } else
        echo "igual a 10!";
        
    include("rodape.php");

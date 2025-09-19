<?php

    $valor = array(1, 2, 3, 4, 5);
    echo "<p>Primeiro valor do vetor: ".$valor[0]."</p>";

    $vetor = [1, 2, 3, 4, 5];
    //Função para exibir valores do vetor
    var_dump($vetor);
    echo "<br/>";
    print_r($vetor);

    $vetor[4]=6;
    echo "<p>Novo valor na posição: ".$vetor[4]."</p>";
    $vetor["nome"] = "Vanessa";
    print_r($vetor);

    $valores = [
        'nome' => "Vanessa",
        "sobrenome" => 'Borges',
        'idade' => 35];

    foreach($valores as $v){
        echo "<p>$v</p>";
    }

    foreach($valores as $c => $v){
        echo "<p>Posição: $c = Valor $v</p>";
    }
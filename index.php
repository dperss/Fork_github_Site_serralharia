<?php

class Pessoa {
    private $nome;
    function __construct($nome){
    $this->nome = $nome;
}
    function getNome(){
        return $this->nome;
    }
    }

    class Aluno extends Pessoa{
    private $num;
    function __construct($nome, $num){
        $this->num=$num;
        parent::__construct($nome);}
}

$jose=new Aluno("José", "5555");
echo $jose->getNome();

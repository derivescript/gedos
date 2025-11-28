<?php

namespace database;

class ErroBD{
    private $numero;
    private $mensagem;

    public function __construct($numero)
    {
        $this->numero = $numero;
    }

    public function getMensagem(){
        if($this->numero =='42S22'){
            $this->mensagem = "Um campo informado no cadastro nao existe na lista de campos";
        }
        return $this->mensagem;
    }
}
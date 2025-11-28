<?php

use function \core\message;
use function core\pre;

class All{
    public function do($name='', $db=false, $params)
    {

        #Nao estou especificando o nome, criar na raiz
        message('error','Aplicacao '.$name.' criada com sucesso!');
    }
}
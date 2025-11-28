<?php

/*
|-----------------------------------------------------------------------------
| Autor: Daniel da Costa e Faria
| Inspirado pelo artisan do Laravel
|-----------------------------------------------------------------------------
*/

class AppMaker{
    public function make($type,$name,$db='',$params=''){
        require 'make/'.$type.'.php';
        $classname  = ucfirst($type);
        $instance = new $classname;
        $instance->do($name,$db,$params);
    }
}
<?php

class Controller{
    public function do($name){
        if($name!='')
        {
            //Divide o endereco do controller 
            try{                    
            $location  = explode('/',$name);
            //Temos mais de um item informado na localizacao do controller. Nesse caso é uma subpasta
            if(sizeof($location)>1){
                //Se ela nao existe, criamos
                if(!is_dir(appdir.'/'.$location[0]))
                {
                    mkdir(appdir.'/'.$location[0]);
                }
                //Dentro dela criamos a pasta controllers, caso ela nao exista ainda
                if(!is_dir(appdir.'/'.$location[0].'/controllers'))
                {
                    mkdir(appdir.'/'.$location[0].'/controllers');
                }
                //Caso estejamos criando uma subpasta para a aplicacao especifica, entao verificamos se ela existe
                if(is_dir(appdir.'/'.$location[0].'/'.$location[1]))
                {
                    if(isset($location[2]) and $location[2]!='')
                    {
                        $arquivo = appdir.'/'.$location[0].'/'.$location[1].'/controllers/'.$location[2].'.php';
                        $namespace = appdir.'\\'.$location[0].'\\'.$location[1].'\\controllers';
                        $class = $location[2];
                    }else{
                        //Alertar erro ao nao informar o nome do controller
                        exit('Você não informou o nome do controller! >:('."\n");
                    }
                }else{
                    $arquivo = appdir.'/'.$location[0].'/controllers/'.$location[1].'.php';
                    $namespace = appdir.'\\'.$location[0].'\\controllers';
                    $class = $location[1];
                }                        
            }else{
                $arquivo = appdir.'/controllers/'.$location[0].'.php';
                $namespace = appdir.'\\controllers';
                $class = $location[0];
            }                    
            
            $class = ucfirst($class);
            $handle = fopen(strtolower($arquivo),'w');
            //$namespace = str_replace('/','\\',$name);
            $content  = <<<PHP
            <?php
            
            namespace {$namespace};
            
            class {$class}Controller extends \core\Controller
            {
                public function index()
                {
                    //Implementacao
                }             
            }
            PHP;
            fwrite($handle,$content);
            fclose($handle);
            echo "\e[0;32;12m Controller criado com sucesso!\e[0m\n";
            }catch(Exception $e){
                echo "\e[0;32;12m Controller criado com sucesso!\e[0m\n";
            } 
        }else{
            echo "\e[0;37;41m                                           \e[0m\n";
            echo "\e[0;37;41m Preciso do nome do controller, por favor! Algo como  \e[0m\n";
            echo "\e[0;37;41m                                           \e[0m\n";
        }
    }
}
<?php

use function core\pre;

class Model{ 
	public function do($name,$db=''){ 
        
		if($db=='')
        {
            echo "\e[0;37;41m                                                                                             \e[0m\n";
            echo "\e[0;37;41m Preciso do nome do banco de dados, por favor! Informe no formato nome do banco.nomedatabela \e[0m\n";
            echo "\e[0;37;41m                                                                                             \e[0m\n";
        }else{
            require(appdir.'/config/database.php');                    
            require(sisdir.'/helpers/Classbuilder.php');

            $dburl = explode('.',$db);
            /* if(!array_key_exists($dburl[0],$config)){
                echo "\e[0;37;41m                                         \e[0m\n";
                echo "\e[0;37;41m O banco de dados {$dburl[0]} não existe        \e[0m\n";
                echo "\e[0;37;41m                                          \e[0m\n";   
                echo "\e[0;37;41m                                          \e[0m";
            }           */          
            if(!isset($dburl[1]) || $dburl[1]=='')
            {
                echo "\e[0;37;41m                                                                                             \e[0m\n";
                echo "\e[0;37;41m Informe a tabela que quer mapear, por favor! Informe no formato nome do banco.nomedatabela  \e[0m\n";
                echo "\e[0;37;41m                                                                                             \e[0m\n";
            }else{
                //database name
                $dbname = $dburl[0];
                //table name
                $tablename = $dburl[1];
                //path to create file
                $location  = explode('/',$name);
                if(sizeof($location)>1){
                    $pasta = $location[0];
                    $model = $location[1];
                }else{
                    $pasta = '';
                    $model = $location[0];
                }
                
                //Instance of Classbuilder
                $builder = new helpers\Classbuilder;
                $builder->setSchema($dbname);
                $builder->connect($dbname);
                $builder->setPasta($pasta);
                if($builder->gerarentidade($model,$tablename)==true)
                {
                    echo "\e[0;37;44m                                   \e[0m\n";
                    echo "\e[0;37;44m Model criado com sucesso!         \e[0m\n";
                    echo "\e[0;37;44m                                   \e[0m\n";
                }else{
                    echo "\e[0;37;41m                                                                                             \e[0m\n";
                    echo "\e[0;37;41m Não foi possível gerar o model. Verifique o Classbuilder!                                   \e[0m\n";
                    echo "\e[0;37;41m                                                                                             \e[0m\n";                            
                }
            }
        }                
	}
}
	
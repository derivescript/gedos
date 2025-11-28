<?php

class View{
    public function do($name){
       
        if($name!='')
        {
            $viewdir =  appdir.'/views';
            $arquivo = '';
            //Divide o endereco do view 
            try{                    
            $location  = explode('/',$name);
                      
            //Temos mais de um item informado na localizacao do view. Nesse caso é uma subpasta
            if(sizeof($location)>1){                
                //Esta criando eu apps/pasta-da-aplicacao
                if(is_dir(appdir.'/'.$location[0])){
                    $viewdir = $viewdir.'/'.$location[0].'/views';
                    $arquivo = $viewdir.'/'.$location[0].'/'.$location[1].'.php';       
                }else{
                    //Estou criando dentro de apps/view
                    if(!is_dir($viewdir.'/'.$location[0])){
                        mkdir($viewdir.'/'.$location[0]);
                    }
                    $viewdir = $viewdir.'/'.$location[0];
                    $arquivo = $viewdir.'/'.$location[1].'.php';                         
                }

            //vai criar direto dentro de apps/views                           
            }else{
                $arquivo = $viewdir.'/'.$location[0].'.php';
            }   
            $handle = fopen(strtolower($arquivo),'w');
            //Conteudo da view
            $content = "<h2>Sua view</view>";
            $content .="<p>Esta view esta vazia e precisa de codigo</p>\n";
            $content .="<p>Voce pode usar o genesis para criar uma view com codigo</p>\n";
            $content .="<ul>\n";
            $content .="<li>php genesis create:form nome-da-pasta/nome-do-form</li>\n";
            $content .="<li>php genesis create:data-form nome-da-pasta/nome-do-form nomedobanco.nometabela</li>\n";
            $content .="</ul>\n";
            fwrite($handle,$content);
            fclose($handle);
            echo "\e[0;32;12m View criada com sucesso!\e[0m\n";
            }catch(Exception $e){
                echo "\e[0;32;12m View criada com sucesso!\e[0m\n";
            } 
        }else{
            echo "\e[0;37;41m                                           \e[0m\n";
            echo "\e[0;37;41m Preciso do nome da views, por favor! Algo como  \e[0m\n";
            echo "\e[0;37;41m                                           \e[0m\n";
        }
    }
}
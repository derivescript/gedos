<?php
class Application{
    public function do($name)
    {
        echo $name."\n";
        try{
            if($name!='')
            {
                mkdir(appdir.'/'.$name);
                mkdir(appdir.'/'.$name.'/controllers');
                mkdir(appdir.'/'.$name.'/models');
                mkdir(appdir.'/'.$name.'/views');                        
                $handle = fopen(appdir.'/'.$name.'/controllers/home.php','w');
                $content  = "<?php \n";
                $name = str_replace('/','\\',$name);
                $content .= "namespace ".appdir."\\{$name}\\controllers; \n\n";
                $content .= "class HomeController extends \core\Controller{ \n\t";
                $content .= "public function index(){ \n\t\t";
                $content .= "echo \"Este é o início da aplicação {$name}\"; \n\t";    
                $content .= "}\n";             
                $content .= "}\n\t";
                fwrite($handle,$content);
                fclose($handle);
                echo "\e[0;32;12m Aplicacao {$name} criada com sucesso!\e[0m\n";
            }else{
                //Alertar erro ao nao informar o nome do controller
                echo "\e[0;32;12m Faltou informar o nome da aplicacao!\e[0m\n";
            }                    
        }catch(Exception $e){
            echo "\e[0;32;12m Erro ao criar aplicacaoo!\e[0m\n";
        }
    }
}

    
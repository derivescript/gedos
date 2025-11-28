<?php

use Helpers\Classbuilder;

use function core\basedir;
use function core\pre;

class Form{
     /**
     * @param name = nome da view
     * @param database = banco de dados
     * @param params = parametros adicionais
     */
    public function do($name,$database='', $params=''){
        
		if($name!='')
        {
            $controller = '';
            if(strpos($name,'/') == true)
            {
                $paramname = explode('/',$name);
                $controllerName = $paramname[0];
            }
            
            $param_s = explode('=',str_replace(array('[',']'),'',$params));
            
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
			//Pegando os dados do banco de dados
			$db = explode('.',$database);
            $schema = $db[0];
            $entity = $db[1];
            require basedir().'/helpers/Classbuilder.php';
            $builder = new Classbuilder();
            $fields = $builder->describe($schema,$entity);
            $divcampos = '';
            foreach($fields as $key=>$campo)
            {   
                $campoForm = '';                
                if($campo['nome']=='id'){
                    $campoForm = '<input type="hidden" name="id" value="{\$id}">';
                    unset($fields[0]);
                }else{
                    $tipo = strtolower($campo['tipo']);
                $labelCampo = ucfirst($campo['nome']);
                $campoForm = '';
                switch($tipo)
                {
                    case 'int':
                    case 'integer':    
                        $campoForm = <<<PHP
                        <select name="{$campo['nome']}" class="form-control">\t
                                            <option selected="selected">---</option>
                                            <option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                        PHP;
                    break;
                    case 'varchar':
                    case 'character variying':
                        $campoForm = <<<PHP
                        <input type="text" name="{$campo['nome']}" id="{$campo['nome']}" class="form-control" autocomplete="off">
                        PHP;
                    break;
                    case 'date':
                        $campoForm = <<<PHP
                        <input type="date" name="{$campo['nome']}" id="{$campo['nome']}" class="form-control" value="{{$campo['nome']}}">
                        PHP;  
                    break;    
                    case 'blob':
                    case 'text':
                    case 'longtext':
                        $campoForm = <<<PHP
                        <textarea name="{$campo['nome']}" id="{$campo['nome']}" rows="30" class="form-control"></textarea>
                        PHP;
                    break;   
                    default:
                    $campoForm = <<<PHP
                        <input type="text" name="{$campo['nome']}" id="{$campo['nome']}" class="form-control" autocomplete="off">
                        PHP;
                    break;
                    
                    }
                    $divcampos.= <<<PHP
                    <div class="form-group">
                                <label for="{$campo['nome']}">{$labelCampo}</label>
                                {$campoForm}
                            </div>\n\t\t
                    PHP;
                }             
            }
            $campos = $divcampos;
            //Hora de gerar os campos de formulario de acordo com o tipo de dados
            $handle = fopen(strtolower($arquivo),'w');
            //Conteudo da view
            $content = <<<PHP
            <form action="{$controllerName}/save" method="post">
                <div class="card-body">
                    <div class="col-6">
                        <div class="row">
                        {$campos}
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
                    </div>
                </div>
            </form>
            PHP;
            fwrite($handle,$content);
            fclose($handle);
            echo "\e[0;32;12m View criada com sucesso!\e[0m\n";
            }catch(Exception $e){
                echo "\e[0;32;12m View nao criada com sucesso! {$e->getMessage()}\e[0m\n";
            } 
        }else{
            echo "\e[0;37;41m                                           \e[0m\n";
            echo "\e[0;37;41m Preciso do nome da view, por favor! Algo como  \e[0m\n";
            echo "\e[0;37;41m                                           \e[0m\n";
        }
    }
}
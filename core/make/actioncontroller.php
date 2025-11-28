<?php

use function core\pre;

class Actioncontroller{ 
	private $pdo;
	private $schema;
	/* * Conecta ao schema de dados
	 * @param $schema;
	 */
	public function connect($schema)
	{
		$this->schema = $schema;
		try{
			$conexao = new Database\Connection($this->schema);
			$this->pdo = $conexao->connect($this->schema);
			return $this->pdo;
		}catch(\Exception $e){
			echo "Erro: ".$e->getMessage();
		}
	}

	public function setFolder($location)
	{
		$path = explode('/',$location);
	
	}

	public function setTable($dbPath)
	{

	}

	public function setNameSpace()
	{

	}
	public function do($name,$db){ 
		require(sisdir.'/helpers/Classbuilder.php');
		
		if($name!='')
		{
			try{                    
			$location  = explode('/',$name);
			$database = explode('.',$db);
			$dbname = $database[0];
			$tablename = $database[1];
			$this->pdo = $this->connect($dbname);
			//Obtem os campos da tabela
			$builder = new Helpers\Classbuilder;
			$fields = $builder->describe($dbname,$tablename);
			
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
			
			$controllerClass = ucfirst($class);
			$controllerVar = strtolower($class);
			$modelName = ucfirst($tablename);
			$modelVar = $tablename;
			$handle = fopen(strtolower($arquivo),'w');
			//setters

			$settersCode = "";
			
			foreach($fields as $atributo){
				$atParts = explode('_',$atributo['nome']);
				$atName= '';
				foreach($atParts as $atPart){
					$atPart = ucfirst($atPart);
					$atName .= $atPart;
				}
				//$upperAtributo = ucfirst($atributo['nome']);
				if($atributo['nome'] == 'password' || $atributo['nome']=='senha'){
					$settersCode .="\$password = password_hash(filterpost('password'), PASSWORD_DEFAULT);\n\t\t";
					$settersCode .= "\${$modelVar}->set{$atName}(\$password);\n\t\t";
				}else{
					$settersCode .= "\${$modelVar}->set{$atName}(filterpost('{$atributo['nome']}'));\n\t\t";
				}
				
			}

			if(file_exists(sisdir.'/core/make/templates/controllerTemplate.php'))
			{
				$cTemplate =sisdir.'/core/make/templates/controllerTemplate.php';
			}else{
			echo "\e[0;37;41m                                           \e[0m\n";
			echo "\e[0;37;41m Template não encontrado  \e[0m\n";
			echo "\e[0;37;41m                                           \e[0m\n";
			}
			
			$content = file_get_contents($cTemplate);
			$content = str_replace("{nome}",$controllerClass,$content);
			$content = str_replace("{sets}",$settersCode,$content);
			$content = str_replace("{modelName}",$modelName,$content);
			$content = str_replace("{modelvar}",$modelVar,$content);
			fwrite($handle,$content);
			fclose($handle);
			echo "\e[0;32;12m Controller criado com sucesso!\e[0m\n";
			
		}catch(Exception $e){
				echo "\e[0;37;41m Controller nao criado com sucesso! {$e->getMessage()}\e[0m\n";
			} 
		}else{
			echo "\e[0;37;41m                                           \e[0m\n";
			echo "\e[0;37;41m Preciso do nome do controller, por favor! Algo como  \e[0m\n";
			echo "\e[0;37;41m                                           \e[0m\n";
		}
	}

	public function write($file,$content)
	{

	}
}
	
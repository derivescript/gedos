<?php

namespace core;

class Controller{

	public function __construct(){
		
	}
	/**
	 * Carrega uma view 
	 * @author: Daniel Faria 
	 */
	public function view($view,$data=''){
		//Creates an instance of Router Class and defines the application dir to set controllers, models and views folder
		$router = new Router;
		$pasta = $router->set_app_dir();
		$subpasta = $router->set_sub_folder();
		//Defines which folder
		if(isset($pasta)){
			$viewfile = appdir."/".$pasta."/views/{$view}.php";
		}else{
			$viewfile = appdir."/views/{$view}.php";
		}

		/*
		 * The view file exists? So, we can pass data to the file 
		 */
		if(file_exists($viewfile)){
			//Ler o conteudo da view
			$content = file_get_contents($viewfile);
			//Passando dados para a view
			if(isset($data) && $data!=''){
				//Estou passando um array
				if(is_array($data) && count($data,COUNT_NORMAL)>0)
			    {
					//Substituir dados na view					
			        foreach($data as $chave=>$valor){						
						//Se o indice for um array
						if(is_array($data[$chave]))
						{
							$code ='';
							foreach($data[$chave] as $key=>$val)
							{
								$pattern = '/{'.$chave.'}/';
								if(preg_match($pattern,$content,$matches))
								{
									$code .= $data[$chave][$key]->nome;						
								}								
							}
							$content = str_replace('{'.$chave.'}',$code,$content);
						}else{
							if(!is_null($valor))
							{
								$content = str_replace('{'.$chave.'}',$valor,$content);
							}
							
						}			            
					}
					
					$content = str_replace('{'.$chave.'}',$valor,$content);			        
					print eval('?>'. $content);
				//Se for um objeto
				}else{					
					$content = str_replace('{'.$chave.'}',$valor,$content);
				}
				
			//Sem dados, apenas retornar a view				    	
			}else{
				include_once(appdir."/".$pasta."/views/{$view}.php");
			}
			
		    //O arquivo indicado não existe, então mostro mensagem de erro
		}else{
			echo '<div class="alert alert-danger">
			<h4>Arquivo view não foi encontrado</h4>
			<p>A view '.$view.'.php não foi encontrada. Verifique seu código</p>
		</div>';
		}
				
	}

	public function model($model){
		//Crio uma nova instancia da classe router e pego a pasta admin
		$router = new Router;
		$pasta = $router->set_app_dir();
        //Se estou na pasta admin, entao vou buscar um model dentro de site/admin/model
		if(isset($pasta)){
			$modelfile = appdir."/".$pasta."/models/{$model}.php";
			//Encontrei o model. Entao crio uma nova instancia de Model e retorno ela para o Controller
			$class = appdir.'\\'.$pasta.'\\models\\'.$model;
		}else{
			$modelfile = modeldir."/{$model}.php";
			$class = appdir.'\\models\\'.$model;
		}	
		
		if(file_exists($modelfile)){
			require_once $modelfile;
		}else{
			echo "Arquivo {$modelfile} não encontrado";
		}
		$model = new $class;
		return $model;		
	}

	/**
	 * Carrega uma view e seus dados para dentro de um template.
	 * Deve ser capaz nao so de carregar os templates, mas capaz de subsitituir variaveis de template
	 * @param $template - arquivo usado como template
	 * @param $view - Arquivo que sera carregado dentro do template
	 * @param $data - Conjunto de dados que serao passados para a view
	 * @param $global - Define se o template sera enxergavel atraves de toda a aplicacao ou apenas na
	 * pasta onde o controller esta sendo carregado 
	 */
	public function template($template,$view='',$data='',$global_template=false,$global_view=false){
		/*
		 * Crio uma nova instancia da classe router e pego a pasta de 
		 * onde estou acessando o controller
 		 */
		$router = new router;
		$application_dir = $router->set_app_dir();
		//$data = $data;
		/*
		 * Se o parametro global for setado como false, o controller deve buscar o template dentro da
		 * pasta apps/subpasta/view, caso contrario, busca o template na pasta
		 * apps/view 
		 */
		if($global_template==true)
		{
			$template = appdir."/views/{$template}.php";
		}else{
			$template = appdir."/".$application_dir."/views/{$template}.php";
		}

		if($global_view==false){
			$viewfile = appdir."/".$application_dir."/views/{$view}.php";
		}else{
			$viewfile = appdir."/views/{$view}.php";
		}
		
		//Carrega o template
		if(file_exists($template)){
					
			/*
			Leitura de dados passados para a view
			*/
										
			if(isset($data) && $data!='' && count(array($data),COUNT_NORMAL)>0){
				//Ler o conteudo da view1
				$content = file_get_contents($viewfile);
				
				$tcontent = file_get_contents($template);
				$tcontent = str_replace('{baseurl}',baseUrl(),$tcontent);
				$tcontent = str_replace('{year}',date('Y'),$tcontent);
				 
				//Substituir dados na view
				foreach((array)$data as $chave=>$valor){
					if($valor== ''){
						exit("A variavel {$chave} .nao está recebendo nenhum valor".br);
					}
					$content = str_replace('{'.$chave.'}',$valor,$content);
					$tcontent = str_replace('{'.$chave.'}',$valor,$tcontent);
					$template = $tcontent;
					$conteudo = $content;
				}
				$viewfile = $content;
				print eval("?>". $template);
			}else{
				$content = file_get_contents($viewfile);
				$tcontent = file_get_contents($template);
				$tcontent = str_replace('{baseurl}',baseUrl(),$tcontent);
				$tcontent = str_replace('{year}',date('Y'),$tcontent);
				$viewfile = $content;
				print eval('?>'.$tcontent);
			}
			/* Fim da leitura de dados*/
		}else{
			//o template informado nao existe
			echo "Arquivo {$template} nao encontrado";
		}		
		//Fim else		
		
	}

	public function load($pasta,$classe){
		require_once basedir().'/'.$pasta.'/'.$classe.'.php';
		$classe = new $classe;
		return $classe;
	}
}
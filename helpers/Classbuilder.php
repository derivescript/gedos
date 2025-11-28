<?php

namespace Helpers;

use function Core\basedir;
use function core\pre;

use Database;
use Helpers;

class Classbuilder{
	public $schema;
    public $pasta;
	public $entities = array();
	private $pdo;
	private $consulta;
	
	/**
	 * Metodo construtor
	 * @param $schema
	 * @param $pasta
	 */
	public function __construct(){
		
	}

	/**
	 * 
	 */
	public function setSchema($schema)
	{
		$this->schema = $schema;
		require appdir.'/config/database.php';
		if($config['name']==$this->schema)
			{
				$this->pdo = $this->connect($this->schema);
				$this->entities = $this->gettables($this->getschema());
			}					
	}
	/**
	 * 
	 */
	public function setPasta($pasta)
	{
		$this->pasta= $pasta;
	}
	/**
	 * 
	 */
	public function exibir()
	{
		echo '<div style="column-count:2;">';
		
		foreach($this->entities as $entity)
		{
			$opcao = new Helpers\TCheckbox('entities[]');
			$opcao->setClass('opcao');
			$opcao->set_value($entity);
			$opcao->set_data('tabela',$entity);
			echo $opcao->exibir();
			$label = new TLabel('tabela',$entity);
			$label->setClass('label-opcao');
			$label->exibir();
			echo br;
		}
		echo '</div>';
		pre($this->entities);
	}
	/**
	 * Retorna o schema de onde serão gerados os arquivos
	 */
	public function getschema()
	{
		return $this->schema;
	}
	/**
	 * Retorna a pasta onde serão gravados os arquivos
	 */
	public function getPasta()
	{
		return $this->pasta;
	}
	/**
	 * Conecta ao schema de dados
	 * @param $schema;
	 */
	public function connect()
	{
		try{
			$conexao = new Database\Connection();
			$this->pdo = $conexao->connect($this->schema);
			return $this->pdo;
		}catch(\Exception $e){
			echo $this->consulta."<br>".$e->getMessage();
		}
	}

	public function getConfig($schema)
	{
		require appdir.'/config/database.php';
		return $config;
	}

	public function describe($schema,$table)
	{
		$config = $this->getConfig($schema);
		if($config['driver']=='mysql')
		{
			$this->pdo = $this->connect($schema);
			$sql=$this->pdo->query("DESCRIBE {$table}");
		}elseif($config['driver']=='postgres')
		{
			$this->pdo = $this->connect($schema);
			$sql=$this->pdo->query("SELECT column_name, data_type, is_nullable
				FROM information_schema.columns
			WHERE table_name = '{$table}';");
		}
		
		
		$fields = [];
		while($field = $sql->fetch(\PDO::FETCH_ASSOC)){
			$fields[] = [
				'nome'=>isset($field['Field'])?$field['Field']:$field['column_name'],
				'tipo'=>isset($field['Type']) ? preg_replace('/\(.*?\)/', '', $field['Type']):$field['data_type']
			];
		}
		return $fields;
	}

	public function gettables($schema){
		$this->pdo = $this->connect($schema);
		$sql=$this->pdo->query("SHOW TABLES FROM {$schema}");
		while($table = $sql->fetch(\PDO::FETCH_ASSOC)){
			array_push($this->entities,$table['Tables_in_'.$this->schema]);				
		}
		return $this->entities;		
	}

	public function gerarentidade($model,$entity){
		$this->connect($this->schema);
		if(strpos($entity,'_')){
			$partes = explode('_',$entity);
			$partes[0] = ucfirst($partes[0]);
			$partes[1] = ucfirst($partes[1]);
			$arquivo = $partes[0].$partes[1];
		}else{
			$arquivo = ucfirst($entity);
		}
		
		if($model!='')
		{
			 $arquivo = ucfirst($model);
		}
		
		if(!file_exists("{$this->pasta}/models/{$arquivo}.php"))
		{
			$sql = $this->pdo->query("SELECT * FROM {$entity}");
			$total_column = $sql->columnCount();
			if($total_column>0){
				$fields = array();
				for ($counter = 0; $counter < $total_column; $counter ++) {
					$meta = $sql->getColumnMeta($counter);
					$nome = $meta['name'];
					$tipo = $meta['native_type'];
					array_push($fields, array("nome"=>$nome,"tipo"=>$tipo));		
				}															
			}
			
			$namespace = $this->pasta != '' 
                ? "apps\\{$this->pasta}\\models" 
                : "apps\\{$this->pasta}models";

			$attributes = '';
            // Adiciona os atributos
            foreach ($fields as $atributo) {
                $attributes .= <<<PHP

                private \${$atributo['nome']};
            PHP;
            }
			$setters = '';
            // Adiciona os setters
            foreach ($fields as $atributo) {
                $atParts = explode('_',$atributo['nome']);
				$upperAtributo= '';
				foreach($atParts as $atPart){
					$atPart = ucfirst($atPart);
					$upperAtributo .= $atPart;
				}
                $setters .= <<<PHP

                /**
                 *
                 * @Column(nome="{$atributo['nome']}", type="{$atributo['tipo']}")
                 */
                public function set{$upperAtributo}(\$valor) : void {
                    \$this->{$atributo['nome']} = \$valor;
                }
            PHP;
            }
			$getters = '';
            // Adiciona os getters
            foreach ($fields as $atributo) {
                $atParts = explode('_',$atributo['nome']);
				$upperAtributo= '';
				foreach($atParts as $atPart){
					$atPart = ucfirst($atPart);
					$upperAtributo .= $atPart;
				}
                $getters .= <<<PHP

                /**
                 * Retorna o valor do atributo {$atributo['nome']}
                 */
                public function get{$upperAtributo}() : mixed {
                    return \$this->{$atributo['nome']};
                }
            PHP;
            }

            // Método save
			$saveFields = "";
			foreach($fields as $atributo){
				$atParts = explode('_',$atributo['nome']);
				$upperAtributo= '';
				foreach($atParts as $atPart){
					$atPart = ucfirst($atPart);
					$upperAtributo .= $atPart;
				}
				$saveFields .= <<<PHP
				\$fields['{$atributo['nome']}'] = \$this->get{$upperAtributo}();\n\t
				PHP;						
			}
            
			$updateFields = '';
			foreach($fields as $atributo){
				$atParts = explode('_',$atributo['nome']);
				$upperAtributo= '';
				foreach($atParts as $atPart){
					$atPart = ucfirst($atPart);
					$upperAtributo .= $atPart;
				}
				$updateFields .= <<<PHP
				if (!is_null(\$this->get{$upperAtributo}())) {
							\$fields['{$atributo['nome']}'] = \$this->get{$upperAtributo}();
					}\n\t
				PHP;		
			}

			$modelTemplate =sisdir.'/core/make/templates/modelTemplate.php';
			//conteudo do template		
			$content = file_get_contents($modelTemplate);
			$content = str_replace('{namespace}', $namespace, $content);
			$content = str_replace('{entity}', $entity, $content);
			$content = str_replace('{upperentity}', $arquivo, $content);
			$content = str_replace('{dbname}', $this->schema, $content);
			$content = str_replace('{attributes}', $attributes, $content);
			$content = str_replace('{setters}', $setters, $content);
			$content = str_replace('{getters}', $getters, $content);
			$content = str_replace('{fields}', $saveFields, $content);
			$content = str_replace('{updateFields}', $updateFields, $content);
			$file = fopen(basedir()."/apps/{$this->pasta}/models/{$arquivo}.php","w") or die('Nao consigo abrir');
			fwrite($file, $content);
			fclose($file);
			chmod(basedir()."/apps/{$this->pasta}/models/{$arquivo}.php",0777);
			return true;
		}else{	
			echo "O model ja existe";
		}	
	}


	public function is_strange($campo,$entity)
	{
		$this->connect($this->schema);
		$schema = $this->pdo->query("SELECT * FROM  information_schema.KEY_COLUMN_USAGE WHERE table_schema =  '{$this->schema}' 
		AND table_name =  '{$entity}' and column_name = '{$campo}'") or die("Erro");
		$chave = $schema->fetch(\PDO::FETCH_OBJ);
		if($chave==NULL)
		{
			return false;
		}else{
			return true;
		}

	}
	public function geraview($entity){
	$tbreferenciada = '';
	$tbnome = '';
	$colname = '';
	$conteudo ='';
	$this->connect($this->schema);
	$sql = $this->pdo->query("Show columns FROM $entity");
		
	$schema = $this->pdo->query("SELECT * FROM  information_schema.KEY_COLUMN_USAGE WHERE table_schema =  '{$this->schema}' 
	AND table_name =  '{$entity}'") or die("Erro");
			   while($chave = $schema->fetch(\PDO::FETCH_OBJ)){
				   //$this->pre($chave);
				   if($chave->REFERENCED_COLUMN_NAME!=NULL){
					   $tbreferenciada = $chave->REFERENCED_TABLE_SCHEMA;
					   $tbnome =  $chave->REFERENCED_TABLE_NAME;
					   $colname = $chave->REFERENCED_COLUMN_NAME;
				   }	
	}				
			   
						   
	$fields = array();
	$conteudo = "";
	$conteudo .= '<form class="form-horizontal" action="/admin/'.$entity.'/inserir" method="post">'."\n\t";
		while($fieldsbd = $sql->fetch(\PDO::FETCH_OBJ)){	
			if($fieldsbd->Field!='id')
			{
				$split = explode('(',$fieldsbd->Type);
				$tipo = $split[0];
				$valores = str_replace(')','',$tipo);
				$conteudo .= "<div class=\"form-group\">\n\t\t";
				$conteudo .= '<label class="col-sm-2 control-label" for="'.$fieldsbd->Field.'">'.ucfirst($fieldsbd->Field).'</label>'."\n\t\t";	
				$conteudo .= '<div class="col-sm-4">'."\n\t\t\t";
			
				switch($tipo){
					case 'varchar':				
						$conteudo .= '<input class="form-control" type="text" name="'.$fieldsbd->Field.'" id="'.$fieldsbd->Field.'" />'."\n\t\t";
					break;
					
					case 'int':
						//é chave estrangeira?
						if($this->is_strange($fieldsbd->Field,$entity)==true)
						{
							if($colname!=NULL || $colname!=''){
								$conteudo .= "<?php \n";
								$conteudo .= "$$fieldsbd->Field = new TDataSelect('$fieldsbd->Field','$this->schema','$tbnome','');\n";
								$conteudo .= "$$fieldsbd->Field->value('id');\n";
								$conteudo .= "$$fieldsbd->Field->option('');\n";
								$conteudo .= "$$fieldsbd->Field->exibir();\n\t\t";
								$conteudo .= "?>";	
							}
						}else{
							$conteudo .="<input type=\"radio\" name=\"{$fieldsbd->Field}\" id=\"{$fieldsbd->Field}\" value=\"1\"/> Sim\n\t\t\t";
							$conteudo .="<input type=\"radio\" name=\"{$fieldsbd->Field}\" id=\"{$fieldsbd->Field}\" value=\"0\"/> N&atilde;o\n\t\t";
						}						 																		
					break;

					case 'enum':
					$conteudo .="<input type=\"radio\" name=\"{$fieldsbd->Field}\" id=\"{$fieldsbd->Field}\" value=\"s\"/> Sim\n\t\t\t";
					$conteudo .="<input type=\"radio\" name=\"{$fieldsbd->Field}\" id=\"{$fieldsbd->Field}\" value=\"n\"/> N&atilde;o\n\t\t";
					break;
					
					case 'text':
					case 'longtext':
					case 'mediumtext':

					$conteudo .='<textarea class="form-control" name="'.$fieldsbd->Field.'" id="'.$fieldsbd->Field.'" /></textarea>'."\n\t";
					break;		
					
					case 'date':
						$conteudo .='<input type="date" class="form-control" name="'.$fieldsbd->Field.'" id="'.$fieldsbd->Field.'" />'."\n\t";	
					break;	
				}								
			$conteudo .= "</div>\n";		
			$conteudo .= "</div>\n\n";	
			}		   	
		   }				
		   $conteudo .='<div class="form-group">'."\n\t";
		   $conteudo .='<label  class="col-sm-2 control-label"></label>'."\n\t\t";
		   $conteudo .='<div class="col-sm-4">'."\n\t\t\t";
		   $conteudo .='<div class="button">'."\n\t\t\t\t";
		   $conteudo .='<button type="submit" class="btn btn-primary">Salvar</button>'."\n\t\t\t";
		   $conteudo .='</div>'."\n\t\t";
		   $conteudo .='</div>'."\n";
		   $conteudo .='</div>'."\n";
		   $conteudo .='</form>'."\n";
				   
			
		if(!is_dir(basedir()."/apps/{$this->pasta}/views/{$entity}")){
			mkdir(basedir()."/apps/{$this->pasta}/views/{$entity}");
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}",0777);			
		}
		
		if(!file_exists(basedir()."/apps/{$this->pasta}/views/{$entity}/cadastro-{$entity}.php"))	
		{
			$file = fopen(basedir()."/apps/{$this->pasta}/views/{$entity}/cadastro-{$entity}.php","w") or die('Nao consigo abrir');
			fwrite($file, $conteudo);
			fclose($file);
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/cadastro-{$entity}.php",0777);
			//
			echo '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Concluído!</h4>
			Arquivo cadastro-'.$entity.'.php gerado com sucesso!
		   </div>';
			//
		}else{
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php",0777);
		}
		//O arquivo existe?	
		if(!file_exists(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php"))	
		{
			$file = fopen(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php","w") or die('Nao consigo abrir');
			fwrite($file, $conteudo);
			fclose($file);
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php",0777);
			//
			echo '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Concluído!</h4>
			Arquivo editar-'.$entity.'.php gerado com sucesso!
		   </div>';
			//
		}else{
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php",0777);
		}
		//O arquivo existe?	
		if(!file_exists(basedir()."/apps/{$this->pasta}/views/{$entity}/lista-{$entity}.php"))	
		{
			$conteudolista = '';
			$conteudolista .= '{lista}';
			$file = fopen(basedir()."/apps/{$this->pasta}/views/{$entity}/lista-{$entity}.php","w") or die('Nao consigo abrir');
			fwrite($file, $conteudolista);
			fclose($file);
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/lista-{$entity}.php",0777);
			//
			echo '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Concluído!</h4>
			Arquivo lista-'.$entity.'.php gerado com sucesso!
		   </div>';
			//
			
		}else{
			chmod(basedir()."/apps/{$this->pasta}/views/{$entity}/editar-{$entity}.php",0777);
		}	
		
	}

	public function geracontroller($entity){				
		if(file_exists(__DIR__.'/../core/make/templates/controllerTemplate.php'))
		{
			$cTemplate =__DIR__.'/../core/make/templates/controllerTemplate.php';
		}else{
			echo "Nao";
		}
		
		$content = file_get_contents($cTemplate);

		echo $content;
		exit;
		$arquivo = str_replace('_','',$entity);
		if(!file_exists(basedir()."/apps/{$this->pasta}/controllers/{$arquivo}.php"))	
		{
			$file = fopen(basedir()."/apps/{$this->pasta}/controllers/{$arquivo}.php","w") or die('Nao consigo abrir');
			fwrite($file, $conteudo);
			fclose($file);
			chmod(basedir()."/apps/{$this->pasta}/controllers/{$arquivo}.php",0777);
			//
			echo '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Concluído!</h4>
			Classe controller '.$entity.'.php gerada com sucesso!
			</div>';
			//
		}else{
			chmod(basedir()."/apps/{$this->pasta}/controllers/{$arquivo}.php",0777);
		}			
	}
	
	public function getFields($entity){
		$pdo = $this->connect();
		$sql = $pdo->query("SELECT * FROM {$entity}");
			$total_column = $sql->columnCount();
			if($total_column>0){
				$fields = array();
				for ($counter = 0; $counter < $total_column; $counter ++) {
					$meta = $sql->getColumnMeta($counter);
					$nome = $meta['name'];
					$tipo = $meta['native_type'];
					array_push($fields, array("nome"=>$nome,"tipo"=>$tipo));		
				}															
			}
		return $fields;
	}
}

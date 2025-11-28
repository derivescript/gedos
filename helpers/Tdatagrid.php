<?php

namespace helpers;

use core\Router;
use core\URI;
use database\Connection;
use database\Select;

use function core\baseUrl;
use function core\pre;

class TDatagrid extends Tabela{
	/*atributos*/	
	private $controller;
	private $entidade;
	private $schema;
	private $campos;
	private $ordem;
	private $pagina;
	private $primeiro_registro;
	private $max_paginas;
	private $linhas=20;
	private $filtro;
    private $search;
	private $html ='';
	private $acoes = array();
	private $joins = array();
	private $titles = array();
	private $titulos = array();
	private $data;
	private $actions = array();
	private $router;
	private $folder;
	private $class;
	
	public function __construct($campos,$tabela)
	{
		$this->router = new Router();
		$this->router->set_controller();
		$this->controller = $this->router->get_controller();
		$this->folder = $this->router->get_appfolder();
		$this->campos=$campos;
		$this->entidade=$tabela;
		$this->setClass('table table-bordered table-hover dataTable dtr-inline');
	}

	public function setClass($class)
	{
		$this->class = parent::setClasse($class);
		
	}
	/**
	 * Definir quantidade de linhas
	 */

	public function linhas($qtde)
	{
		$this->linhas = $qtde;
	}

	public function actions($actions){
		$actions = explode(',',$actions);
		foreach($actions as $action){
			array_push($this->acoes, array("metodo"=>$action,"imagem"=>'$icone'));
		}		
	}

	public function action($acao,$icone,$target="self"){		
		array_push($this->acoes, array("metodo"=>$acao,"imagem"=>$icone,"target"=>$target));
	}

	public function findKey($schema,$tabela)
	{
		$conn = new Connection($schema);
		$config = $conn->getconfig();
		$schema = $config['name'];
		$tabela= $this->entidade;
		
		$pdo = $conn->connect('information_schema');
		$consulta = "SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = '{$schema}' and CONSTRAINT_NAME='primary' and table_name='{$tabela}'";				
		$sql = $pdo->query($consulta);
		$dados = $sql->fetch(\PDO::FETCH_OBJ);
		$chave = $dados->COLUMN_NAME;
		return $chave;
	}
	/**
	 * Retorna a acao de uma coluna
	 */ 
	public function get_acao($acao,$icone,$id){
		$uri = new URI();
		
		$link= new html('a');
		switch($acao)
		{
			case 'editar':
				$title = 'Editar';
				$color = 'warning';	
				$icone = '';
			case 'comentar':	
				$title = 'Escrever comentário';
				$color = 'warning';
				$icone = '';
			break;
			case 'recusar':
				$title = 'Recusar resumo';
				$color = 'danger';
				$icone = '';
			break;	
			case 'excluir':
				$title = 'Excluir';
				$color = 'danger';
				$icone = '';
			break;	
			case 'recusar':
				$title = 'Enviar recusa';
				$color = 'danger';
				$icone = '';
			break;
			case 'responder':
				$title = 'Enviar resposta';
				$color = 'warning';
				$icone = '';
				break;
			case 'poremail':
				$title = 'Enviar por e-mail';
				$color = 'success';
				$icone = '';
			break;	
			
			case 'imprimir':
				$title = 'Imprimir';
				$color = 'primary';
				$icone = '';
			break;

			case 'aceite':
				$title = 'Enviar aceite';
				$color = 'default';
				$icone = '';
			break;

			case 'verresumo':
				$title = 'Abrir resumo';
				$color = 'success';
				$icone = '';
			case 'details':
				$title = 'Mostrar detalhes';
				$color = 'success';
				$icone = '';
			break;

			case 'certificar':
				$title = 'Lançar certificado';
				$color = 'primary';
				$icone = '';
			break;
		}
        if (isset($color)) {
            $link->class="btn btn-{$color} btn-sm {$acao} lnk-{$acao} ajax-link";
        }else{
			echo $acao.br;
		}
		$link->id='';		
		$link->href="{$this->controller}/{$acao}/{$id}";
		$link->data=$id;
		$link->alt=$title;
		$link->title=$title;
		$link->add('<i class="fas fa-'.$icone.' fa-1px fa-1px"></i>'.$acao);
		return $link;
	}
	
	public function open()
	{
		$this->html .='<table class="'.$this->class.'">';
	}
	/**
	 * Permite pegar dados de uma consulta e montar uma grid com eles
	 */
	public function prepare($data)
	{
		$this->data = $data;
	}

	public function close()
	{
		$this->html .= parent::fechar();
	}

	/**
	 * $datagrid->replaceField('id_secao','secoes','nome','$registro->id_secao')
	 */
	public function replaceField($campoatual,$tabela='',$novocampo=''){
        if ($tabela!='none') {
            $this->joins[$campoatual]['tabela'] = $tabela;
            $this->joins[$campoatual]['novocampo'] = $novocampo;
        }	
	}

	public function replaceValue($campoatual,$valoratual,$novovalor)
	{
		$this->joins[$campoatual]['tabela'] = 'none';
		$this->joins[$campoatual]['valoratual'] = $valoratual;
		$this->joins[$campoatual]['novovalor'] = $novovalor;
	}

	public function replaceIf($campoatual,$valoratual,$true,$false)
	{
		$this->joins[$campoatual]['tabela'] ='none';
		if($valoratual==0)
		{
			$this->joins[$campoatual]['novovalor'] = $true;
		}else{
			$this->joins[$campoatual]['novovalor'] = $false;
		}
		
	}

	public function rename_title($oldname,$newname)
	{
		$this->titles[$oldname]['nome'] = $newname;
	}
	
    public function filtro($where){
		$this->filtro=$where;
		return $this->filtro;
	}

    public function like($column_name, $search,$logical=''){
		if($logical!='')
		{
			$this->search="{$logical} {$column_name} like '{$search}'";
		}else{
			$this->search="{$column_name} like '{$search}'";
		}
		
		return $this->search;
	}

	public function ordem($campo){
		$this->ordem=$campo;
		return $this->ordem;	
	}

	public function get_schema()
	{
		
	}
	
	public function view()
	{
		$chave = $this->findKey($this->schema,$this->entidade);		
		$this->get_schema();
		$router = new Router();
		$this->pagina = $this->router->get_pagina();
		$select = new Select($this->campos,$this->entidade);
	
		//Setando o primeiro registro
		if(!isset($this->pagina) || $this->pagina ==''){
			$this->primeiro_registro = 0;	
		}else{
			$this->primeiro_registro = ($this->pagina*$this->linhas) - $this->linhas;
		}

		if($this->filtro){
			$select->where($this->filtro);
		}

        if($this->search)
        {
            $select->like($this->search);
        }
		
		if($this->ordem!=''){
			$select->ordem($this->ordem);	
		}
		
		$select->limite($this->primeiro_registro,$this->linhas);
		
		$this->data = $select->run();
		if(!is_countable($this->data))
		{
			exit($this->data);
		}
		if(sizeof($this->data) == 0)
		{
			echo '<div class="row">Nenhum registro lançado no momento</div>';
			
		}else{
			$this->open();
			parent::abrelinha();
			//Checkbox para selecionar todos
			$selecionartudo = new TCheckbox('selectall');		
			parent::addcoluna('selecionartudo','',$selecionartudo->exibir());
			if(is_array($this->data) and sizeof($this->data)){

			}else{

			}
			parent::addhead("Ações");
			
			//Gerar cabecalho
			foreach($this->data[0] as $key=>$value)
			{
				if(array_key_exists($key,$this->titles))
				{
					parent::addhead('<a href="#">'.ucfirst(str_replace($key,$this->titles[$key]['nome'],$key)).'</a>');
				}else{
					parent::addhead('<a href="#">'.ucfirst(str_replace('id_','',$key)).'</a>');
				}
				
			}
			
			parent::fechalinha();
			//Gerar as linhas
			foreach($this->data as $key => $values)
			{
				parent::abrelinha();
				/**
				 * Checkbox de cada linha
				 */
				$checkbox = new TCheckbox('id');
				$checkbox->set_value($this->data[$key]->$chave);
				parent::addcoluna('','',$checkbox->exibir());
				/**
				 * Adiciona as funcoes dos botoes
				 */
				$a = array();			
				$buttons ='';
				foreach($this->acoes as $indice => $acao){
					$action = $this->get_acao($acao['metodo'],$acao['imagem'],$this->data[$key]->$chave); 
					$buttons.=$action->exibir();
				}
				 
				parent::addcoluna('dtacoes btn-group','',$buttons);
				//pre($this->joins);
				foreach($values as $coluna=>$valor)
				{
					if($coluna=='data')
					{
						$valor = Data::data_br($valor);
					}				

					if(array_key_exists($coluna,$this->joins))
					{
						if($this->joins[$coluna]['tabela']!='none')
						{
							$select = new Select($this->joins[$coluna]['novocampo'],$this->joins[$coluna]['tabela']);
							$select->where("id='{$valor}'");
							$novosvalores = $select->run();						
							if(sizeof($novosvalores)>0)
							{
								$fk = $novosvalores[0];
								$novocampo = $this->joins[$coluna]['novocampo'];
								$valor =  str_replace($valor,$fk->$novocampo,$valor);
							}else{
								$valor =  str_replace($valor,'-',$valor);
							}
							parent::addcoluna('editable-field',$coluna,$valor);
						}else{
							//pre($this->joins);		
							parent::addcoluna('editable-field',$coluna,$this->joins[$coluna]['novovalor']);
						}
						
					}else{
						parent::addcoluna('editable-field',$coluna,$valor);
					}
				}
				parent::fechalinha();
			}
			$this->close();
			$this->paginate();
			return $this->html;
		}		
	}

	public function paginate()
	{
		$router = new Router();
		$pagina_atual = $this->router->get_pagina();
		$select = new Select($this->campos,$this->entidade);
        if ($this->filtro!='') {
            $select->where($this->filtro);
        }
		$this->data = $select->run();		
		
		//total de paginas
		$this->max_paginas = ceil(sizeof($this->data)/$this->linhas);
		//Pagina anterior = atual - 1
		if($pagina_atual==1)
		{
			$paginaanterior = 1;
		}else{
			$paginaanterior = $pagina_atual - 1;
		}
		
		//Primeiro botao
		$primeira = new TButton('Primeira','button');
		$primeira->setClass('btn btn-default');
		$primeira->setId("primeira");
		$primeira->set_value(1);
		
		//Gerar html da barra de paginas
		$this->html.= '<div>';
		$this->html.= $primeira->exibir();
		//Anterior
		$anterior = new TButton('Anterior','button');
		$anterior->setClass('btn btn-default');
		$anterior->setId("anterior");
		$anterior->set_value($paginaanterior);
		$this->html .= $anterior->exibir();
		//Mostrar 10 números de página
		
		$anteriores = $pagina_atual - 5;
		if($pagina_atual < 5)
		{
			$proximas = $pagina_atual + 9;
		}else{
			$proximas = $pagina_atual + 5;
		}
		
		for($i=$anteriores;$i<$pagina_atual;$i++){
			if($i>0){	
				$this->html.='<button type="button" class="btn btpagina btn-default">'.$i.'</button>';
			}
		}
		//Mostra o botao azul com a pagina atual
		$this->html.='<button type="button" class="btn btpagina btatual btn-primary">'.$i.'</button>';
		for($i=$pagina_atual+1;$i<$proximas;$i++){
			if($i>0 and $i<=$this->max_paginas){	
				$this->html.='<button type="button" class="btn btpagina btn-default">'.$i.'</button>';
			}
		}
		
		
		//Proxima
		//Pagina anterior = atual - 1
		if($pagina_atual==$this->max_paginas)
		{
			$proximapagina = $pagina_atual;
		}else{
			$proximapagina = $pagina_atual + 1;
		}
		$proxima = new TButton('Próxima','button');
		$proxima->setClass('btn btn-default');
		$proxima->setId("proxima");
		$proxima->set_value($proximapagina);
		$this->html .= $proxima->exibir();
		//Ultimo botao
		$ultima = new TButton('Última','button');
		$ultima->setClass('btn btn-default');
		$ultima->setId("ultima");
		$ultimapagina = $this->max_paginas;
		$ultima->set_value($ultimapagina);
		$this->html.= $ultima->exibir();
		$this->html .= '</div>';
		$this->html .= '<div id="resposta"></div>';

	}
}
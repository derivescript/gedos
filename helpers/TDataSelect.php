<?php

namespace helpers;

use database\Connection;

use function core\pre;

/**
 * Campo select que deve ser ligado a uma tabela de dados
 */

class TDataSelect{
	private $id;
	private $nome;			//name do select
	private $texto;			//texto pre-selecionado
	private $schema;
	private $entidade;		//tabela do banco de dados ao qual o select e ligado
	private $padrao; 		//valor selecionado no caso de edicao
	private $texto_opcao;
	private $ordem;
	private $valor;
	private $filtro;
	private $class;
	private $multiple;
	private $join;
	private $size;
	private $target;
	/**
	 * Cria um select a partir de uma tabela do bancos de dados ou de uma view
	 * @param $name = nome do campo
	 * @param $entidade = nome da tabela ou view do banco
	 * @param $ordem = nome da coluna do banco que deve receber a ordenacao
	 */
	public function __construct($nome,$entidade){
		$this->nome=$nome;
		$this->id=$nome;
		$this->entidade=$entidade;		
	}

	public function start($texto){
		$this->texto=$texto;
		return $this->texto;	
	}
	
	public function option($campo){
		$this->texto_opcao=$campo;
		return $this->texto_opcao;
	}
	
	/**
	 * 
	 */
	public function set_order($field)
	{
		$this->ordem = $field;
	}
	/** */
	public function selected($key=''){
		$this->padrao=$key;
		return $this->padrao;
	}
	
	/**
	 * Define qual campo sera usado como valor do select 
	 * @param $valor = valor do campo
	 */	
	public function value($valor){
			$this->valor=$valor;		
			return $this->valor;	
	}
	
	public function join($table,$target,$campo,$extfield)
	{
		$this->join = " join {$table} on {$this->entidade}.{$campo} = {$table}.{$extfield}";
		$this->target = $target;
	}
	/**
	 * Filtro para o select, usado na clausula where
	 * @param where
	 */
	public function filtro($where){
		$this->filtro=$where;
		return $this->filtro;
	} 
	/**
	 * Define o valor do atributo class 
	 */ 
	public function setClass($class){
		$this->class=$class;
		return $this->class;
	}
	/**
	 * 
	 */
	public function multiple($multiple=false)
	{
	    $this->multiple=$multiple;
	}

	public function size($valuesize)
	{
		$this->size = $valuesize;
	}

	public function get_size()
	{
		return $this->size;
	}

	/**
	 * Exibe o select na tela com os dados vindos da tabela.
	 */
	public function exibir(){
		//Abre a conexao com o banco de dados
		$conexao = new Connection($this->schema);
		$pdo = $conexao->connect($this->schema);
		$sql = '';
		$sql .= "SELECT * FROM $this->entidade";
		if($this->join!='')
		{
			$sql .= $this->join;
		}

		if($this->filtro){
			$sql.=" WHERE $this->filtro";	
		}
				 
		if($this->ordem){
			$sql .=" order by $this->ordem";	
		}		
		
		$result = $pdo->query($sql);
		if($result){
			$html = '';
		/*Abre a tag do select*/
			$html .='<select name="'.$this->nome.'" id="'.$this->nome.'" class="'.$this->class.'" aria-hidden="true">'."\n";
			if($this->padrao==0){
				$html .= '<option value="0">'.$this->texto.'</option>'."\n";
			}
			while($linha = $result->fetch(\PDO::FETCH_ASSOC)){
				$html .= '<option value="'.$linha[$this->valor].'"';
				if($this->padrao==$linha[$this->valor]){				
					 $html.= ' selected="selected">';
				}else{
					$html.='>';
				}
				$html .= $this->join!='' ? $linha[$this->target] : $linha[$this->texto_opcao];	
				$html .= '</option>'."\n";
			}	
		}else{
			echo \PDO::ERRMODE_WARNING;
		}		
		$html .= "</select>\n";
		return $html;
	} 	
	
	
}
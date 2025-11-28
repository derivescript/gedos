<?php

namespace database;

use function core\pre;

/**
 * Grava os dados no banco de dados
 */
class Insert{
	private $schema;
	private $entity;
	private $fields = array();
	private $values = array();
	private $consulta;
	private $pdo;
	private $mensagem;

	public function __construct($dbname,$table,$rows)
	{	
		$this->schema = $dbname;
		$this->entity=$table;
		$this->consulta .="INSERT into {$dbname}.{$this->entity}";
		//Nao mecher para cima
		pre($rows);
		exit;
		if(sizeof($rows)>1){
			//Pega os campos do primeiro registro a ser inserido
			$this->fields = array_keys($rows[0]);
			foreach($rows as $row){
				
			}						
		}else{
			$this->fields = array_keys($rows);
		}
		$this->fields = implode(',',$this->fields);
			
		$valores = implode("','",$this->values);
		//Nao mexer para baixo
		$this->consulta .=" ({$this->fields}) values ('{$valores}')"; 
		//Nao mexer para baixo
		$conexao = new Connection($this->schema);
		$this->pdo = $conexao->conectar($this->entity);
	}

	public function run(){
		try{					
			$this->pdo->query($this->consulta);
			return true;
		}catch(\Exception $erro){
			$numeroerro = $erro->getCode();
			//echo $erro->getMessage();
			$erro = new \database\ErroBD($numeroerro);
			$this->mensagem = $erro->getMensagem();
			return false;
		}
	}
    
    public function get_consulta(){
        return $this->consulta;
    }

	public function ultimo_id(){
		$id = $this->pdo->lastInsertId();
		return $id;
	}
	
	public function retorno(){
		return $this->mensagem;
	}
}
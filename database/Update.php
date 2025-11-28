<?php

namespace database;

/**
 * Grava os dados no banco de dados
 */
class Update{

	private $schema;
	private $entity;
	private $fields = array();
	private $values = array();
	private $query;
	private $pdo;
	
	public function __construct($schema,$entity,$fields)
	{
		$this->query .="Update {$schema}.{$entity} set ";
		foreach ($fields as $campo => $valor) {
			$this->fields[$campo]="{$campo}='{$valor}'";	
		}
		$this->query.=implode(',',$this->fields);
		$conexao = new Connection($schema);
		$this->pdo = $conexao->connect($schema);		
	}

	public function where($condicao)
	{
		$this->query.=" where {$condicao}";
	}

	public function run(){
		try{		
			$this->pdo->query($this->query);
			return true;
		}catch(\Exception $erro){
			echo $erro->getMessage();
			return false;
		}
	}
	
	public function get_query(){
		return $this->query;
	}
}
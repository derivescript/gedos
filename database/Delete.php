<?php

namespace database;

class Delete{
	private $id;
	private $consulta;
	private $pdo;
	
	public function setId($id){
		$this->id = $id;
	}

	public function get_id(){
		return $this->id;
	}

	public function __construct($schema,$entity){
		$conexao = new Connection;
		$this->pdo = $conexao->connect($schema);
		$this->consulta.="DELETE FROM {$schema}.{$entity} ";
	}

	public function where($condicao){
		$this->consulta.="where {$condicao}";
	}

	public function andwhere($condicao){
		$this->consulta.=" and {$condicao}";
	}

	public function orwhere($condicao){
		$this->consulta.=" or {$condicao}";
	}

	public function run(){
		try{
			$this->pdo->query($this->consulta);
			return true;
		}catch(\Exception $erro){
			echo $this->get_consulta().br."\n";
			echo $erro->getMessage();
			return false;
		}
	}
	
	public function get_consulta(){
		return $this->consulta;
	}

}
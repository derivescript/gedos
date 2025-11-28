<?php

namespace database;

use database\Connection;

use function core\pre;

class SelectFacade{
	private $driver;
	private $schema;
	private $entity;
	private $query;
	private $rows= array();
	private $fields;
	private $num_fields;
	private $where;
	private $in_limit;
	private $out_limit;
	private $pdo;
	/**
	 * Undocumented function
	 *
	 * @param [type] $fields
	 * @param [type] $schema
	 * @param [type] $entity
	 */
	public function __construct($entity)
	{	
		//$this->schema = $schema;
		$this->entity = $entity;
	}

	public function fields($fields)
	{
		$this->query = "SELECT {$fields} from {$this->entity}";
	}
	/**
	 * Undocumented function
	 *
	 * @param [type] $condicao
	 * @return void
	 */
	public function where($condicao)
	{
		$this->query.=" where {$condicao}";
	}
	/**
	 * 
	 */
	public function andwhere($condicao)
	{
		$this->query.=" and {$condicao} ";
	}
	/**
	 * Undocumented function
	 *
	 * @param [type] $condicao
	 * @return void
	 */
	public function orwhere($condicao)
	{
		$this->query.=" or {$condicao}";
	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function between(){

	}

	public function like()
	{
		
	}
	/**
	 * Undocumented function
	 *
	 * @param [type] $campo
	 * @param [type] $filtro
	 * @return void
	 */
	public function having($campo,$filtro){
		$this->query .= " having {$campo} = {$filtro}";
	}
	/**
	 * Undocumented function
	 *
	 * @param [type] $inicial
	 * @param [type] $final
	 * @return void
	 */
	public function limite($inicial,$final){
		$this->query.=" LIMIT {$inicial},{$final}";				
	}
	/**
	 * Undocumented function
	 *
	 * @param [type] $ordem
	 * @return void
	 */
	public function ordem($ordem,$nivel='ASC')
	{
		$this->query .= " order by {$ordem} {$nivel}";
	}

	public function groupBy($col){
		$this->query .= " group by {$col}";
	}
	/**
	 * 
	 */
	public function not_in($query)
	{
		$this->query.=" not in({$query})";
	}
	
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function get_num_fields(){
		return $this->num_fields;
	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function get_fields(){
		return $this->fields;		
	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function getwhere(){
		return $this->where;
	}		
	/**
	 * Retorna o resultadoa string de uma query
	 *
	 * @return void
	 */
	public function get_query(){
		return $this->query.br;
	}

	public function innerJoin($context)
	{
		$this->query.= "({$context})";
	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function run($query='')
	{
		if($query!= ''){
			$this->query=$query;
		}
		try{
			/**
			 * $con = new Connection($this->schema);
        	 * $pdo = $con->connect($this->schema);
        	 * $run = $pdo->query($query);
			 */
			$con = new Connection($this->schema);
			$this->pdo = $con->connect($this->schema);
			$sql = $this->pdo->query($this->query);
			while($linha = $sql->fetch(\PDO::FETCH_OBJ))
			{
				array_push($this->rows,$linha);
			}
			return $this->rows;
		}catch(\Exception $e){
			return "Erro nos dados! Causa: {$this->query}".$e->getMessage();
		}
	}

	public function getLast()
	{
		echo "Pegando";
	}

	public function first()
	{
		$this->in_limit=1;
	}
}
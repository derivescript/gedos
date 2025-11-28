<?php

namespace database;

use function core\pre;

/**
 * 
 */

class Connection{
	/**
	 * Realiza a conexao com os bancos de dados
	 *
	 * @return void
	 */
	public static $conn;
	private $pdo;
    private static $last;
	
	public function __construct()
	{
		$banco = $this->getconfig();
		$this->pdo = $this->connect($banco['name']);
		return $this->pdo;
	}
	
	public function connect(){
		$config = $this->getconfig();
		switch($config['driver']){
			case 'mysql';
			try{
				$pdo = new \PDO("mysql:host={$config['host']};port={$config['porta']};dbname={$config['name']}", $config['usuario'], $config['senha']);
				$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
				return $pdo;
			}catch(\Exception $erro){
				exit("Nao pude conectar. ".$erro->getMessage());
			}
								
			break;
			case 'postgres';
			
			try{
				$pdo = new \PDO("pgsql:dbname={$config['name']}; user={$config['usuario']}; password={$config['senha']};host={$config['host']};port={$config['porta']};");
				return $pdo;	
			}catch(\Exception $erro){
				exit("Nao pude conectar com o {$config['driver']}. ".$erro->getMessage());
			}	
			break;
			
			case 'firebird':
				$pdo = new \PDO("firebird:dbname={$config['name']}", "{$config['usuario']}", "{$config['senha']}");
				return $pdo;	
			break;	
		}
	}

	public function getconfig(){
		require appdir."/config/database.php";
		return $config;
	}
}
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
	
	public function __construct($schema)
	{
		$this->pdo = $this->connect($schema);
		return $this->pdo;
	}
	
	public function connect($schema)
	{
		$config = $this->getconfig($schema);
		switch($config['driver'])
		{
			case 'mysql';
			try{
				$dsn = "mysql:host={$config['host']};port={$config['porta']};dbname={$config['name']}";
				$options = [
					\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
					\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
					\PDO::ATTR_EMULATE_PREPARES   => false,
				];
				$pdo = new \PDO($dsn, $config['usuario'], $config['senha'],$options);
				$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
				return $pdo;
			}catch(\Exception $erro){
				exit("Nao pude conectar a {$schema}. ".$erro->getMessage());
			}
								
			break;
			case 'postgres';
			
			try
			{
				$pdo = new \PDO("pgsql:dbname={$config['name']}; user={$config['usuario']}; password={$config['senha']};host={$config['host']};port={$config['porta']};");
				return $pdo;	
			}
			catch(\Exception $erro)
			{
				exit("Nao pude conectar. ".$erro->getMessage());
			}	
			break;
			
			case 'firebird':
				$pdo = new \PDO("firebird:dbname={$config['name']}", "{$config['usuario']}", "{$config['senha']}");
				return $pdo;	
			break;	
		}
	}

	public function prepare($sql)
	{
		$this->pdo->prepare($sql);
		return $this->pdo;
	}

	public function getconfig($schema){
		require appdir."/config/database.php";
		return $config[$schema];
	}
}
<?php
/**
* Classe Modulepermissions
*/
namespace apps\models;

use database\DB;
class Modulepermissions{
	/**
	*Lista de atributos
	*/

	private $schema = 'falconi';
	private $id;
	private $descricao;
	private $id_modulo;
	/**
	 *Metodos
	 */
	public function __construct(){

	}
	/**
	 * @var LONG
	 *
	 * @Column(nome="id", type="LONG"
	 */
	 public function setId($valor){	
		 $this->id=$valor;
	}
	/**
	 * @var VAR_STRING
	 *
	 * @Column(nome="descricao", type="VAR_STRING"
	 */
	 public function setDescricao($valor){	
		 $this->descricao=$valor;
	}
	/**
	 * @var LONG
	 *
	 * @Column(nome="id_modulo", type="LONG"
	 */
	 public function setId_modulo($valor){	
		 $this->id_modulo=$valor;
	}
	/**
	 * Retorna o valor do atributo id
	 */
	 public function getId(){
		 return $this->id;
	
	}
	/**
	 * Retorna o valor do atributo descricao
	 */
	 public function getDescricao(){
		 return $this->descricao;
	
	}
	/**
	 * Retorna o valor do atributo id_modulo
	 */
	 public function getId_modulo(){
		 return $this->id_modulo;
	
	}
	/**
	 * Faz a insercao dos dados na tabela
	 */
	public function save(){
		$fields['descricao'] = $this->getId_modulo();
		$fields['id_modulo'] = $this->getId_modulo();
		$handle = DB::table($this->schema,'permissions');;
		 if($handle->save($fields)==true){
			 return true; 
		 }else{
			 return false; 
		}
	 }
	/**
	* Faz o update dos dados na tabela
	*/
	public function atualizar(){
		$fields['id'] = $this->getId_modulo();
		$fields['descricao'] = $this->getId_modulo();
		$fields['id_modulo'] = $this->getId_modulo();
		$handle = DB::table($this->schema,'permissions');;
		 if($handle->save($fields)==true){
			 return true; 
		 }else{
			 return false; 
		}
}
	/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table($this->schema,'permissions');
	if($handle->delete($lines)==true){
		return true;
	}else{
		return false;
	}
}
	/**
	 * Exibe os registros de uma tabela
	 */
	public function listar(){
	//Sua implementacao
	}
	/**
	 * Retorna todos os registros 
	 */
	public function get($id=''){
		$permissions = DB::table('permissions')->get();
		return $permissions;
	}

}
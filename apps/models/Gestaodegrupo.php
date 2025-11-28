<?php
/**
* Classe Gestaodegrupo
*/
namespace apps\models;

use database\DB;
class Gestaodegrupo{
	/**
	*Lista de atributos
	*/

	private $schema = 'falconi';
	private $id;
	private $id_perfil;
	private $id_permissao;
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
	 * @var LONG
	 *
	 * @Column(nome="id_perfil", type="LONG"
	 */
	 public function set_id_perfil($valor){	
		 $this->id_perfil=$valor;
	}
	/**
	 * @var LONG
	 *
	 * @Column(nome="id_permissao", type="LONG"
	 */
	 public function set_id_permissao($valor){	
		 $this->id_permissao=$valor;
	}
	/**
	 * Retorna o valor do atributo id
	 */
	 public function get_id(){
		 return $this->id;
	
	}
	/**
	 * Retorna o valor do atributo id_perfil
	 */
	 public function get_id_perfil(){
		 return $this->id_perfil;
	
	}
	/**
	 * Retorna o valor do atributo id_permissao
	 */
	 public function get_id_permissao(){
		 return $this->id_permissao;
	
	}
	/**
	 * Faz a insercao dos dados na tabela
	 */
	public function inserir(){
		$fields['id_perfil'] = $this->get_id_perfil();
		$fields['id_permissao'] = $this->get_id_permissao();
		$handle = DB::table($this->schema,'profile_permissions');;
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
		$fields['id'] = $this->get_id();
		$fields['id_perfil'] = $this->get_id_perfil();
		$fields['id_permissao'] = $this->get_id_permissao();
		$handle = DB::table($this->schema,'profile_permissions');;
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
	$handle = DB::table($this->schema,'profile_permissions');
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
		$profile_permissions = DB::table('profile_permissions')->get();
		return $profile_permissions;
	}

}
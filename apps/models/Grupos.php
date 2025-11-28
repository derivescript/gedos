<?php
/**
* Classe Grupos
*/
namespace apps\models;

use database\DB;

class Grupos{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $name;
    private $active;
    /**
     * Métodos
     */
    public function __construct() {

    }
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    public function setId($valor) : void {
        $this->id = $valor;
    }
    /**
     *
     * @Column(nome="name", type="VAR_STRING")
     */
    public function setName($valor) : void {
        $this->name = $valor;
    }
    /**
     *
     * @Column(nome="active", type="LONG")
     */
    public function setActive($valor) : void {
        $this->active = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo name
     */
    public function getName() : mixed {
        return $this->name;
    }
    /**
     * Retorna o valor do atributo active
     */
    public function getActive() : mixed {
        return $this->active;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['id'] = $this->getId();
	$fields['name'] = $this->getName();
	$fields['active'] = $this->getActive();
	
	$handle = DB::table('grupos');
	if($handle->save($fields)==true){
		return true; 
	}else{
		return false; 
	}
}/**
	* Faz o update dos dados na tabela
	*/
	public function update(){
	$fields = [];
	if (!is_null($this->getId())) {
			$fields['id'] = $this->getId();
	}
	if (!is_null($this->getName())) {
			$fields['name'] = $this->getName();
	}
	if (!is_null($this->getActive())) {
			$fields['active'] = $this->getActive();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('grupos');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('grupos');
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
		$grupos = DB::table('grupos')->get();
		return $grupos;
	}

}
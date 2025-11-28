<?php
/**
* Classe Cargos
*/
namespace apps\models;

use database\DB;

class Cargos{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $nome;
    private $data_criacao;
    private $ativo;
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
     * @Column(nome="nome", type="VAR_STRING")
     */
    public function setNome($valor) : void {
        $this->nome = $valor;
    }
    /**
     *
     * @Column(nome="data_criacao", type="DATE")
     */
    public function setDataCriacao($valor) : void {
        $this->data_criacao = $valor;
    }
    /**
     *
     * @Column(nome="ativo", type="LONG")
     */
    public function setAtivo($valor) : void {
        $this->ativo = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo nome
     */
    public function getNome() : mixed {
        return $this->nome;
    }
    /**
     * Retorna o valor do atributo data_criacao
     */
    public function getDataCriacao() : mixed {
        return $this->data_criacao;
    }
    /**
     * Retorna o valor do atributo ativo
     */
    public function getAtivo() : mixed {
        return $this->ativo;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['id'] = $this->getId();
	$fields['nome'] = $this->getNome();
	$fields['data_criacao'] = $this->getDataCriacao();
	$fields['ativo'] = $this->getAtivo();
	
	$handle = DB::table('cargos');
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
	if (!is_null($this->getNome())) {
			$fields['nome'] = $this->getNome();
	}
	if (!is_null($this->getDataCriacao())) {
			$fields['data_criacao'] = $this->getDataCriacao();
	}
	if (!is_null($this->getAtivo())) {
			$fields['ativo'] = $this->getAtivo();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('cargos');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('cargos');
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
		$cargos = DB::table('cargos')->get();
		return $cargos;
	}

}
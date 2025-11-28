<?php
/**
* Classe Lotacao
*/
namespace apps\models;

use database\DB;

class Lotacao{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $id_setor;
    private $id_colaborador;
    private $data_inicio;
    private $data_fim;
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
     * @Column(nome="id_setor", type="LONG")
     */
    public function setIdSetor($valor) : void {
        $this->id_setor = $valor;
    }
    /**
     *
     * @Column(nome="id_colaborador", type="LONG")
     */
    public function setIdColaborador($valor) : void {
        $this->id_colaborador = $valor;
    }
    /**
     *
     * @Column(nome="data_inicio", type="DATE")
     */
    public function setDataInicio($valor) : void {
        $this->data_inicio = $valor;
    }
    /**
     *
     * @Column(nome="data_fim", type="DATE")
     */
    public function setDataFim($valor) : void {
        $this->data_fim = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo id_setor
     */
    public function getIdSetor() : mixed {
        return $this->id_setor;
    }
    /**
     * Retorna o valor do atributo id_colaborador
     */
    public function getIdColaborador() : mixed {
        return $this->id_colaborador;
    }
    /**
     * Retorna o valor do atributo data_inicio
     */
    public function getDataInicio() : mixed {
        return $this->data_inicio;
    }
    /**
     * Retorna o valor do atributo data_fim
     */
    public function getDataFim() : mixed {
        return $this->data_fim;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['id'] = $this->getId();
	$fields['id_setor'] = $this->getIdSetor();
	$fields['id_colaborador'] = $this->getIdColaborador();
	$fields['data_inicio'] = $this->getDataInicio();
	$fields['data_fim'] = $this->getDataFim();
	
	$handle = DB::table('lotacoes');
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
	if (!is_null($this->getIdSetor())) {
			$fields['id_setor'] = $this->getIdSetor();
	}
	if (!is_null($this->getIdColaborador())) {
			$fields['id_colaborador'] = $this->getIdColaborador();
	}
	if (!is_null($this->getDataInicio())) {
			$fields['data_inicio'] = $this->getDataInicio();
	}
	if (!is_null($this->getDataFim())) {
			$fields['data_fim'] = $this->getDataFim();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('lotacoes');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('lotacoes');
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
		$lotacoes = DB::table('lotacoes')->get();
		return $lotacoes;
	}

}
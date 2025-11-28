<?php
/**
* Classe solicitacao_revisao
*/
namespace apps\models;

use database\DB;

use function core\pre;

class Revisoes{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    
    private $id;
    private $id_documento;
    private $id_solicitante;
    private $id_solicitado;
    private $data_solicitacao;
    private $status;
    /**
     * Métodos
     */
    public function __construct() {

    }
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    public function setId($valor) : void {
        $this->id = $valor;
    }
    /**
     *
     * @Column(nome="id_documento", type="LONG")
     */
    public function setIdDocumento($valor) : void {
        $this->id_documento = $valor;
    }
    /**
     *
     * @Column(nome="id_solicitante", type="LONG")
     */
    public function setIdSolicitante($valor) : void {
        $this->id_solicitante = $valor;
    }
    /**
     *
     * @Column(nome="id_solicitado", type="LONG")
     */
    public function setIdSolicitado($valor) : void {
        $this->id_solicitado = $valor;
    }
    /**
     *
     * @Column(nome="data_solicitacao", type="DATETIME")
     */
    public function setDataSolicitacao($valor) : void {
        $this->data_solicitacao = $valor;
    }
    /**
     *
     * @Column(nome="status", type="STRING")
     */
    public function setStatus($valor) : void {
        $this->status = $valor;
    }
    
    
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo id_documento
     */
    public function getIdDocumento() : mixed {
        return $this->id_documento;
    }
    /**
     * Retorna o valor do atributo id_solicitante
     */
    public function getIdSolicitante() : mixed {
        return $this->id_solicitante;
    }
    /**
     * Retorna o valor do atributo id_solicitado
     */
    public function getIdSolicitado() : mixed {
        return $this->id_solicitado;
    }
    /**
     * Retorna o valor do atributo data_solicitacao
     */
    public function getDataSolicitacao() : mixed {
        return $this->data_solicitacao;
    }
    /**
     * Retorna o valor do atributo status
     */
    public function getStatus() : mixed {
        return $this->status;
    }
    /**
 * Faz a inserção dos dados na tabela
 */
    public function save(){
	$fields['id'] = $this->getId();
	$fields['id_documento'] = $this->getIdDocumento();
	$fields['id_solicitante'] = $this->getIdSolicitante();
	$fields['id_solicitado'] = $this->getIdSolicitado();
	$fields['data_solicitacao'] = $this->getDataSolicitacao();
	$fields['status'] = $this->getStatus();
	
	$handle = DB::table('solicitacao_revisao');
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
	if (!is_null($this->getIdDocumento())) {
			$fields['id_documento'] = $this->getIdDocumento();
	}
	if (!is_null($this->getIdSolicitante())) {
			$fields['id_solicitante'] = $this->getIdSolicitante();
	}
	if (!is_null($this->getIdSolicitado())) {
			$fields['id_solicitado'] = $this->getIdSolicitado();
	}
	if (!is_null($this->getDataSolicitacao())) {
			$fields['data_solicitacao'] = $this->getDataSolicitacao();
	}
	if (!is_null($this->getStatus())) {
			$fields['status'] = $this->getStatus();
	}
	
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('solicitacao_revisao');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('solicitacao_revisao');
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
		$solicitacao_revisao = DB::table('solicitacao_revisao')->get();
		return $solicitacao_revisao;
	}

    public function find($id)
    {
        $solicitacao_revisao = DB::table('solicitacao_revisao')->where('id='.$id);
        return $solicitacao_revisao[0];
    }

    public function updateFields($fields){
        $solicitacao_revisao = DB::table('solicitacao_revisao')->update($fields);
        if($solicitacao_revisao==true)
        {
            return true;
        }else{
            return false;
        }
    }

}
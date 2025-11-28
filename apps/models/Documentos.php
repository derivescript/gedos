<?php
/**
* Classe documents
*/
namespace apps\models;

use database\DB;
use database\Select;

use function core\pre;

class Documentos{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    
    private $id;
    private $id_type;
    private $class_id;
    private $number;
    private $subject;
    private $identifier;
    private $content;
    private $sector_id;
    private $status;
    private $access_level;
    private $hipotese_legal;
    private $created_by;
    private $created_at;
    private $updated_at;
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
     * @Column(nome="id_type", type="LONG")
     */
    public function setIdType($valor) : void {
        $this->id_type = $valor;
    }
    /**
     *
     * @Column(nome="class_id", type="LONG")
     */
    public function setClassId($valor) : void {
        $this->class_id = $valor;
    }
    /**
     *
     * @Column(nome="number", type="LONG")
     */
    public function setNumber($valor) : void {
        $this->number = $valor;
    }
    /**
     *
     * @Column(nome="subject", type="VAR_STRING")
     */
    public function setSubject($valor) : void {
        $this->subject = $valor;
    }
    /**
     *
     * @Column(nome="identifier", type="VAR_STRING")
     */
    public function setIdentifier($valor) : void {
        $this->identifier = $valor;
    }
    /**
     *
     * @Column(nome="content", type="BLOB")
     */
    public function setContent($valor) : void {
        $this->content = $valor;
    }
    /**
     *
     * @Column(nome="sector_id", type="LONG")
     */
    public function setSectorId($valor) : void {
        $this->sector_id = $valor;
    }
    /**
     *
     * @Column(nome="status", type="STRING")
     */
    public function setAccessLevel($valor) : void {
        $this->access_level = $valor;
    }
     /**
     *
     * @Column(nome="status", type="STRING")
     */
    public function setHipoteseLegal($valor) : void {
        $this->hipotese_legal = $valor;
    }
     /**
     *
     * @Column(nome="status", type="STRING")
     */
    public function setStatus($valor) : void {
        $this->status = $valor;
    }

    /**
     *
     * @Column(nome="created_by", type="LONG")
     */
    public function setCreatedBy($valor) : void {
        $this->created_by = $valor;
    }
    /**
     *
     * @Column(nome="created_at", type="TIMESTAMP")
     */
    public function setCreatedAt($valor) : void {
        $this->created_at = $valor;
    }
    /**
     *
     * @Column(nome="updated_at", type="TIMESTAMP")
     */
    public function setUpdatedAt($valor) : void {
        $this->updated_at = $valor;
    }    
    
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo id_type
     */
    public function getIdType() : mixed {
        return $this->id_type;
    }
    /**
     * Retorna o valor do atributo class_id
     */
    public function getClassId() : mixed {
        return $this->class_id;
    }
    /**
     * Retorna o valor do atributo number
     */
    public function getNumber() : mixed {
        return $this->number;
    }
    /**
     * Retorna o valor do atributo subject
     */
    public function getSubject() : mixed {
        return $this->subject;
    }
    /**
     * Retorna o valor do atributo identifier
     */
    public function getIdentifier() : mixed {
        return $this->identifier;
    }
    /**
     * Retorna o valor do atributo content
     */
    public function getContent() : mixed {
        return $this->content;
    }
    /**
     * Retorna o valor do atributo sector_id
     */
    public function getSectorId() : mixed {
        return $this->sector_id;
    }
    /**
     * Retorna o valor do atributo status
     */
    public function getStatus() : mixed {
        return $this->status;
    }
    /**
     * Retorna o valor do atributo status
     */
    public function getAccessLevel() : mixed {
        return $this->access_level;
    }
    /**
     * Retorna o valor do atributo status
     */
    public function getHipoteseLegal() : mixed {
        return $this->hipotese_legal;
    }
    /**
     * Retorna o valor do atributo created_by
     */
    public function getCreatedBy() : mixed {
        return $this->created_by;
    }
    /**
     * Retorna o valor do atributo created_at
     */
    public function getCreatedAt() : mixed {
        return $this->created_at;
    }
    /**
     * Retorna o valor do atributo updated_at
     */
    public function getUpdatedAt() : mixed {
        return $this->updated_at;
    }
    /**
 * Faz a inserção dos dados na tabela
 */
    public function save(){
	
	$fields['id_type'] = $this->getIdType();
	$fields['class_id'] = $this->getClassId();
	$fields['number'] = $this->getNumber();
	$fields['subject'] = $this->getSubject();
	$fields['identifier'] = $this->getIdentifier();
	$fields['content'] = $this->getContent();
	$fields['sector_id'] = $this->getSectorId();
	$fields['status'] = $this->getStatus();
    $fields['access_level'] = $this->getAccessLevel();
    $fields['hipotese_legal'] = $this->getHipoteseLegal();
	$fields['created_by'] = $this->getCreatedBy();
	$fields['created_at'] = $this->getCreatedAt();

    $handle = DB::table('documents');
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
	if (!is_null($this->getIdType())) {
			$fields['id_type'] = $this->getIdType();
	}
	if (!is_null($this->getClassId())) {
			$fields['class_id'] = $this->getClassId();
	}
	if (!is_null($this->getNumber())) {
			$fields['number'] = $this->getNumber();
	}
	if (!is_null($this->getSubject())) {
			$fields['subject'] = $this->getSubject();
	}
	if (!is_null($this->getIdentifier())) {
			$fields['identifier'] = $this->getIdentifier();
	}
	if (!is_null($this->getContent())) {
			$fields['content'] = $this->getContent();
	}
	if (!is_null($this->getSectorId())) {
			$fields['sector_id'] = $this->getSectorId();
	}
	if (!is_null($this->getStatus())) {
			$fields['status'] = $this->getStatus();
	}
	if (!is_null($this->getCreatedBy())) {
			$fields['created_by'] = $this->getCreatedBy();
	}
	if (!is_null($this->getCreatedAt())) {
			$fields['created_at'] = $this->getCreatedAt();
	}
	if (!is_null($this->getUpdatedAt())) {
			$fields['updated_at'] = $this->getUpdatedAt();
	}
	
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('documents');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('documents');
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
        if($id== ''){
        $documents = DB::table('documents')->get();
		return $documents;
        }else{
            $document = DB::table('documents')->where('id='.$id);
		    return $document[0];
        }
	}

    public function find($id)
    {
        $documents = DB::table('documents')->where('id='.$id);
        return $documents[0];
    }

    public function updateStatus(){
        $fields['id'] = $this->getId();
        $fields['status'] = $this->getStatus();
        $handle = DB::table('documents');
        if($handle->update($fields)==true){
            return true; 
        }else{
            return false; 
        }
    }

    public function updateFields($fields){
        $documents = DB::table('documents')->update($fields);
        if($documents==true)
        {
            return true;
        }else{
            return false;
        }
    }

    public function getLastNumber($id_tipo)
    {
        $select = new Select('Max(number) as number, year(created_at) as created','documents');
		$select->where("id_type='{$id_tipo}'");
		$select->groupBy("YEAR(created_at)");
        $dados = $select->run();
		//Nao existe nenhum documento do tipo esse ano, então é o primeiro
		if(sizeof($dados) == 0){
			$number = 1;
            return $number;
		}else{
		//Pega o ultimo e incrementa o numero	
			$proximo = $dados[0]->number+1;
            return $proximo;
		}
    }

    public function getLastId($id_tipo)
    {
        $select = new Select('id,content','documents');
		$select->where("number = ( SELECT MAX(number) FROM documents WHERE id_type = {$id_tipo} )");
		$dados = $select->run();
        return($dados[0]);
    }

}
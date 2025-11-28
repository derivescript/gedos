<?php
/**
* Classe Modelos
*/
namespace apps\models;

use database\DB;

class Modelos{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $type_id;
    private $model;
    private $content;
    private $created;
    private $published;
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
     * @Column(nome="type_id", type="LONG")
     */
    public function setTypeId($valor) : void {
        $this->type_id = $valor;
    }
    /**
     *
     * @Column(nome="model", type="VAR_STRING")
     */
    public function setModel($valor) : void {
        $this->model = $valor;
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
     * @Column(nome="created", type="DATE")
     */
    public function setCreated($valor) : void {
        $this->created = $valor;
    }
    /**
     *
     * @Column(nome="published", type="LONG")
     */
    public function setPublished($valor) : void {
        $this->published = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo type_id
     */
    public function getTypeId() : mixed {
        return $this->type_id;
    }
    /**
     * Retorna o valor do atributo model
     */
    public function getModel() : mixed {
        return $this->model;
    }
    /**
     * Retorna o valor do atributo content
     */
    public function getContent() : mixed {
        return $this->content;
    }
    /**
     * Retorna o valor do atributo created
     */
    public function getCreated() : mixed {
        return $this->created;
    }
    /**
     * Retorna o valor do atributo published
     */
    public function getPublished() : mixed {
        return $this->published;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['type_id'] = $this->getTypeId();
	$fields['model'] = $this->getModel();
	$fields['content'] = $this->getContent();
	$fields['created'] = $this->getCreated();
	$fields['published'] = $this->getPublished();
	
	$handle = DB::table('doc_models');
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
	if (!is_null($this->getTypeId())) {
			$fields['type_id'] = $this->getTypeId();
	}
	if (!is_null($this->getModel())) {
			$fields['model'] = $this->getModel();
	}
	if (!is_null($this->getContent())) {
			$fields['content'] = $this->getContent();
	}
	if (!is_null($this->getCreated())) {
			$fields['created'] = $this->getCreated();
	}
	if (!is_null($this->getPublished())) {
			$fields['published'] = $this->getPublished();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('doc_models');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('doc_models');
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
		if($id=='')
		{
			$modelos = DB::table('doc_models')->get();
			return $modelos;
		}else{
			$modelo = DB::table('doc_models')->where("id=$id");
			return $modelo[0];
		}
		
	}
}
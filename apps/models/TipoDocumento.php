<?php
/**
* Classe TipoDocumento
*/
namespace apps\models;

use database\DB;

class TipoDocumento{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $type;
    private $description;
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
     * @Column(nome="type", type="VAR_STRING")
     */
    public function setType($valor) : void {
        $this->type = $valor;
    }
    /**
     *
     * @Column(nome="description", type="VAR_STRING")
     */
    public function setDescription($valor) : void {
        $this->description = $valor;
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
     * Retorna o valor do atributo type
     */
    public function getType() : mixed {
        return $this->type;
    }
    /**
     * Retorna o valor do atributo description
     */
    public function getDescription() : mixed {
        return $this->description;
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
	$fields['type'] = $this->getType();
	$fields['description'] = $this->getDescription();
	$fields['created'] = $this->getCreated();
	$fields['published'] = $this->getPublished();
	
	$handle = DB::table('doc_types');
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
	if (!is_null($this->getType())) {
			$fields['type'] = $this->getType();
	}
	if (!is_null($this->getDescription())) {
			$fields['description'] = $this->getDescription();
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
	$handle = DB::table('doc_types');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('doc_types');
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
		$doc_types = DB::table('doc_types')->get();
		return $doc_types;
	}

      public function find($id)
    {
        $classes = DB::table('doc_types')->where('id='.$id);
        return $classes[0];
    }

}
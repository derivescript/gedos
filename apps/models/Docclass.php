<?php
/**
* Classe doc_classes
*/
namespace apps\models;

use database\DB;

use function core\pre;

class Docclass{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    
    private $id;
    private $code;
    private $code_parent;
    private $name;
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
    
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    public function setId($valor) : void {
        $this->id = $valor;
    }
    /**
     *
     * @Column(nome="code", type="DOUBLE")
     */
    public function setCode($valor) : void {
        $this->code = $valor;
    }
    /**
     *
     * @Column(nome="code_parent", type="DOUBLE")
     */
    public function setCodeParent($valor) : void {
        $this->code_parent = $valor;
    }
    /**
     *
     * @Column(nome="name", type="BLOB")
     */
    public function setName($valor) : void {
        $this->name = $valor;
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
     * Retorna o valor do atributo code
     */
    public function getCode() : mixed {
        return $this->code;
    }
    /**
     * Retorna o valor do atributo code_parent
     */
    public function getCodeParent() : mixed {
        return $this->code_parent;
    }
    /**
     * Retorna o valor do atributo name
     */
    public function getName() : mixed {
        return $this->name;
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
    }
    /**
 * Faz a inserção dos dados na tabela
 */
    public function save(){
	$fields['id'] = $this->getId();
	$fields['code'] = $this->getCode();
	$fields['code_parent'] = $this->getCodeParent();
	$fields['name'] = $this->getName();
	$fields['created'] = $this->getCreated();
	$fields['published'] = $this->getPublished();
	
	$handle = DB::table('doc_classes');
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
	if (!is_null($this->getCode())) {
			$fields['code'] = $this->getCode();
	}
	if (!is_null($this->getCodeParent())) {
			$fields['code_parent'] = $this->getCodeParent();
	}
	if (!is_null($this->getName())) {
			$fields['name'] = $this->getName();
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
	$handle = DB::table('doc_classes');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('doc_classes');
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
		$doc_classes = DB::table('doc_classes')->get();
		return $doc_classes;
	}

    public function find($id)
    {
        $doc_classes = DB::table('doc_classes')->where('id='.$id);
        return $doc_classes[0];
    }

    public function updateFields($fields){
        $doc_classes = DB::table('doc_classes')->update($fields);
        if($doc_classes==true)
        {
            return true;
        }else{
            return false;
        }
    }

}
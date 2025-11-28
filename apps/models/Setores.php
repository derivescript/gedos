<?php
/**
* Classe Setores
*/
namespace apps\models;

use database\DB;
class Setores{
	/**
	*Lista de atributos
	*/

	private $schema = 'falconi';
	private $id;
	private $name;
	private $sigla;
	private $description;
	private $created_at;
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
	 * @Column(nome="name", type="VAR_STRING"
	 */
	 public function setName($valor){	
		 $this->name=$valor;
	}
	/**
	 * @var VAR_STRING
	 *
	 * @Column(nome="sigla", type="VAR_STRING"
	 */
	 public function setSigla($valor){	
		 $this->sigla=$valor;
	}
	/**
	 * @var BLOB
	 *
	 * @Column(nome="description", type="BLOB"
	 */
	 public function setDescription($valor){	
		 $this->description=$valor;
	}
	/**
	 * @var DATE
	 *
	 * @Column(nome="created_at", type="DATE"
	 */
	 public function setCreated_at($valor){	
		 $this->created_at=$valor;
	}
	/**
	 * Retorna o valor do atributo id
	 */
	 public function getId(){
		 return $this->id;
	
	}
	/**
	 * Retorna o valor do atributo name
	 */
	 public function getName(){
		 return $this->name;
	
	}
	/**
	 * Retorna o valor do atributo sigla
	 */
	 public function getSigla(){
		 return $this->sigla;
	
	}
	/**
	 * Retorna o valor do atributo description
	 */
	 public function getDescription(){
		 return $this->description;
	
	}
	/**
	 * Retorna o valor do atributo created_at
	 */
	 public function getCreated_at(){
		 return $this->created_at;
	
	}
	/**
	 * Faz a insercao dos dados na tabela
	 */
	public function save(){
		$fields['name'] = $this->getName();
		$fields['sigla'] = $this->getSigla();
		$fields['description'] = $this->getDescription();
		$fields['created_at'] = $this->getCreated_at();
		$handle = DB::table('sectors');;
		if($handle->save($fields)==true){
			return true; 
		}else{
			return false; 
		}
	 }
	/**
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
	if (!is_null($this->getSigla())) {
			$fields['sigla'] = $this->getSigla();
	}
	if (!is_null($this->getDescription())) {
			$fields['description'] = $this->getDescription();
	}
	if (!is_null($this->getCreated_at())) {
			$fields['created_at'] = $this->getCreated_at();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('sectors');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table($this->schema,'sectors');
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
			$setores = DB::table('sectors')->get();
			return $setores;
		}else{
			$setor = DB::table('sectors')->where("id=$id");
			return $setor[0];
		}		
	}

	public function getNomePorDono($id){
		$setores = DB::table("sectors")->where("id={$id}");
		$nome = $setores[0]->name;
		return $nome;
	}

	public function getSiglaPorDono($id){
		$setores = DB::table("sectors")->where("id={$id}");
		$sigla = $setores[0]->sigla;
		return $sigla;
	}
}
<?php
/**
* Classe tipo_processos
*/
namespace apps\models;

use database\DB;

use function core\pre;

class Tipoprocesso{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    
    private $id;
    private $descricao;
    private $publicado;
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
     * @Column(nome="descricao", type="VAR_STRING")
     */
    public function setDescricao($valor) : void {
        $this->descricao = $valor;
    }
    /**
     *
     * @Column(nome="publicado", type="LONG")
     */
    public function setPublicado($valor) : void {
        $this->publicado = $valor;
    }
    
    
    /**
     * Retorna o valor do atributo id
     */
    public function getId() : mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo descricao
     */
    public function getDescricao() : mixed {
        return $this->descricao;
    }
    /**
     * Retorna o valor do atributo publicado
     */
    public function getPublicado() : mixed {
        return $this->publicado;
    }
    /**
 * Faz a inserção dos dados na tabela
 */
    public function save(){
	$fields['id'] = $this->getId();
	$fields['descricao'] = $this->getDescricao();
	$fields['publicado'] = $this->getPublicado();
	
	$handle = DB::table('tipo_processos');
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
	if (!is_null($this->getDescricao())) {
			$fields['descricao'] = $this->getDescricao();
	}
	if (!is_null($this->getPublicado())) {
			$fields['publicado'] = $this->getPublicado();
	}
	
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('tipo_processos');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('tipo_processos');
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
		$tipo_processos = DB::table('tipo_processos')->get();
		return $tipo_processos;
	}

    public function find($id)
    {
        $tipo_processos = DB::table('tipo_processos')->where('id='.$id);
        return $tipo_processos[0];
    }

    public function updateFields($fields){
        $tipo_processos = DB::table('tipo_processos')->update($fields);
        if($tipo_processos==true)
        {
            return true;
        }else{
            return false;
        }
    }

}
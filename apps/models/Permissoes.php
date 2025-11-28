<?php
/**
* Classe Permissoes
*/
namespace apps\models;

use database\DB;
use League\Flysystem\Exception;

class Permissoes{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $nome;
    private $descricao;
    private $id_modulo;
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
     * @Column(nome="descricao", type="VAR_STRING")
     */
    public function setDescricao($valor) : void {
        $this->descricao = $valor;
    }
    /**
     *
     * @Column(nome="id_modulo", type="LONG")
     */
    public function setIdModulo($valor) : void {
        $this->id_modulo = $valor;
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
     * Retorna o valor do atributo descricao
     */
    public function getDescricao() : mixed {
        return $this->descricao;
    }
    /**
     * Retorna o valor do atributo id_modulo
     */
    public function getIdModulo() : mixed {
        return $this->id_modulo;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['id'] = $this->getId();
	$fields['nome'] = $this->getNome();
	$fields['descricao'] = $this->getDescricao();
	$fields['id_modulo'] = $this->getIdModulo();
	
	$handle = DB::table('permissions');
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
	if (!is_null($this->getDescricao())) {
			$fields['descricao'] = $this->getDescricao();
	}
	if (!is_null($this->getIdModulo())) {
			$fields['id_modulo'] = $this->getIdModulo();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('permissions');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('permissions');
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
		$permissions = DB::table('permissions')->get();
		return $permissions;
	}

    public function can($iduser,$modulo,$permission)
    {
        //pegar os dados do modulo
        $modulo = DB::table('modules')->where("nome='{$modulo}'");

        //pegar a permissao na tabela permissions        
        $permissao = DB::table("permissions")->where("nome='{$permission}'");
        
        //verifica se há permissão pessoal para esse usuario
        $userPermission = DB::table("user_permissions")->where("id_permissao={$permissao[0]->id} and id_modulo={$modulo[0]->id} and id_usuario={$iduser}");
        if(empty($userPermission)){
            return false;
        }else{
            return true;
        }
        //verificar se há permissao de grupo

        //verificar se ha permissao de perfil
    }

}
<?php
/**
 * Classe Profiles
 */
namespace apps\models;

use database\DB;

use database\Select;
use function core\pre;

class Profiles {
    /**
     * Lista de atributos
     */
    private $schema = 'falconi';
    private $id;
    private $nome;
    /**
     * Métodos
     */
    public function __construct() {

    }
    /**
     * @var LONG
     *
     * @Column(nome="id", type="LONG")
     */
    public function setId($valor): void {
        $this->id = $valor;
    }
    /**
     * @var VAR_STRING
     *
     * @Column(nome="nome", type="VAR_STRING")
     */
    public function setNome($valor): void {
        $this->nome = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId(): mixed {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo nome
     */
    public function getNome(): mixed {
        return $this->nome;
    }
    /**
     * Faz a inserção dos dados na tabela
     */
    public function save() {
        
    }/**
	* Faz o update dos dados na tabela
	*/
	public function update(): bool{
	$fields = [];
	if (!is_null($this->getId())) {
			$fields['id'] = $this->getId();
	}
	if (!is_null($this->getNome())) {
			$fields['nome'] = $this->getNome();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('perfis');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('perfis');
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
			$perfis = DB::table('user_profiles')->where("id_usuario={$_SESSION['id']}");
			return $perfis;
		}
	}

	public function maxLevel($id_usuario)
	{
		//Verifica quais perfis o usuario possui na tabela user_profiles
		$profilesUser = DB::table("user_profiles")->where("id_usuario=$id_usuario");
		$profiles = new Select('nivel', 'perfis');
		if(!empty($profilesUser)){
			$first = $profilesUser[0];
		}else{
			echo "Usuario sem perfil";
		}
		
		$profiles->where("id={$first->id_perfil}");
		unset($profilesUser[0]);
		foreach($profilesUser as $profile){
			$profiles->orwhere("id={$profile->id_perfil}");
		}
		$profiles->ordem("nivel","desc");
		$dados = $profiles->run();
		return $dados[0];		
	}
}
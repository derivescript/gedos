<?php
/**
* Classe Users
*/
namespace apps\models;

use database\DB;

use function core\pre;

class Users{
/**
* Lista de atributos
*/
private $schema = 'falconi';

    private $id;
    private $username;
    private $password;
    private $name;
    private $email;
    private $createdAt;
    /**
     * Métodos
     */
    public function __construct() {

    }
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    public function setId($valor) {
        $this->id = $valor;
    }
    /**
     *
     * @Column(nome="username", type="VAR_STRING")
     */
    public function setUsername($valor) {
        $this->username = $valor;
    }
    /**
     *
     * @Column(nome="password", type="VAR_STRING")
     */
    public function setPassword($valor) {
        $this->password = $valor;
    }
    /**
     *
     * @Column(nome="name", type="VAR_STRING")
     */
    public function setName($valor) {
        $this->name = $valor;
    }
    /**
     *
     * @Column(nome="email", type="VAR_STRING")
     */
    public function setEmail($valor) {
        $this->email = $valor;
    }
    /**
     *
     * @Column(nome="createdAt", type="DATE")
     */
    public function setCreatedAt($valor) {
        $this->createdAt = $valor;
    }
    /**
     * Retorna o valor do atributo id
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Retorna o valor do atributo username
     */
    public function getUsername() {
        return $this->username;
    }
    /**
     * Retorna o valor do atributo password
     */
    public function getPassword() {
        return $this->password;
    }
    /**
     * Retorna o valor do atributo name
     */
    public function getName() {
        return $this->name;
    }
    /**
     * Retorna o valor do atributo email
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * Retorna o valor do atributo createdAt
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }/**
 * Faz a inserção dos dados na tabela
 */
public function save(){
	$fields['username'] = $this->getUsername();
	$fields['password'] = $this->getPassword();
	$fields['name'] = $this->getName();
	$fields['email'] = $this->getEmail();
	$fields['created_at'] = $this->getCreatedAt();
	
	$handle = DB::table('users');
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
	if (!is_null($this->getUsername())) {
			$fields['username'] = $this->getUsername();
	}
	if (!is_null($this->getPassword())) {
			$fields['password'] = $this->getPassword();
	}
	if (!is_null($this->getName())) {
			$fields['name'] = $this->getName();
	}
	if (!is_null($this->getEmail())) {
			$fields['email'] = $this->getEmail();
	}
	if (!is_null($this->getCreatedAt())) {
			$fields['createdAt'] = $this->getCreatedAt();
	}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}	
   	
	$handle = DB::table('users');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('users');
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
		$users = DB::table('users')->get();
		return $users;
	}

    public function find($id)
    {
        $users = DB::table('users')->where('id='.$id);
        return $users[0];
    }

    public function updateFields($fields){
        $users = DB::table('users')->update($fields);
        if($users==true)
        {
            return true;
        }else{
            return false;
        }
    }

}
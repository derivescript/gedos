<?php
/**
* Classe {entity}
*/
namespace {namespace};

use database\DB;

use function core\pre;

class {upperentity}{
/**
* Lista de atributos
*/
private $schema = '{dbname}';

    {attributes}
    /**
     * Métodos
     */
    public function __construct() {

    }
    /**
     *
     * @Column(nome="id", type="LONG")
     */
    {setters}
    
    {getters}
    /**
 * Faz a inserção dos dados na tabela
 */
    public function save(){
	{fields}
	$handle = DB::table('{entity}');
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
	{updateFields}
	
	if (empty($fields)) {
	// nada a atualizar
	return false;
	}			
	$handle = DB::table('{entity}');
	if($handle->update($fields)==true){
		return true; 
	}else{
		return false; 
	}

}		/**
	* Faz a remocao de um registro da tabela
	*/
	public function excluir($lines){
	$handle = DB::table('{entity}');
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
		${entity} = DB::table('{entity}')->get();
		return ${entity};
	}

    public function find($id)
    {
        ${entity} = DB::table('{entity}')->where('id='.$id);
        return ${entity}[0];
    }

    public function updateFields($fields){
        ${entity} = DB::table('{entity}')->update($fields);
        if(${entity}==true)
        {
            return true;
        }else{
            return false;
        }
    }

}
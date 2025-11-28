<?php
namespace apps\controllers;

use database\DB;
use database\Update;
use helpers\TDatagrid;
use helpers\Toolbar;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\mapToArray;
use function core\pre;

class GrupoController extends \core\Controller
{
/**
* ----------------------------------------------------------------------
* Método inicial
* ----------------------------------------------------------------------
*/
	public function index()
	{
		$this->listar();
	} // end index

	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function add(){
		openbox('Cadastrar novo ','');
		$this->view('grupos/form-add');
		closebox();
	}        
	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function save()
	{
		$grupo = $this->model('Grupos'); 
		$grupo->setName(filterpost('name'));
		$grupo->setActive(filterpost('active'));		
		if($grupo->save()==true)
		{
			$dados['titulo'] = 'Cadastro de grupo';
			$dados['mensagem'] = 'Grupo cadastrado com sucesso!';
			$this->view('modal',$dados);
		}else{
		echo "Houve um problema ao salvar os dados em grupos";
		}
		$this->listar();						
	} //fim save
	
	/** 
	* ----------------------------------------------------------------------
	* Método edit - Abre um registro para edição
	* -----------------------------------------------------------------------
	*/  
	public function editar($id)
	{
		openbox('Editar grupo','');
		$grupos = DB::table('grupos')->where("id=$id");
		$dados = mapToArray($grupos[0]);
	
		$this->view('grupos/form-edit',$dados);
		closebox();
	}
	/** 
	* ----------------------------------------------------------------------
	* Método update - Atualiza um registro
	* -----------------------------------------------------------------------
	*/    
	public function update()
	{
		$grupo = $this->model('Grupo'); 
		$grupo->setId(filterpost('id'));
		$grupo->setName(filterpost('name'));
		$grupo->setActive(filterpost('active'));
		
		if($grupo->update()==true)
		{
			$dados['titulo'] = 'Editar grupo';
			$dados['mensagem'] = 'Grupo editado com sucesso!';
			$this->view('modal',$dados);
		}else{
			$dados['titulo'] = 'Editar grupo';
			$dados['mensagem'] = "Houve um problema ao salvar os dados em grupo";
			$this->view('modalerro',$dados);
		
		}						
	} //fim editar

	/** 
	* ----------------------------------------------------------------------
	* Método listar - Cria uma datagrid com os dados de uma entidade
	* -----------------------------------------------------------------------
	*/    
	public function listar(){
		
		$toolbar = new Toolbar('novo,editar,excluir');
		openbox('');		
		$lista = new TDatagrid('*','grupos');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();  
	} // end listar  
	
	public function editarcampo(){
		//$classe =  $this->model('Docclass');
		$id = filterpost('id');
		unset($_POST['id']);
		foreach($_POST as $campo=>$valor){
		$campos[$campo]=$valor;
		}
	    
		$update = new Update('falconi','grupos',$campos);
		$update->where("id={$id}");
		if($update->run()==true){
       		$dados['titulo'] = "Alterar nome de grupo";
			$dados['mensagem'] = "Nome alterado com sucesso!";
			$this->view('modal',$dados);
			
		}else{
			$dados['titulo'] = "Alterar nome de grupo";
			$dados['mensagem'] = "Erro ao alterar!";
			$this->view('modalerro',$dados);
		}
		
	}
}//fim
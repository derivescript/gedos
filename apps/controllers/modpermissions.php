<?php
namespace apps\controllers;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\pre;

class ModpermissionsController extends \core\Controller
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
		$this->view('modules/form-add');
		closebox();
	}        
	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function save()
	{
		$modpermissions = $this->model('Modpermissions'); 
		$modpermissions->setId(filterpost('id'));
		$modpermissions->setDescricao(filterpost('descricao'));
		$modpermissions->setId_modulo(filterpost('id_modulo'));
		
		if($modpermissions->save()==true)
		{
			$dados['titulo'] = 'Cadastro de {tabela}';
			$dados['mensagem'] = '{tabela} cadastrado com sucesso!';
			$this->view('modal',$dados);
		}else{
		echo "Houve um problema ao salvar os dados em {tabela}";
		}						
	} //fim save
	
	/** 
	* ----------------------------------------------------------------------
	* Método edit - Abre um registro para edição
	* -----------------------------------------------------------------------
	*/  
	public function edit($id)
	{
		openbox('Editar {tabela}','');
		$this->view('modules/form-edit');
		closebox();
	}
	/** 
	* ----------------------------------------------------------------------
	* Método update - Atualiza um registro
	* -----------------------------------------------------------------------
	*/    
	public function update()
	{
		$modpermissions = $this->model('Modpermissions'); 
		$modpermissions->setId(filterpost('id'));
		$modpermissions->setDescricao(filterpost('descricao'));
		$modpermissions->setId_modulo(filterpost('id_modulo'));
		
		if($modpermissions->update()==true)
		{
			$dados['titulo'] = 'Editar {tabela}';
			$dados['mensagem'] = '{tabela} editada com sucesso!';
			$this->view('modal',$dados);
		}else{
		echo "Houve um problema ao salvar os dados em {tabela}";
		}						
	} //fim editar

	/** 
	* ----------------------------------------------------------------------
	* Método listar - Cria uma datagrid com os dados de uma entidade
	* -----------------------------------------------------------------------
	*/    
	public function listar(){
		openbox('');
		new ToolbarPadrao();
		$lista = new TDatagrid('*','permissions');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();  
	} // end listar    
}//fim
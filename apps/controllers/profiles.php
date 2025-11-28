<?php
namespace apps\controllers;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\pre;

class ProfilesController extends \core\Controller
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
		$this->view('profiles/form-add');
		closebox();
	}        
	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function save()
	{
		$profiles = $this->model('Profiles'); 
		$profiles->setNome(filterpost('nome'));		
		if($profiles->save()==true)
		{
			$dados['titulo'] = 'Cadastro de perfil';
			$dados['mensagem'] = 'Perfil cadastrado com sucesso!';
			$this->view('modal',$dados);
		}else{
		echo "Houve um problema ao salvar os dados em perfis";
		}						
	} //fim save
	
	/** 
	* ----------------------------------------------------------------------
	* Método edit - Abre um registro para edição
	* -----------------------------------------------------------------------
	*/  
	public function editar($id)
	{
		openbox('Editar {tabela}','');
		$this->view('profiles/form-edit');
		closebox();
	}
	/** 
	* ----------------------------------------------------------------------
	* Método update - Atualiza um registro
	* -----------------------------------------------------------------------
	*/    
	public function update()
	{
		$profiles = $this->model('Profiles'); 
		$profiles->setId(filterpost('id'));
		$profiles->setNome(filterpost('nome'));
		
		if($profiles->update()==true)
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
		$lista = new TDatagrid('*','falconi','perfis');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();  
	} // end listar    
}//fim
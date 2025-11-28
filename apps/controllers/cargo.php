<?php
namespace apps\controllers;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use helpers\TSelect;

use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\pre;

class CargoController extends \core\Controller
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
		$this->view('cargos/form-add');
		closebox();
	}        
	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function save()
	{
		$cargos = $this->model('Cargos'); 
		$cargos->setId(filterpost('id'));
		$cargos->setNome(filterpost('nome'));
		$cargos->setDataCriacao(filterpost('data_criacao'));
		$cargos->setAtivo(filterpost('ativo'));
		
		if($cargos->save()==true)
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
	public function editar($id)
	{
		$cargos = $this->model('Cargos');
		$cargo = $cargos->get($id);
		$dados['nome'] = $cargo->nome;
		$dados['id'] = $cargo->id;
		$dados['data_criacao'] = $cargo->data_criacao;
		if($cargo->ativo==0)
		{
			$ativo = <<<PHP
				<option value="0" selected>Não</option>
				<option value="1">Sim</option>
			PHP;
		}else{
			$ativo = <<<PHP
				<option value="0">Não</option>
				<option value="1" selected>Sim</option>
			PHP;
		}
		$dados['ativo'] = $ativo;
		openbox('Editar cargo','');
		$this->view('cargos/form-edit',$dados);
		closebox();
	}
	/** 
	* ----------------------------------------------------------------------
	* Método update - Atualiza um registro
	* -----------------------------------------------------------------------
	*/    
	public function update()
	{
		$cargos = $this->model('Cargos'); 
		$cargos->setId(filterpost('id'));
		$cargos->setNome(filterpost('nome'));
		$cargos->setDataCriacao(filterpost('data_criacao'));
		$cargos->setAtivo(filterpost('ativo'));
		
		if($cargos->update()==true)
		{
			$dados['titulo'] = 'Editar cargo';
			$dados['mensagem'] = 'Cargo editado com sucesso!';
			$this->view('modal',$dados);
		}else{
		echo "Houve um problema ao salvar os dados em {tabela}";
		}			
		
		$this->listar();
	} //fim editar

	/** 
	* ----------------------------------------------------------------------
	* Método listar - Cria uma datagrid com os dados de uma entidade
	* -----------------------------------------------------------------------
	*/    
	public function listar(){
		openbox('');
		new ToolbarPadrao();
		$lista = new TDatagrid('*','cargos');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();  
	} // end listar    
}//fim
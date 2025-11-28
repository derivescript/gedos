<?php 
namespace apps\controllers;

use database\DB;
use helpers\DATA;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;

use function core\baseUrl;
use function core\closebox;
use function core\filterpost;
use function core\mapToArray;
use function core\openbox;
use function core\pre;
use function core\redirect;

class SetoresController extends \core\Controller{
/** 
	* ----------------------------------------------------------------------
* Método inicial
* -----------------------------------------------------------------------
*/
	public function index(){ 
				//Implementacao 
	}
// end index

/** 
* ----------------------------------------------------------------------
* Método cadastro - Coleta os dados para enviar ao banco
* -----------------------------------------------------------------------
*/
	public function add(){
		openbox('Cadastrar novo setor','');
			$this->view('setores/form-add');
		closebox();
	}
// end add

/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
	public function editar($id){ 
		openbox('Editar setor','');
			$setor = $this->model('Setores')->get($id);
			$dados = mapToArray($setor[0]);
			$dados['baseurl'] = baseUrl();
			$this->view('setores/form-edit',$dados);
		closebox();
	}
// end editar

public function save()
{
	$setor = $this->model('Setores');
	$setor->setName(filterpost('name'));
	$setor->setSigla(filterpost('sigla'));
	$setor->setDescription(filterpost('description'));
	$setor->setCreated_at(date("Y-m-d"));
	if($setor->save()==true){
		$dados['titulo'] = 'Cadastro de setor';
        $dados['mensagem'] = 'Setor cadastrado com sucesso!';
        $this->view('modal',$dados);
	}else{
		echo "Houve um problema ao criar o usuario"; 
	}		
}
/** 
* ----------------------------------------------------------------------
* Método listar - Cria uma datagrid com os dados de uma entidade
* -----------------------------------------------------------------------
*/
	public function listar(){ 
		new ToolbarPadrao();
		openbox('');	
		$lista = new TDatagrid('*','sectors');
		$lista->action('editar','edit','#resposta');
		$lista->action('excluir','edit','#resposta');
		echo $lista->view();
		closebox();
	}
	// end listar 

	public function excluir($id=""){
		$lines = array();
		if(isset($id) && $id!=''){
			$lines[0] = $id;
		}
		if(isset($_POST['valores']))
		{
			foreach($_POST['valores'] as $key=>$id )
			{
				$lines[$key] = $id;
			}
		}
		
		$setor = $this->model('Setores');
		if($setor->delete($lines)==true)
		{
			$dados['titulo'] = "Exclusão de setor";
        	$dados['mensagem'] = "Registros excluídos com sucesso!";
        	$this->view('modal',$dados);			
		}
	}

	public function update(){ 
		//posts
		$setor = $this->model('Setores');
		$setor->setName(filterpost('name'));
		$setor->setDescription(filterpost('description'));
		$setor->setSigla(filterpost('sigla'));
		$setor->setCreated_at(filterpost('created_at'));
		$setor->setId(filterpost('id'));
		if($setor->update()==true){
			$dados['titulo'] = "Atualizar setor";
        	$dados['mensagem'] = "Setor atualizado com sucesso!";
        	$this->view('modal',$dados);			
		}else{
			echo "Houve um problema atualizar o setor"; 
		}		
	}

	public function editarcampo(){
		$setor =  $this->model('Setores');
		$id = filterpost('id');
		unset($_POST['id']);
		$setor->setId($id);
		foreach($_POST as $field=>$value)
		{
			if($field!=''){
				$metodo = "set".ucfirst($field);
				$setor->$metodo($value);
			}
		}
		if($setor->update()==true)
		{

			$dados['titulo'] = "Altera&ccedil;&atilde;o de setor";
			$dados['mensagem'] = "Setor alterado com sucesso!";
			$this->view('modal',$dados);

		}else{
			$dados['titulo'] = "Altera&ccedil;&atilde;o de setor";
			$dados['mensagem'] = "Erro ao alterar registro!";
			$this->view('modal-erro',$dados);
		}
	}
}
	
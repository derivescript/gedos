<?php 
namespace apps\controllers; 

use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\pre;
class ProcessosController extends \core\Controller{
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
* Método add - Coleta os dados para enviar ao banco
* -----------------------------------------------------------------------
*/
	public function add(){
		openbox('Cadastrar novo ','');
			$this->view('pasta/view');
		closebox();
	}
	
// end cadastro

public function addtipo(){
		openbox('Cadastrar novo ','');
			$this->view('processos/add-tipo');
		closebox();
	}
/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
public function editar($id){ 
		//Implementacao 
	}
// end editar

public function save()
{
	$processos = $this->model('Processos');
	$processos->set_name(filterpost(''));
	$processos->set_sigla(filterpost(''));
	$processos->set_description(filterpost(''));
	$processos->set_created_at(date('Y-m-d'));
if($processos->save()==true){
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
	openbox('');
	new ToolbarPadrao();
	$lista = new TDatagrid('*','processes');
	$lista->action('editar','edit','#ajax-content');
	echo $lista->view();
	closebox();
	}
// end listar 
}
	
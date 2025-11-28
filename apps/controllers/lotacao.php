<?php 
namespace apps\controllers;

use helpers\CampoBusca;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\filterpost;
use function core\openbox;
class LotacaoController extends \core\Controller{
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
		openbox('Adicionar nova lotação ','');
			$colaborador = new TDataSelect('id_colaborador','users');
			$colaborador->setClass('form-control populate select2');
			$colaborador->value('id');
			$colaborador->option('name');
			$dados['colaborador'] = $colaborador->exibir();
			$setor = new TDataSelect('id_setor','sectors');
			$setor->setClass('form-control populate select2');
			$setor->value('id');
			$setor->option('name');
			$dados['setor'] = $setor->exibir();
			$this->view('setores/lotacao-add',$dados);
		closebox();
	}
// end cadastro

/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
public function editar($id){ 
	openbox('Editar lotação ','');
			$this->view('setores/lotacao-edit');
	closebox();
}
// end editar

public function save()
{
	//Implementacao
		
		$lotacao = $this->model('Lotacao');
		$lotacao->set_id_setor(filterpost('id_setor'));
		$lotacao->set_id_colaborador(filterpost('id_colaborador'));
		$lotacao->set_data_inicio(filterpost('data_inicio'));
		$lotacao->set_data_fim('2030-01-01');
		if($lotacao->save()==true){
			$dados['titulo'] = 'Definir lotação de usuário';
			$dados['mensagem'] = 'Lotação definida com sucesso!';
			$this->view('modal',$dados);
			$this->listar();
		}else{
			echo "Houve um problema ao fazer a lotação"; 
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
	echo '<label class="col-sm-8">Filtrar por nome</label>';
	$filtro = new TDataSelect('user','users');
	$filtro->option('name');
	$filtro->value('id');
	$filtro->setClass('form-control select2');
	echo $filtro->exibir();
	$lista = new TDatagrid('*','lotacoes');
	$lista->rename_title('data_inicio','Início da lotação');
	$lista->rename_title('data_fim','Fim da lotação');
	$lista->replaceField('id_setor','sectors','name');
	$lista->replaceField('id_colaborador','users','name');
	$lista->action('editar','edit','#ajax-content');
	echo $lista->view();
	closebox();
	}
// end listar 
}
	
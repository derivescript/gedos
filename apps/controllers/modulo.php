<?php 
namespace apps\controllers;

use database\DB;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use helpers\TSelect;

use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\mapToArray;
use function core\pre;
class ModuloController extends \core\Controller{
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
		openbox('Cadastrar novo ','');
		$areas = DB::table('module_areas')->get();
		$selectarea = new TSelect('id_area');
		$items = array();
		foreach($areas as $area){
			$items[$area->id]=$area->name;
		}	
		$selectarea->setItems($items);
		$selectarea->setClass('form-control select2');
		$dados['selectareas'] = $selectarea->exibir();
		$this->view('modules/form-add',$dados);
		closebox();
	}
// end cadastro

/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
	public function editar($id){ 
		$modulos = DB::table('modules')->where("id=$id");
		$modulo = mapToArray($modulos[0]);	
		$this->view('modules/form-edit',$modulo);
	}
	// end editar

	public function save()
	{
		
		$modulo = $this->model('Modulos');
		$modulo->set_id_area(filterpost('id_area'));
		$modulo->set_nome(filterpost('nome'));
		$modulo->set_ativo(filterpost('ativo'));
		if($modulo->save()==true){
			$dados['titulo'] = 'Cadastro de módulo';
			$dados['mensagem'] = 'Módulo cadastrado com sucesso!';
			$this->view('modal',$dados);
			$this->listar();
		}else{
			echo "Houve um problema ao criar o módulo";
		}
	}
/** 
* ----------------------------------------------------------------------
* Método listar - Cria uma datagrid com os dados de uma entidade
* -----------------------------------------------------------------------
*/
	public function listar(){ 
		openbox('Relação de módulos');
		new ToolbarPadrao();
		$lista = new TDatagrid('*','modules');
		$lista->replaceField('id_area','module_areas','name');
		$lista->replaceValue('ativo','1','Sim');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();
		}
	// end listar 

	public function update()
	{

	}
}
	
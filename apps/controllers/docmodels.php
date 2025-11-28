<?php
namespace apps\controllers;

use database\DB;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\ToolbarPadrao;
use helpers\TSelect;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\mapToArray;
use function core\pre;

class DocmodelsController extends \core\Controller
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
		$doctype = new TDataSelect('type_id','doc_types');
		$doctype->setClass('form-control select2');
		$doctype->set_order('type');
		$doctype->value('id');
		$doctype->option('type');
		$dados['tipodocumento'] = $doctype->exibir();
		$this->view('documentos/form-model-add',$dados);
	}        
	/** 
	* ----------------------------------------------------------------------
	* Método add - Coleta os dados para enviar ao banco
	* -----------------------------------------------------------------------
	*/    
	public function save()
	{
		$docmodels = $this->model('Modelos'); 
		$docmodels->setId(filterpost('id'));
		$docmodels->setTypeId(filterpost('type_id'));
		$docmodels->setModel(filterpost('model'));
		$docmodels->setContent(filterpost('content'));
		$docmodels->setCreated(date('Y-m-d'));
		$docmodels->setPublished('1');
		
		if($docmodels->save()==true)
		{
			$dados['titulo'] = 'Cadastro de modelo';
			$dados['mensagem'] = 'Modelo criado com sucesso!';
			$this->view('modal',$dados);
		}else{
			$dados['titulo'] = 'Cadastro de modelo';
			$dados['mensagem'] = "Erro ao salvar";
			$this->view('modalerro',$dados);
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
		$modelos = $this->model('Modelos')->get($id);
		$modelo = mapToArray($modelos);
		$doctype = new TDataSelect('tipo','doc_types');
		$doctype->setClass('form-control select2');
		$doctype->set_order('type');
		$doctype->value('id');
		$doctype->option('type');
		$doctype->selected($id);
		$modelo['tipodocumento'] = $doctype->exibir();
		$this->view('documentos/form-model-edit',$modelo); 
	}
	/** 
	* ----------------------------------------------------------------------
	* Método update - Atualiza um registro
	* -----------------------------------------------------------------------
	*/    
	public function update()
	{
		$docmodels = $this->model('Docmodels'); 
		$docmodels->setId(filterpost('id'));
		$docmodels->setType_id(filterpost('type_id'));
		$docmodels->setModel(filterpost('model'));
		$docmodels->setContent(filterpost('content'));
		$docmodels->setCreated(filterpost('created'));
		$docmodels->setPublished(filterpost('published'));
		
		if($docmodels->update()==true)
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
	public function listar(): void{
		openbox('');
		new ToolbarPadrao();
		$lista = new TDatagrid('id,type_id,class_id,model','doc_models');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();  
	} // end listar    

	public function filtrarTipo(): void{
		$idtipo = $_POST['valores']['tipo'];
		$modelos = new TDataSelect('modelo','doc_models');
		$modelos->filtro("type_id=$idtipo");
		$modelos->option("model");
		$modelos->value("id");
		//$modelos->selected(1);
		$modelos->setClass('form-control select2');
		echo $modelos->exibir();
	}

	public function buscarClasse(): void{
		$idmodelo = $_POST['valores']['modelo'];
		$modelo = DB::table('doc_models')->where("id={$idmodelo}");
		$classes = DB::table('doc_classes')->get('id,LPAD(code,3,0) AS code,name',"id={$modelo[0]->class_id}");
		$select = new TSelect('class_id');
		$opcoes[$classes[0]->id] = $classes[0]->code.'-'.$classes[0]->name;
		$select->setItems($opcoes);
		$select->selected($classes[0]->id);
		$select->setClass('form-control');
		echo $select->exibir();
	}
}//fim
<?php 
namespace apps\controllers; 

use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\openbox;
use function core\filterpost;
use function core\mapToArray;
use function core\pre;
class TipodocumentoController extends \core\Controller{
/** 
	* ----------------------------------------------------------------------
* Método inicial
* -----------------------------------------------------------------------
*/
	public function index(){ 
		$this->listar();
	}
// end index

/** 
* ----------------------------------------------------------------------
* Método cadastro - Coleta os dados para enviar ao banco
* -----------------------------------------------------------------------
*/
	public function add(){
		openbox('Novo tipo de documento','');
			$this->view('documentos/tipo-add');
		closebox();
	}
// end cadastro

/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
public function editar($id){ 
	openbox('Editar tipo de documento');
	$tipos = $this->model('TipoDocumento');
	$tipo = $tipos->find($id);
	if($tipo->published==1)
	{
		$options = '<option selected value="1">Sim</option><option value="0">Não</option>';
	}else{
		$options = '<option value="1">Sim</option><option selected value="0">Não</option>';
	}
	$dados = mapToArray($tipo);
	$dados['published'] = $options;
	$this->view('documentos/form-tipo-edit',$dados);
	closebox();
}
// end editar

public function save()
{
	$tipodocumento = $this->model('TipoDocumento');
	$tipodocumento->setType(filterpost('type'));
	$tipodocumento->setDescription(filterpost('description'));
	$tipodocumento->setCreated(date('Y-m-d'));
	$tipodocumento->setPublished(filterpost('published'));
	if($tipodocumento->save()==true){
		$dados['titulo'] = 'Cadastrar tipo de documento';
		$dados['mensagem'] = 'Registro cadastrado com sucesso!';
		$this->view('modal',$dados);
	}else{
		echo "Houve um problema ao criar o usuario";
	}
	$this->listar();
}

public function update()
{
	$tipodocumento = $this->model('Tipodocumento');
	$tipodocumento->set_type(filterpost('type'));
	$tipodocumento->set_description(filterpost('description'));
	$tipodocumento->set_created_at(date('Y-m-d'));
	$tipodocumento->set_published(filterpost('published'));
	if($tipodocumento->save()==true){
		$dados['titulo'] = 'Cadastrar tipo de documento';
		$dados['mensagem'] = 'Registro cadastrado com sucesso!';
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
	$lista = new TDatagrid('*','doc_types');
	$lista->action('editar','edit','#ajax-content');
	echo $lista->view();
	closebox();
	}
// end listar 
}
	
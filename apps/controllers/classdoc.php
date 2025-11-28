<?php 
namespace apps\controllers;

use database\DB;
use database\Update;
use helpers\TDatagrid;
use helpers\ToolbarPadrao;
use function core\closebox;
use function core\filter_array;
use function core\openbox;
use function core\filterpost;
use function core\mapToArray;
use function core\pre;
class ClassDocController extends \core\Controller
{
/** 
	* ----------------------------------------------------------------------
* Método inicial
* -----------------------------------------------------------------------
*/
	public function index(){ 
		$this->listar();
	} // end index

/** 
* ----------------------------------------------------------------------
* Método add - Coleta os dados para enviar ao banco
* -----------------------------------------------------------------------
*/
	public function add(){
		openbox('Cadastrar novo ','');
		$classesdc = DB::table('doc_classes')->get('LPAD(code,3,0) AS code,name,code_parent','',["order"=>'code asc']);
		$superclasses = '';
		foreach($classesdc as $class){
			if($class->code_parent == ''){
				$superclasses .= '<option value="'.$class->code.'">'.$class->code.' - '.$class->name.'</option>';
			}			
		}
			$this->view('documentos/form-class-add',['superclasses'=>$superclasses]);
		closebox();
	}

	public function addsub(){
		openbox('Cadastrar nova subclasse','');
		$classesdc = DB::table('doc_classes')->get('LPAD(code,3,0) AS code,name,code_parent','',["order"=>'code asc']);
		$superclasses = '';
		foreach($classesdc as $class){
			if($class->code_parent == ''){
				$superclasses .= '<option value="'.$class->code.'">'.$class->code.' - '.$class->name.'</option>';
			}			
		}
			$this->view('documentos/form-sub-class-add',['superclasses'=>$superclasses]);
		closebox();
	}
// end cadastro

	public function save()
	{
		$classdoc = $this->model('Docclass');
		$classdoc->setCode(filterpost('code'));
		$classdoc->setName(filterpost('name'));
		$classdoc->setCreated(date('Y-m-d'));
		$classdoc->setPublished(filterpost('published'));
		if($classdoc->save()==true){
			$dados['titulo'] = 'Cadastrar classe de documento';
			$dados['mensagem'] = 'Classe cadastrada com sucesso!';
			$this->view('modal',$dados);
		}else{
			echo "Houve um problema ao criar o usuario";
		}
		$this->listar();
	}
	public function savesub()
	{
		$classdoc = $this->model('Docclass');
		$classdoc->setCode(filterpost('code'));
		$classdoc->setName(filterpost('name'));
		$classdoc->setCreated(date('Y-m-d'));
		$classdoc->setPublished(filterpost('published'));
		if($classdoc->save()==true){
			$dados['titulo'] = 'Cadastrar classe de documento';
			$dados['mensagem'] = 'Classe cadastrada com sucesso!';
			$this->view('modal',$dados);
		}else{
			echo "Houve um problema ao criar o usuario";
		}
		$this->listar();
	}
	/** 
* ----------------------------------------------------------------------
* Método editar - Edita um registro
* -----------------------------------------------------------------------
*/
	public function update()
	{
		$classdoc = $this->model('Docclass');
		$classdoc->setId(filterpost('id'));
		$classdoc->setCode(filterpost('code'));
		$classdoc->setName(filterpost('name'));
		$classdoc->setCreated(filterpost('created'));
		$classdoc->setPublished(filterpost('published'));
		if($classdoc->update()==true){
			$dados['titulo'] = 'Editar classe de documento';
			$dados['mensagem'] = 'Classe alterada com sucesso!';
			$this->view('modal',$dados);
			}else{
			echo "Houve um problema ao salvar os dados";
		}
		$this->listar();
	}
// end editar

/** 
* ----------------------------------------------------------------------
* Método listar - Cria uma datagrid com os dados de uma entidade
* -----------------------------------------------------------------------
*/
	public function listar(){ 
		openbox('Classes de documentos','');
		new ToolbarPadrao();
		$lista = new TDatagrid('*','doc_classes');
		$lista->action('editar','edit','#ajax-content');
		echo $lista->view();
		closebox();
	} // end listar 

	public function editar($id)	
	{	
		$classes = $this->model('Docclass'); // corrigido
		$classe = $classes->find($id);  // supondo que exista esse método no model		
		openbox('Editar classe de documento','');
		$dados = mapToArray($classe);
		if($dados['published']==0)
		{
			$dados['options'] = '<option selected value="0">Não</option><option value="1">Sim<option>';
		}else{
			$dados['options'] = '<option value="0">Não</option><option selected value="1">Sim<option>';
		}
		$this->view('documentos/form-class-edit',$dados);
		closebox();
	} 

	public function editarcampo(){
		//$classe =  $this->model('Docclass');
		$id = filterpost('id');
		unset($_POST['id']);
		foreach($_POST as $campo=>$valor){
		$campos[$campo]=$valor;
		}
	    
		$update = new Update('falconi','doc_classes',$campos);
		$update->where("id={$id}");
		if($update->run()==true){
       		$dados['titulo'] = "Altera&ccedil;&atilde;o de classe";
			$dados['mensagem'] = "Classe alterada com sucesso!";
			$this->view('modal',$dados);
			
		}else{
			$dados['titulo'] = "Altera&ccedil;&atilde;o de classe";
			$dados['mensagem'] = "Erro ao alterar!";
			$this->view('modalerro',$dados);
		}
		
	}

	public function check()
	{
		$code = $_POST['code'];
		$codigo = DB::table('doc_classes')->where("code='{$code}'");
		if(isset($codigo[0]))
		{
			echo "O codigo já está cadastrado no sistema.";
		}
	}
		
}
<?php 
namespace apps\controllers;

use database\DB;
use Helpers\Classbuilder;
use helpers\TDatagrid;
use database\Select;
use helpers\DATA;
use Helpers\Permissions;

use function core\baseUrl;
use function core\filterpost;
use function core\pre;
use function core\redirect;

class HomeController extends \core\Controller{
	public function index(){ 
		if(!isset($_SESSION['nome']))
		{
			redirect('login');
		}	
		
		$menu = $this->model('AdminMenus');		  
		$this->template('index','dashboard',[
			'baseurl'=>baseUrl(),
			'acao'=>'Painel principal',
			'nome'=>$_SESSION['nome'],
			'saudacao'=>'Ola, '.$_SESSION['nome'].'!',
			'menu'=>$menu->exibir()
		]);
	}

	public function dashboard()
	{
		
		$this->view('dashboard');
	}

	
	public function listar()
	{
		/* $user = $this->model('User');
		pre($user->get()); */
		$grid = new TDatagrid('*','users');
		$grid->actions('editar,excluir');
		echo $grid->view();
	}

	public function out()
	{
		session_start();
		session_destroy();
		redirect('login');
	}

	public function session()
	{
		$uri = $_SERVER['REQUEST_URI'];
		if(!isset($_SESSION['id'])){
			echo "Usuario nao logado";
		}
	}

	public function test(){
		$tabela = 'documents';
		$builder = new Classbuilder();
		$campos = $builder->getFields($tabela);
		pre($campos);
		
	}

	public function pa()
	{
		$variavel = '{{ documento_data_emissao_por_extenso }}';
		$conteudo = "Documento emitido em {$variavel}";
		$busca = DB::table('doc_vars')->where("varname='{$variavel}'");
		$replace = date('d').' de '.DATA::get_mes(date('Y-m-d')).' de '.date('Y');
		if (preg_match('/^date\((.*)\)$/', $replace, $m)) {
            // Extrai o formato de data
            $format = trim($m[1], "'\" "); 
            $replace = date($format);
        }else{
			echo "A data nao confere".br;
		}

		echo str_replace("$variavel",$replace,$conteudo);
	}
}
	
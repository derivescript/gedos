<?php

namespace apps\controllers;

use AdminMenus;
use database\Select;
use database\Update;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\TSelect;

use function core\closebox;
use function core\filterpost;
use function core\get_function_list;
use function core\openbox;
use function core\pre;

class FuncoesController extends \core\Controller{

	public function index(){
		$this->add();
	}

	public function add(){
		openbox('Cadastro de função','Funções para o menu administrativo');
		//Lista de menus pai
		$menupai = new TDataSelect('id_parent','admin_menus','nome');
        $menupai->start('Escolha um menu');
        $menupai->setClass('form-control');
        $menupai->value('id');
        $menupai->option('nome');
        $dados['selectpai'] = $menupai->exibir();
		//Nivel
		$nivel = new TSelect('nivel');
        $nivel->setClass('form-control');
        $nivel->popular(30);
        $dados['nivel'] = $nivel->exibir();
        //Ordem
        $ordem = new TSelect('ordem');
        $ordem->setClass('form-control');
        $ordem->popular(30);
        $dados['ordem'] = $ordem->exibir();
        //Lista de funcoes
        $listafuncoes = get_function_list('/');
        $funcoes= new TSelect('href');
        $funcoes->setClass('form-control');
        $funcoes->setItems($listafuncoes); 
        $dados['listafuncoes'] = $funcoes->exibir();
		$last_level= new Select('MAX(nivel_menu) as maximo','admin_menus');
		$last_ordem = new Select('MAX(ordem) as maximo_ordem','admin_menus');
		$level = $last_level->run();
		$order = $last_ordem->run();
		$dados['nivel'] = $level[0]->maximo;
		$dados['maxordem'] = $order[0]->maximo_ordem;
		$this->view('funcoes/cadfuncoes',$dados);
		closebox();
	}
    
    public function editar($id)
    {
        openbox('Editar função','Editar um menu administrativo');
		//Lista de menus pai
		$menupai = new TDataSelect('id_parent','admin_menus','nome');
        $menupai->start('Escolha um menu');
        $menupai->setClass('form-control select2');
        $menupai->value('id');
        $menupai->option('nome');
        $dados['selectpai'] = $menupai->exibir();
		//Nivel
		$nivel = new TSelect('nivel');
        $nivel->setClass('form-control');
        $nivel->popular(30);
        $dados['nivel'] = $nivel->exibir();
        //Ordem
        $ordem = new TSelect('ordem');
        $ordem->setClass('form-control');
        $ordem->popular(30);
        $dados['ordem'] = $ordem->exibir();
        //Lista de funcoes
        $listafuncoes = get_function_list();
        $funcoes= new TSelect('href');
        $funcoes->setClass('form-control');
        $funcoes->setItems($listafuncoes); 
        $dados['listafuncoes'] = $funcoes->exibir();
		$this->template('vazio','funcoes/editar-funcao',$dados);
		closebox();
    }

	public function excluir($id=',')
	{
		$lines = array();
		if(isset($_POST['valores']))
		{
			foreach($_POST['valores'] as $key=>$id )
			{
				$lines[$key] = $id;
			}
		}else{
			$lines[0] = $id;
		}
		
		$menu = $this->model('AdminMenus');
		if($menu->delete($lines)==true)
		{
			$dados['titulo'] = "Exclusão de usuários";
        	$dados['mensagem'] = "Registros excluídos com sucesso!";
        	$this->view('modal',$dados);
		}
	}
    
	public function salvar(){
		$menu = $this->model('AdminMenus');
		$menu->set_id_parent((int)filterpost('id_parent'));
		$menu->set_nome(filterpost('nome'));
		$menu->set_icone($_POST['icone']);
		$menu->set_href($_POST['href']);
		$menu->set_nivel_menu($_POST['nivel']);
		$menu->set_ordem($_POST['ordem']);
		if($menu->save()==true){
			echo "Menu criado com sucesso!";
		}else{
			echo "Houve um problema ao criar o menu"; 
		}		
	}

	public function listar(){
		openbox('Menu administração','Itens do painel administrativo');
		$grid = new TDatagrid('*','admin_menus');
		$grid->linhas(15);
		$grid->action('editar','edit');
		$grid->action('excluir','trash');
		$grid->replaceField('id_parent','admin_menus','nome');
		$this->view('funcoes/lista-funcoes',['lista'=>$grid->view()]);
		closebox();
	}

	public function atualizamenu(){
		require (appdir.'/administracao/model/AdminMenus.php');
		$menu = $this->model('AdminMenus');
		$menu->exibir();
	}

	public function editarcampo(){
		$id = filterpost('id');
		unset($_POST['id']);
		foreach($_POST as $campo=>$valor)
		{
			$campos[$campo] = htmlentities($valor);
		}
		$update = new Update('falconi','admin_menus',$campos);
		$update->where("id={$id}");
		$dados['titulo'] = "Alterar função";
		if($update->run()==true){
			$dados['mensagem'] = "Função alterada com sucesso!";
			$this->view('modal',$dados);
		}else{		
			$dados['mensagem'] = "Não foi possível aterar o registro!";
			$this->view('modal-erro',$dados);
		}
	}

	public function icones()
	{
		$tipo = filterpost('tipo');
		switch($tipo){
			case 'solid':
				$this->view('funcoes/solid-icons');	
			break;
			
			case 'regular':
				$this->view('funcoes/regular-icons');
			break;

			case 'brand':
				$this->view('funcoes/brand-icons');
			break;
		}
	}
	public function buscafuncoes()
	{
		//Lista de funcoes
		$listafuncoes = get_function_list();
		foreach($listafuncoes as $endereco=>$funcao)
		{
			echo '<option value="'.$endereco.'">'.$funcao.'</option>';
		}
	}
}

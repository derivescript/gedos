<?php
namespace apps\controllers;

use apps\models\Permissoes;
use database\DB;
use helpers\DATA;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\Toolbar;

use function core\closebox;
use function core\filterpost;
use function core\mapToArray;
use function core\openbox;
use function core\pre;

class UserController extends \core\Controller
{
    public function index()
    {
        $this->listar();
    }

    public function add()
    {
        openbox('Novo usuário','');
        $this->view('users/formadd');
        closebox();
    }

    public function save()
    {
        $users = $this->model('Users');
        $users->setId(filterpost('id'));
		$users->setUsername(filterpost('username'));
		$password = password_hash(filterpost('password'), PASSWORD_DEFAULT);
		$users->setPassword($password);
		$users->setName(filterpost('name'));
		$users->setEmail(filterpost('email'));
		$users->setCreatedAt(DATA::datanow());
		
        if($users->save() === true) {
                $dados['titulo'] = 'Cadastrar novo(a) {tabela}';
                $dados['mensagem'] = '{Tabela} cadastrado com sucesso!';
                $this->view('modal',$dados);                
            } else {
                $dados['titulo'] = 'Cadastrar novo(a) {tabela}';
                $dados['mensagem'] = 'Erro ao salvar novo registro em {tabela}!';
                $this->view('modalerro',$dados);                
        }		
        $this->listar();
    }

    public function editar($id)
    {
        $permissao = $this->model('Permissoes');
        if($permissao->can($_SESSION['id'],'Pessoal','edit_pessoa')==false)
        {
            echo '<div class="alert alert-danger">
			<h4>Acesso negado!</h4>
			<p>Você não tem permissão para acessar essa função</p>
		</div>';
        /*  */}
        $user = $this->model('Users'); // corrigido
        $usuario = $user->find($id);  // supondo que exista esse método no model
        openbox('Editar usuário','');
        $perfil = new TDataSelect('perfil','perfis');
        $perfil->setClass('form-control select2');
        $perfil->option('nome');
        $perfil->value('id');
        $dados = mapToArray($usuario);
        $dados['perfil'] = $perfil->exibir();
        $this->view('users/formedit',$dados);
        closebox();
    }

    public function update()
    {
        openbox('{addtitle}','{addsub}');
        $users = $this->model('Users');
        $users->setId(filterpost('id'));
		$users->setUsername(filterpost('username'));
		$password = password_hash(filterpost('password'), PASSWORD_DEFAULT);
		$users->setPassword($password);
		$users->setName(filterpost('name'));
		$users->setEmail(filterpost('email'));
        
        if($users->update() === true) 
        {
                $dados['titulo'] = 'Alterar {tabela}';
                $dados['mensagem'] = '{Tabela} alterada com sucesso!';
                $this->view('modal',$dados);                
        } else {
                $dados['titulo'] = 'Alterar {tabela}';
                $dados['mensagem'] = 'Erro ao salvar novo registro em {tabela}!';
                $this->view('modalerro',$dados);                
        }	
        closebox();
    }

   public function editarcampo(): void
	{
		$fields = $_POST;
		$users = $this->model('Users');
		if ($users->updateFields($fields)) {
			$dados['titulo'] = "Alteração de dados";
			$dados['mensagem'] = "Dados alterados com sucesso!";
			$this->view('modal',$dados);
		} else {
			$dados['titulo'] = 'Alterar {tabela}';
            $dados['mensagem'] = 'Erro ao gravar as mudanças em {tabela}!';
            $this->view('modalerro',$dados);  
		}
	}

	/**
	* Faz a remoção de um registro da tabela
	*/
	public function excluir($id=''): void
	{
		$lines = array();
		if (isset($id) && $id!='') {
			$lines[0] = $id;
		}
		if (isset($_POST['valores'])) {
			foreach ($_POST['valores'] as $key=>$id ) {
				$lines[$key] = $id;
			}
		}
		
		$users = $this->model('Users');
		if ($users->delete($lines) === true) {
			$dados['titulo'] = "Exclusão de {tabela}";
        	$dados['mensagem'] = "Registros excluídos com sucesso!";
        	$this->view('modal',$dados);
		}
	}

    public function listar()
    {
        $toolbar = new Toolbar('novo,editar,excluir');
		openbox('Listagem de usuários');
        $grid = new TDatagrid('id,username,name,email,created_at','users');
        $permissao = $this->model('Permissoes');
        if($permissao->can($_SESSION['id'],'Pessoal','edit_pessoa')==true)
        {
            $grid->action('editar','edit','#ajax-content');
        }                
        echo $grid->view();
        closebox();
    }
}
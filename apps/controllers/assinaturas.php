<?php
namespace apps\controllers;

use database\DB;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\Toolbar;

use function core\closebox;
use function core\filterpost;
use function core\mapToArray;
use function core\openbox;
use function core\pre;

class AssinaturasController extends \core\Controller
{
    public function index()
    {
        $this->listar();
    }

    public function add()
    {
        openbox('{addtitle}','{addsub}');
        $this->view('{view}');
        closebox();
    }

    public function save()
    {
        $solicitacao_assinatura = $this->model('Solicitacao_assinatura');
        $solicitacao_assinatura->setId(filterpost('id'));
		$solicitacao_assinatura->setIdDocumento(filterpost('id_documento'));
		$solicitacao_assinatura->setIdSolicitante(filterpost('id_solicitante'));
		$solicitacao_assinatura->setIdSolicitado(filterpost('id_solicitado'));
		$solicitacao_assinatura->setDataSolicitacao(filterpost('data_solicitacao'));
		$solicitacao_assinatura->setStatus(filterpost('status'));
		
        if($solicitacao_assinatura->save() === true) {
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
        openbox('{edititle}','{editsub}');
        $this->view('{editview}');
        closebox();
    }

    public function update()
    {
         openbox('{addtitle}','{addsub}');
         $solicitacao_assinatura = $this->model('Solicitacao_assinatura');
         $solicitacao_assinatura->setId(filterpost('id'));
		$solicitacao_assinatura->setIdDocumento(filterpost('id_documento'));
		$solicitacao_assinatura->setIdSolicitante(filterpost('id_solicitante'));
		$solicitacao_assinatura->setIdSolicitado(filterpost('id_solicitado'));
		$solicitacao_assinatura->setDataSolicitacao(filterpost('data_solicitacao'));
		$solicitacao_assinatura->setStatus(filterpost('status'));
		
        if($solicitacao_assinatura->save() === true) 
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
		$id = filterpost('id');
		unset($_POST['id']);

		$solicitacao_assinatura = $this->model('Solicitacao_assinatura');
		if ($solicitacao_assinatura->updateFields($_POST, $id)) {
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
		
		$solicitacao_assinatura = $this->model('Solicitacao_assinatura');
		if ($solicitacao_assinatura->delete($lines) === true) {
			$dados['titulo'] = "Exclusão de {tabela}";
        	$dados['mensagem'] = "Registros excluídos com sucesso!";
        	$this->view('modal',$dados);
		}
	}

    public function listar()
    {
        $toolbar = new Toolbar('novo,editar,excluir');
		openbox('Listagem de usuários');
        $grid = new TDatagrid('colunas','tabela');
        $grid->action('editar','edit','#ajax-content');
        echo $grid->view();
        closebox();
    }
}
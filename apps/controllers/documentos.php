<?php
namespace apps\controllers;

use database\DB;
use database\Select;
use helpers\Breadcrumb;
use helpers\DATA;
use helpers\Tabela;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\Toolbar;

use function core\basedir;

use function core\closebox;
use function core\filter_array;
use function core\filterpost;
use function core\gerarAuthCode;
use function core\mapToArray;
use function core\openbox;
use function core\pre;
use function core\redirect;

class DocumentosController extends \core\Controller
{
    public function index()
    {
        $this->listar();
    }

    public function add()
    {
        	//Permissions::can($_SESSION['id'],'Administracao','add_document');
		openbox('Criar documento de texto');
		$doctype = new TDataSelect('tipo','doc_types');
		$doctype->setClass('form-control select2');
		$doctype->set_order('type');
		$doctype->value('id');
		$doctype->option('type');
		$model = new TDataSelect('modelo','doc_models');
		$model->setClass('form-control select2');
		$model->set_order('model');
		$model->value('id');
		$model->option('model');
		$dados['tipodocumento'] = $doctype->exibir();
		$dados['modelodocumento'] = $model->exibir();
		$urlOut = $_SERVER['REQUEST_URI'];
		if(isset($_SESSION['id'])){
			$id_colaborador = $_SESSION['id'];
		}else{
			redirect('login#'.$urlOut);
		}
		
		$lotacoes = DB::table('lotacoes')->get('id_setor',"id_colaborador={$id_colaborador}");
		$options = '';
		foreach($lotacoes as $key=>$setor){
			$thesetor = DB::table('sectors')->get('id,sigla',"id={$setor->id_setor}");
			$options .='<option value="'.$thesetor[0]->id.'">'.$thesetor[0]->sigla.'</option>';
		}
		$dados['setores'] = $options;
		//pre($setores);
		$this->view('documentos/form-dados',$dados);
		closebox();
    }

    public function save()
    {
		$documents = $this->model('Documentos');
		$documents->setIdType(filterpost('tipo')); 
		$documents->setClassId(filterpost('class_id'));
		$numero = $documents->getLastNumber(filterpost('tipo'));
		$documents->setNumber($numero);
		$documents->setSubject(filterpost('subject'));
		$ano = date('Y');
		//Definir identificador
		$setor = $this->model('Setores')->get(filterpost('sector'));
		$tipo = $this->model('TipoDocumento')->find(filterpost('tipo'));
		$identificador = "$tipo->type Nº {$numero}/{$ano} - {$setor->sigla}";
		$documents->setIdentifier($identificador);
		//Trazer o conteúdo da tabela de modelos de documento (doc_models)
		$modelo = $this->model('Modelos')->get(filterpost('modelo'));	
		$documents->setContent($modelo->content);
		$documents->setSectorId(filterpost('sector'));
		$documents->setStatus('draft');
		$documents->setAccessLevel(filterpost('access_level'));
		if(filterpost('hipotese') == '---')
		{
			$documents->setHipoteseLegal(0);
		}else{
			$documents->setHipoteseLegal(filterpost('hipotese'));
		}
		
		$documents->setCreatedBy($_SESSION['id']);
		$documents->setCreatedAt(DATA::datetimeNow());
		if($documents->save() == true) {
			$newdocument = $documents->getLastId(filterpost('tipo'));
			$dados['id'] = $newdocument->id;
			$dados['content'] = $newdocument->content;
			$this->view('documentos/form-edit-text',$dados);						  
		} else {
               echo "Erro ao salvar";        
		}
	}		
    
	public function edittext($id)
	{
		$newdocument = $this->model("Documentos")->find($id);
		$dados['id'] = $newdocument->id;
		$dados['content'] = $newdocument->content;
		$this->view('documentos/form-edit-text',$dados);	

	}

	public function updatetext()
	{
		$id = filterpost('id');
		$content = $this->replaceVars(filterpost('content'),$id);
		//Verificar variaveis
		$documento = $this->model('Documentos');
		$documento->setId($id);
		$documento->setContent($content);
		$documento->setUpdatedAt(DATA::datetimeNow());
		
		if($documento->update()==true){
			redirect('documentos/visualizar/'.$id);
		}else{
			echo "Deu ruim";
		}
		
	}
    public function editar($id)
    {
        openbox('{edititle}','{editsub}');
        $this->view('{editview}');
        closebox();
    }

	public function visualizar($id)
	{
		$documento = $this->model('Documentos')->find($id);
			
		$dados['content'] = $documento->content;
		$dados['id'] = $id;
		//Documento com assinatura requisitada
		if($documento->status=='sign_requested')
		{
			$breadcrumb = new Breadcrumb('draft,done,sign_requested,signed,finished','sign_requested');
		}else if($documento->status=='in_review')
		{
			$breadcrumb = new Breadcrumb('draft,done,in_review,reviewed,finished','in_review');
		}else{
			$breadcrumb = new Breadcrumb('draft,done,signed,finished',$documento->status);
		}
		switch ($documento->status) {
			case 'draft':
				new Toolbar('concluir,editar,compartilhar,remover,clonar,exportarpdfr,exportarpdfp');
			break;

			case 'done':
				new Toolbar('assinar,solicitarassinatura,solicitarevisao,compartilhar');
			break;

			case 'signed':
				new Toolbar('finalizar,compartilhar,clonar,exportarpdf');
			break;

			case 'sign_requested':
				new Toolbar('assinar,solicitarassinatura,compartilhar');
			break;	
		}
		openbox('Visualizar documento '.$documento->identifier,'',$breadcrumb->show());
		$this->view('documentos/visualizar',$dados);
		closebox();
	}
    public function update()
    {
		openbox('{addtitle}','{addsub}');
		$documents = $this->model('Documents');
		$documents->setId(filterpost('id'));
		$documents->setContent(filterpost('content'));
		$documents->setStatus(filterpost('status'));
		$documents->setUpdatedAt(filterpost('updated_at'));
		
        if($documents->update() === true) 
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

		$documents = $this->model('Documents');
		if ($documents->updateFields($_POST, $id)) {
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
		
		$documents = $this->model('Documents');
		if ($documents->delete($lines) === true) {
			$dados['titulo'] = "Exclusão de {tabela}";
        	$dados['mensagem'] = "Registros excluídos com sucesso!";
        	$this->view('modal',$dados);
		}
	}

    public function listar()
    {
        $toolbar = new Toolbar('novo,editar,excluir');
		openbox('Listagem de documentos');
        $grid = new TDatagrid('*','documents');
        $grid->action('editar','edit','#ajax-content');
        echo $grid->view();
        closebox();
    }

	public function buscarHipotese()
	{
		$nivel = $_POST['valores']['acesso'];
		if($nivel == 2)
		{
			$hiposteses = new TDataSelect('hipotese','legal_hipotesis');
			$hiposteses->option('hipotese');
			$hiposteses->value('id');
			$hiposteses->setClass('form-control');
			echo $hiposteses->exibir();
		}else{
			$content = <<<PHP
						<select name="hipotese" id="" class="form-control">
						<option value="0">---</option>
						</select>
			PHP;
			echo $content;
		}
	}

	public function replaceVars($content,$idDocumento)
	{
		require(basedir().'/config/params.php');
		$documento = $this->model('Documentos')->get($idDocumento);
		// Exemplo de valores vindos do banco
		$vars = [
			'documento_data_emissao_por_extenso'=>date('d').' de '.DATA::get_mes(date('Y-m-d')).' de '.date('Y'),
			'usuario_nome'=>$_SESSION['nome'],
			'local'=>$config['local'],
			'documento_data_emissao'=>date('Y\\m\\d'),
			'setor_nome'=>$this->model('Setores')->getNomePorDono($documento->sector_id),
			'setor_sigla'=> $this->model('Setores')->getSiglaPorDono($documento->sector_id),
			'setor_chefe'=> 'alguem',
			'setor_telefones'=> '33332222',
			'documento_identificador'=> $documento->identifier,
			'instituicao_nome'=> 'Falconi Advogados',
			'instituicao_sigla'=> 'FACA',
			'instituicao_sitio_internet'=> 'https://www.falconi.com.br',
			'unidade_sigla'=> '',
			'unidade_nome'=> '',
			'unidade_telefone'=> '',
			'unidade_endereco'=> '',
			'unidade_diretor_nome'=> ''
		];

		// Substituição das variáveis {{ nome }} pelo valor correspondente
		$content = preg_replace_callback('/{{\s*([a-zA-Z0-9_]+)\s*}}/', function ($matches) use ($vars) {
			$key = $matches[1];
			return $vars[$key] ?? '{{' . $key . '}}'; // se não existir, mantém o placeholder
		}, $content);

		return $content;
	}

	public function concluir($id)
	{
		$documento = $this->model('Documentos');
		$documento->setId($id);
		$documento->setStatus('done');
		if($documento->updateStatus()==true){
			redirect('documentos/visualizar/'.$id);
		}else{
			exit('erro');
		}

	}
	public function dashboard()
	{
		$this->view('documentos/dashboard');
	}

	public function solicitarassinatura($id){
		openbox('Solicitar assinatura de documento');
	
		$pessoa=new TDataSelect('user1','users');
		$pessoa->setClass('form-control select2');
		$pessoa->start('Escolha uma pessoa');
		$pessoa->value('id');
		$pessoa->option('name');
		$pessoa2=new TDataSelect('user2','users');
		$pessoa2->setClass('form-control select2');
		$pessoa2->start('Escolha uma pessoa');
		$pessoa2->value('id');
		$pessoa2->option('name');
		$dados['pessoa'] = $pessoa->exibir();
		$dados['pessoa2'] = $pessoa2->exibir();
		$dados['id'] = $id;
		$this->view('documentos/form-solicitar-assinatura', $dados);
		closebox();
	}

	public function solicitarevisao($id){
		openbox('Solicitar revisão de documento');
		$this->view('revisao-add');
		closebox();
	}

	public function enviarsolicitacaoassinatura()
	{
		$solicitacao = $this->model('Assinaturas');
		$iddocumento = filterpost('iddocumento');
		$solicitacao->setIdDocumento($iddocumento);
		$solicitacao->setIdSolicitante($_SESSION['id']);
		$solicitacao->setIdSolicitado(filterpost('user1'));
		$solicitacao->setIdDocumento(filterpost('iddocumento'));
		$solicitacao->setDataSolicitacao(DATA::datetimeNow());
		$solicitacao->setStatus('Aguardando');
		if($solicitacao->save()==true){
			redirect('documentos/visualizar/'.$iddocumento);
		}else{
			echo "Solicitacao nao enviada";
		}
	}
	public function my(){
		openbox("Documentos de texto");
		$documentos = new Select('id,sector_id,id_type,identifier,subject,status,access_level,created_by,created_at','documents');
		$dados = [];
		$dadosDoc = $documentos->run();		
		//
		foreach($dadosDoc as $key=>$documento)
		{
			$ver = '<a href="documentos/visualizar/'.$documento->id.'" class="ajax-link" data-target="#ajax-content"><i class="fas fa-eye"></i></a>';
			$editar = '<a href="documentos/edittext/'.$documento->id.'" class="ajax-link" data-target="#ajax-content"><i class="fas fa-pencil-alt"></i></a>';
			if($documento->status=='draft')
			{
				$dados[$key]['acoes'] = "{$ver} {$editar}";
			}else{
				$dados[$key]['acoes'] = "{$ver}";
			}
			
			//Pegar o setor
			$setor = $this->model('Setores')->get($documento->sector_id);
			$dados[$key]['sector_id']=$setor->sigla;
			//Pegar o tipo
			$tipo = $this->model('TipoDocumento')->find($documento->id_type);
			$dados[$key]['id_type']=$tipo->type;
			$dados[$key]['identifier']=$documento->identifier;
			$dados[$key]['subject']=$documento->subject;
			$dados[$key]['status']=$this->statusBr($documento->status);
			$dados[$key]['access_level']=$this->nivelAcesso($documento->access_level);
			//Quem é o criador do documento?
			$criador = $this->model('Users')->find($documento->created_by);
			$dados[$key]['created_by'] = $criador->name;
			$dados[$key]['created_at'] = DATA::datetimeBr($documento->created_at);
		}
		$table = new Tabela('table');
		$table->setcolunas('Acoes, Setor Dono,Tipo de documento,Identificador,Assunto,Status,Nivel de acesso,Criado por, Data de criação');
		$tabela = $table->gerar($dados);
		$this->view('documentos/lista-documentos',['tabela'=>$tabela]);
	}
	public function recebidos(){
		$documentos = $this->model('Documentos')->get('falconi','documents');
	}
	public function compartilhados(){
		$documentos = $this->model('Documentos')->get('falconi','documents');
	}
	public function aguardando_assinatura(){
		openbox("Documentos de texto");
		$documentos = new Select('id,sector_id,id_type,identifier,subject,status,access_level,created_by,created_at','documents');
		$documentos->where("status='sign_requested'");
		$dados = [];
		$dadosDoc = $documentos->run();		
		//
		foreach($dadosDoc as $key=>$documento)
		{
			$ver = '<a href="documentos/visualizar/'.$documento->id.'" class="ajax-link" data-target="#ajax-content"><i class="fas fa-eye"></i></a>';
			$editar = '<a href="documentos/edittext/'.$documento->id.'" class="ajax-link" data-target="#ajax-content"><i class="fas fa-pencil-alt"></i></a>';
			if($documento->created_by==$_SESSION['id']){
				if($documento->status=='draft')
				{
					$dados[$key]['acoes'] = "{$ver} {$editar}";
				}else{
					$dados[$key]['acoes'] = "{$ver}";
				}
			}else{
				$dados[$key]['acoes'] = "{$ver}";
			}
			
			
			//Pegar o setor
			$setor = $this->model('Setores')->get($documento->sector_id);
			$dados[$key]['sector_id']=$setor->sigla;
			//Pegar o tipo
			$tipo = $this->model('TipoDocumento')->find($documento->id_type);
			$dados[$key]['id_type']=$tipo->type;
			$dados[$key]['identifier']=$documento->identifier;
			$dados[$key]['subject']=$documento->subject;
			$dados[$key]['status']=$this->statusBr($documento->status);
			$dados[$key]['access_level']=$this->nivelAcesso($documento->access_level);
			//Quem é o criador do documento?
			$criador = $this->model('Users')->find($documento->created_by);
			$dados[$key]['created_by'] = $criador->name;
			$dados[$key]['created_at'] = DATA::datetimeBr($documento->created_at);
		}
		$table = new Tabela('table');
		$table->setcolunas('Acoes, Setor Dono,Tipo de documento,Identificador,Assunto,Status,Nivel de acesso,Criado por, Data de criação');
		$tabela = $table->gerar($dados);
		$this->view('documentos/lista-documentos',['tabela'=>$tabela]);
	}

	public function solicitacoesparamim()
	{
		$idUsuario = $_SESSION['id'];
		$select = new Select('*','solicitacao_assinatura');
		$select->where("id_solicitado='{$idUsuario}'");
		$dados = $select->run(); 
		$qtdeSolicitacoes = sizeof($dados);
		echo $qtdeSolicitacoes;

	}
	public function assinar($id)
	{
		openbox('Assinar documento');
			$documento = DB::table('documents')->where("id={$id}");
			$dados['identificador'] = $documento[0]->identifier;
			$tipo = DB::table('doc_types')->where("id='{$documento[0]->id_type}'");
			$dados['tipo'] = $tipo[0]->type;
			$dados['id'] = $documento[0]->id;
			$this->view('documentos/form-assinar',$dados);
		closebox();
	}
	/**
	 * Gera assinatura do documento
	 * @return void
	 */
	public function salvarassinatura()
	{
		//20251
		pre($_POST);
		echo DATA::datetimeNow();	
		$authCode = gerarAuthCode();
	}

	public function statusBR($docstatus)
	{
		$status['approved'] = 'Aprovado';
		$status['draft']='Rascunho';
		$status['done'] = 'Concluído';
		$status['in_review'] = 'Em revisão';
		$status['reviwed'] = 'Revisado';
		$status['sign_requested'] = 'Aguardando assinatura';
		$status['signed'] = 'Assinado';
		$status['finished'] = 'Finalizado';

		return $status[$docstatus];
	}

	public function nivelAcesso($docnivel)
	{
		if($docnivel == 1)
		{	return 'Público';

		}else{
			return 'Restrito';
		}
	}

	
}
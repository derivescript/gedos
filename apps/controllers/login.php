<?php 
namespace apps\controllers;

use database\Select;

use function core\baseUrl;
use function core\filterpost;
use function core\pre;
use function core\redirect;

class LoginController extends \core\Controller{
	public function index(){ 
		//Implementacao 
		$this->view('form-login',['baseurl'=>baseUrl()]);
	}

	public function autenticate()
    {
       $login = filterpost('login');
       $senha = filterpost('password');
       $select = new Select('*','users');
       $select->where("username='{$login}'");
       $dados = $select->run();
       if(sizeof($dados)>0)
       {
            if (password_verify($senha,$dados[0]->password)) {
                $dados = $dados[0];
                $_SESSION['logado'] = true;
                $_SESSION['id'] = $dados->id;
                //Pegar o perfil
                $perfis  = $this->model('Profiles')->maxLevel($dados->id);
                $_SESSION['access_level'] = $perfis;
                //Qual dos perfis tem o maior nivel?
                $_SESSION['nome'] = $dados->name;
                $_SESSION['email'] = $dados->email;
                $_SESSION['ambiente']='admin';
                
                if(filterpost('url')){
                    redirect('#'.filterpost('url'));
                }else{
                    redirect('home');
                }          
            }else {
                echo '<div class="mensagem">Erro</div>';
                $data['titulo'] = 'Falha de login';
                $data['mensagem'] = "Usuário ou senha incorretos";
                $this->view('modalerro',$data);
            }          
       }else{
            echo '<div class="mensagem">Erro</div>';
            $data['titulo'] = 'Falha de login';
            $data['mensagem'] = "Informe o usuário e a senha";
            $this->view('modalerro',$data);
       }
    }

    public function recuperarsenha()
    {
        $this->view('form-retrieve',['baseurl'=>baseUrl()]);
    }
}
	
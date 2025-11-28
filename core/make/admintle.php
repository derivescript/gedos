<?php
/*
|---------------------------------------------------------------------------------------------------
| Cria um sistema de login com Controllers, Models e Views usando adminLte
|---------------------------------------------------------------------------------------------------
*/ 

    try{
        $handle = fopen(appdir.'/controllers/login.php','w');
        $content  = "<?php \n";
        $content .= "namespace \\".appdir."\\controllers; \n\n";
        $content .= "class LoginController extends core\Controller{ \n\t";
        $content .= "public function index(){ \n\t\t";
        $content .= "\$this->view('login');\n\t";    
        $content .= "}\n";              

        $content .= "public function post(){\n\t\t";
        $content .= "\$login = filterpost('login');\n\t\t";
        $content .= "\$senha = md5(filterpost('senha'));\n\t\t";
        $content .= "\$select = new Select('*','cienciasbiologicas','usuarios');\n\t\t";
        $content .= "\$select->where(\"login='{\$login}' and senha='{\$senha}' or email='\$login' and senha='\$senha' and ativo = 1\");\n\t\t";
        $content .= "\$dados = \$select->run();\n\t\t";
        $content .= "if(sizeof(\$dados)>0){\n\t\t";
        $content .= "\$dados = \$dados[0];\n\t\t";
        $content .= "\$_SESSION['logado'] = true;\n\t\t";
        $content .= "\$_SESSION['id']    = \$dados->id;\n\t\t";
        $content .= "\$_SESSION['nome']  = \$dados->nome;\n\t\t";
        $content .= "\$_SESSION['email'] = \$dados->email;\n\t\t";
        $content .= "\$_SESSION['ck_authorized']=true;\n\t\t";
        $content .= "if(filterpost('url')){\n\t\t";
        $content .= "redirect('painel#'.filterpost('url'));\n\t\t";
        $content .= "}else{\n\t\t\t";
        $content .= "redirect('painel');\n\t\t";
        $content .= "}\n\t";            
        $content .= "}else{\n\t\t\t";
        $content .= "echo '<div class=\"mensagem\">Erro</div>';\n\t\t";
        $content .= "\$dados['titulo'] = 'Falha de login';\n\t\t";
        $content .= "\$dados['mensagem'] = 'Usuario ou senha incorretos';\n\t\t";
        $content .= "\$this->view('modalerro',\$dados);\n\t";
        $content .= "}\n";        
        $content .= "}";
        fwrite($handle,$content);
        fclose($handle);
    }catch(Exception $e){
        echo "\e[0;32;12m Erro ao criar login!\e[0m\n";
    }
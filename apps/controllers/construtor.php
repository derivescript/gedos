<?php

namespace apps\controllers;

use Helpers\Classbuilder;
use helpers\TSelect;

use function core\closebox;
use function core\filterpost;
use function core\openbox;

class ConstrutorController extends \core\Controller{
    private $builder;

    public function __construct()
    {
        //Chama a classe Builder
        require_once('helpers/Classbuilder.php');
        $this->builder =  new Classbuilder();         
    }

    public function index(){
        openbox('Gerar arquivos',"Gera controllers, models e views");
        $bancos = array();
        require appdir.'/config/database.php';
        $listbancos = new TSelect('database');
        $listbancos->setClass('form-control');
        $listbancos->set_texto('Selecione o banco');
        foreach($config as $banco){
           $bancos[$banco['name']] = $banco['name'];
        }
        $listbancos->setItems($bancos);
        $dados['bancos'] = $listbancos->exibir();
        $this->view('form-construir',$dados);
        closebox();
    }

    public function exibir(){
        $banco = filterpost('nomebanco');
        $pasta = filterpost('pasta');
        $this->builder->setSchema($banco);       
        $this->builder->exibir();
    }

    /**
     * 
     */
    public function gerar(){
        
        $pasta = filterpost('pasta');
        $banco = filterpost('database');
        $this->builder->setSchema($banco);
        $this->builder->setPasta($pasta);
        
        foreach($_POST['tabelas'] as $table)
        {
            $this->builder->geracontroller($table);
            $this->builder->gerarentidade($banco,$table);
            $this->builder->geraview($table);
        }   
    }
    
}
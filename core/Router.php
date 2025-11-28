<?php

namespace core;

/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Classe Router - Todas as solicitacoes do sistema precisam passar por aqui!!!
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
use core\URI;

use function core\basedir;
class Router
{
    private $partes;
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|   Atributo para armazenar o objeto URI, que traz a requisicao do navegador
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    private $uri;
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Diretorio da aplicacao. Localizado dentro de apps, pode ter qualquer nome definido pelo usuario. Isso permite criar aplicacoes diferentes com uma unica
| instalacao do S.I.L.A.S
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    private $appfolder;
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Como cada aplicacao pode optar por ter um admin separado dos demais, entao teremos uma subpasta dentro de $this->appfolder. O nome pode ser definido pelo 
| desenvolvedor. Ex.: admin, admin, administracao, etc. Essa pasta tem suas proprias pastas controllers, models e views
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/ 
    private $subfolder;
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Definimos o nome do controlador padrao da aplicacao. Se nenhum controller for chamado na url, entao camaremos o controller indicado aqui.
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    protected $controller = 'home';
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Metodo inicial do controller. Se nenhum for chamado na url, entao chamamos o index.
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    protected $metodo = 'index';
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|   Id Passado pela url
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    protected $id;	
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
| array com os segmentos da url
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    protected $segmentos;

/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|  Atributo para armazenar paginas
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/  
    protected $pagina;

/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|  Atributo para armazenar paginas
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    protected $ordem;

    private $path;
    
    public function __construct()
    {
/*
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
| Chama a classe URI, que mapeia as urls do site
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/ 
        require_once 'URI.php';
        $this->uri = new URI;
        $this->segmentos = $this->uri->set_segmentos();
        $this->set();
    }
/*
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
| Define se o diretorio da aplicacao será a pasta apps ou uma subpasta dentro dela.
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    public function set_app_dir()
    {
       /*
        * Diretorio raiz da aplicacao, que esta em apps
        */
        
        $root_dir =  basename(basedir());
        $this->path = basedir().'/'.appdir.'/';
        /*
        Estamos em localhost ou em um dominio?
        */
        $levels = 0;
        if($this->segmentos[0]==$root_dir) {
             //Removi o primeiro item do array, ou seja a pasta onde o sistema esta instalado
            unset($this->segmentos[0]);
            $levels = 1;            
        }
            foreach($this->segmentos as $key=>$segmento)
            {
                $key = $key - $levels;
                //E uma pasta dentro do path, que comeca com apps?
                if($segmento!='' && is_dir($this->path.$segmento))
                {
                    $this->path.=$segmento.'/';                    
                    $this->appfolder = $segmento;
                    $this->partes[$key] = $segmento;                  
                }else{
                    $this->partes[$key] = $segmento;
                }
            }             
        $this->segmentos = $this->partes;        
        return $this->appfolder;    
        
    }
    /*
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
| Se a aplicacao esta salva em uma subpasta de apps, ela pode ter um admin de controle separado das outras aplicacoes. Nesse caso definimos qual parte da
| url aponta para a subpasta
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
public function set_sub_folder()
{
    $this->set_app_dir();
    $pos_appfolder = array_search($this->appfolder,$this->segmentos);
    $pos_subfolder = $pos_appfolder+1;
    //Esta setada a appfolder e dentro dela tem uma subpasta?
    if(isset($this->appfolder))
    {
        if(isset($this->segmentos[$pos_subfolder]) and is_dir(appdir."/{$this->appfolder}/{$this->segmentos[$pos_subfolder]}"))
        $this->subfolder = $this->segmentos[$pos_subfolder];
    }   
    return $this->subfolder;  
}
    /**
     * Determina qual parte da url é o controller a ser invocado
     */
    public function set_controller()
    {
        $posicao_controller = 0;
        if(isset($this->appfolder))
        { 
             //Pegamos a posicao da pasta na url
             $pos_appfolder = array_search($this->appfolder,$this->segmentos);
             $posicao_controller = $pos_appfolder+1;           
        }
        
        if(isset($this->segmentos[$posicao_controller]) and $this->segmentos[$posicao_controller]!='')
        {
            $this->controller = $this->segmentos[$posicao_controller];            
            $filecontroller = $this->path."controllers/{$this->controller}.php";
        }else{
            $filecontroller = $this->path."controllers/home.php";
        }
     
        return $filecontroller;
    }

    public function get_controller()
    {
        return $this->controller;
    }
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
| Determina o metodo que sera executado 
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    public function set_metodo()
    {
        $this->set_app_dir();
        $posicao_controller = 0;
        $pos_appfolder = array_search($this->appfolder,$this->segmentos);
        if(isset($this->appfolder))
        {
            $posicao_controller = $pos_appfolder+1;
        }

        if(isset($this->segmentos[$posicao_controller]) && $this->segmentos[$posicao_controller]!='')
        {
            //Se eu chamei um controller, entao o metodo e o proximo
           $posicao_metodo = $posicao_controller+1;

           if(isset($this->segmentos[$posicao_metodo]) and $posicao_metodo!='')
           {
               $this->metodo = $this->segmentos[$posicao_metodo];
           }    
        }
    }

    public function setId()
    {
        $posicao_metodo = array_search($this->metodo,$this->segmentos);
        $posicao_id = $posicao_metodo+1;
        if(isset($this->segmentos[$posicao_id]) and $this->segmentos[$posicao_id]!='')
        {
            $this->id = $this->segmentos[$posicao_id];
        }
        return $this->id;
    }

    public function get_appfolder()
    {
        return $this->appfolder;
    }
    
    public function get_path()
    {
        return $this->path;
    }

    public function get_pagina()
    {
        $posicao_metodo = array_search($this->metodo,$this->segmentos);
        $pagina = $posicao_metodo+2;
        if(isset($this->segmentos[$pagina]) and $this->segmentos[$pagina]!='')
        {
            $this->pagina = $this->segmentos[$pagina];
        }else{
            $this->pagina=1;
        }        

        return $this->pagina;
    }

    public function get_ordem()
    {
        return 'nome';
    }
    public function set()
    {
      //$this->set_controller();  
      $this->set_metodo();
    }

    public function parse_route($request){
        
        $nrotas = array();
        require_once(appdir.'/config/rotas.php');
        foreach($rotas as $rota=>$caminho)
        {
            $rota = str_replace(array("(any)","(num)"),array('[A-Za-z0-9-]+','[0-9]+'),$rota);
            //Achou a rota ou nao?
            if (!preg_match('#^'.$rota.'$#', $request, $matches))
            {
                $rota = str_replace(array('[A-Za-z0-9-]+','[0-9]+'),array("(any)","(num)"),$rota);
                unset($rotas[$rota]);
            }else{
                $request = array_push($nrotas,$caminho);
            }
        }
        return $nrotas;
    }

    public function set_request($filecontroller)
    {
        
        $namespace = str_replace(basename($filecontroller),'',$filecontroller);
        $className = rtrim(ucfirst($this->controller)."Controller",'/');
        require $filecontroller;
        $namespace = ltrim(str_replace(basedir(),'',$namespace),'/');
        $namespace = str_replace('/','\\',$namespace);
        
        $exec = '\\'.$namespace.$className;            
        $cname = $this->controller;  
        $controller = new $exec;
        return $controller;
    }
/**
 * Faz rodar o sistema de rotas e executa os controllers
 *
 * @return void
 */
    public function run()
    {
        
        $filecontroller = $this->set_controller();
        $this->setId();
        if(isset($filecontroller) && file_exists($filecontroller))
        {
            $controller = $this->set_request($filecontroller);
            $metodo = $this->metodo;
            //Caso nenhum metoo seja chamado, chamo o index() do controller
            if($metodo=='')
            {
                $controller->index();
            }
            if(method_exists($controller,$metodo))
            {
                /*
                |---------------------------------------------------------------------------------------------------------------------------------
                | Se estamos passando um dado pela url, entao passamos esse dado para o metodo
                |---------------------------------------------------------------------------------------------------------------------------------
                */
                if(isset($this->id) and $this->id!='')
                {
                    $controller->$metodo($this->id);                      
                }else{
                /*
                |---------------------------------------------------------------------------------------------------------------------------------
                | Executando o metodo sem passar nenhum argumento
                |---------------------------------------------------------------------------------------------------------------------------------
                */
                    $controller->$metodo();  
                    
                }
            }else{  
                require basedir()."/erro404.html";                
            }           
        }else{
            //echo $filecontroller;
            require basedir()."/erro404.html";
        }
    }
}

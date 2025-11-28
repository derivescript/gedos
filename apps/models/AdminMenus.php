<?php
namespace apps\models;

use core\Router;
use database\DB;
use database\Delete;
use database\Select;
use database\Insert;

use function core\baseUrl;

class AdminMenus{
        private $id;
        private $id_parent;
        private $nome;
        private $icone;
        private $href;
        private $nivel_menu;
        private $ordem;
        private $children = array();
        private $html;   
        private $schema; 
    
        public function __construct()
        {
        $router = new Router();
        $pasta = $router->set_app_dir();
        $select = new Select('*','admin_menus');
        $select->where("nivel_menu=1");
        $select->ordem("ordem");
        $menulist = $select->run();
        foreach((array)$menulist as $menu){
                $filhos = $this->check_children($menu->id);
                if(sizeof((array)$filhos)>0){                
                $this->html.='<li class="nav-item has-treeview">';
                $this->html.='<a href="#" class="nav-link" data-target="#ajax-content">';
                $this->html.='<i class="nav-icon '.$menu->class.' fa-'.$menu->icone.'"></i>';
                $this->html.='<p>'.$menu->nome;
                $this->html.='<i class="nav-icon fas fa-angle-left right"></i>';
                $this->html.='</p>';
                $this->html.='</a>';
                //Submenu
                $this->html .= '<ul class="nav nav-treeview">';
                foreach((array)$filhos as $filho)
                {
                        $this->html.= '<li class="nav-item">';
                        $this->html.= '<a href="'.$filho->href.'" class="ajax-link nav-link" data-target="#ajax-content">';
                        $this->html.= '<i class="'.$filho->class.' fa-'.$filho->icone.'"></i> '.$filho->nome.'</a>';
                        $this->html.= '</li>';  
                }
                $this->html .='</ul>';
                $this->html .='</li>';
                
                }else{
                $this->html.='<li class="nav-item">';
                $this->html.='<a href="'.$menu->href.'" class="ajax-link nav-link" data-target="#ajax-content">';
                $this->html.='<i class="nav-icon fa fa-'.$menu->icone.'"></i>';
                $this->html.='<p>'.$menu->nome.'</p>';
                $this->html.='</a>';
                $this->html.='</li>';        
                }            
        }            
        }

        /**
         * Get the value of id_parent
         */ 
        public function get_id_parent()
        {
                return $this->id_parent;
        }

        /**
         * Set the value of id_parent
         *
         * @return  self
         */ 
        public function set_id_parent($id_parent)
        {
                $this->id_parent = $id_parent;

        }

        /**
         * Get the value of nome
         */ 
        public function get_nome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function set_nome($nome)
        {
                $this->nome = htmlentities($nome);
        }



        /**
         * Get the value of icone
         */ 
        public function get_icone()
        {
                return $this->icone;
        }

        /**
         * Set the value of icone
         *
         * @return  self
         */ 
        public function set_icone($icone)
        {
                $this->icone = $icone;
        }

        /**
         * Get the value of href
         */ 
        public function get_href()
        {
                return $this->href;
        }

        /**
         * Set the value of href
         *
         * @return  self
         */ 
        public function set_href($href)
        {
                $this->href = $href;
        }

        /**
         * Get the value of nivel_menu
         */ 
        public function get_nivel_menu()
        {
                return $this->nivel_menu;
        }

        /**
         * Set the value of nivel_menu
         *
         * @return  self
         */ 
        public function set_nivel_menu($nivel_menu)
        {
                $this->nivel_menu = $nivel_menu;
        }

        /**
         * Get the value of ordem
         */ 
        public function get_ordem()
        {
                return $this->ordem;
        }

        public function get_id()
        {
                return $this->id;
        }
        /**
         * Set the value of ordem
         *
         * @return  self
         */ 
        public function set_ordem($ordem)
        {
                $this->ordem = $ordem;
        }
        /**
         * Function Inserir
         *
         * @return true/false
         */
        public function save()
        {
                $campos['id_parent'] = $this->get_id_parent();
                $campos['nome'] = $this->get_nome();
                $campos['icone'] = $this->get_icone();
                $campos['class'] = 'fas';
                $campos['href'] = $this->get_href();
                $campos['nivel_menu'] = $this->get_nivel_menu();
                $campos['ordem'] = $this->get_ordem();
                //$insert = new Insert($this->schema,'admin_menus',$campos);
                $handle = DB::table('admin_menus');
		if($handle->save($campos)==true){
			return true;
		}else{
			return false;
		}	
        }
    
        /**
         * Exibe o menu
         * void
         */
        public function exibir()
        {
                return $this->html;
        }
        /**
        * Verififca se existem filhos para um determinado id de menu
        * @param $id = id do menu pai
        */
        public function check_children($id)
        {
        $select = new Select('*','admin_menus');
        $select->where("id_parent={$id} and access_level<={$_SESSION['access_level']->nivel}");
        $select->ordem("ordem");
        $dados = $select->run();
        return $dados;
        }

        /**
        * Faz a remocao de um registro da tabela
        */
        public function delete($lines){
                $handle = DB::table($this->schema,'admin_menus');
                if($handle->delete($lines)==true){
                        return true; 
                }else{
                        return false; 
                }
        }
}
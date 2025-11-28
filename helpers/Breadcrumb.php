<?php

namespace helpers;

use core\Functions;

use function core\baseUrl;
use function core\pre;

class Breadcrumb{
        
    private $nome;
    private $label;
    private $html;

    private $functions = array(
        'done' => array('label'=> 'Concluído'),
        'draft'  => array('label'=>'Rascunho'),  
        'in_review' => array('label'=> 'Em revisão'),
        'reviewed' => array('label'=> 'Revisado'),
        'sign_requested' => array('label'=> 'Aguardando assinatura'),
        'signed' => array('label'=> 'Assinado'),
        'finished' => array('label'=> 'Finalizado')
    );
    public function __construct($status,$ativo)
    {
        $options = explode(',',$status);
        $this->html = '<ul class="breadcrumb flat">';
               
        foreach($options as $option)
        {   
            $label = $this->functions[$option]['label'];
            if($option ==  $ativo){
                $this->addStatus($label,'active');   
            }else{
                $this->addStatus($label,'normal');   
            }
            
        }

        $this->html .= '</ul>';
        
    }
   
    
    public function addStatus($label,$class){
        $this->html.= '<li class="'.$class.'">'.$label.'</li>';    
    }
    
    public function show(){
        echo $this->html;
    }
}
<?php

namespace helpers;

use core\Functions;

use function core\baseUrl;
use function core\pre;

class Toolbar{
        
    private $nome;
    private $label;
    private $link;
    private $icone;
    private $alt;
    private $id;
    private $functions = array(
        'acessarcomo'  => array('label'=>'Acessar como','link'=>'#','icon'=>'swap-user.png','alt'=>'Acessa com o perfil de outro usuário','id'=>'acessarcomo'),
        'ativar'      => array('label'=>'Ativar','link'=>'#','icon'=>'usuario_publish.png','alt'=>'Ativar','id'=>'ativar'),
        'assinar'  => array('label'=>'Assinar','link'=>'#','icon'=>'pen-color-icon.png','alt'=>'','id'=>'assinar'),
        'cancelar'  => array('label'=>'Cancelar','link'=>'#','icon'=>'cancel_f2.png','alt'=>'Desativar','id'=>'novo'),
        'compartilhar'  => array('label'=>'Compartilhar','link'=>'#','icon'=>'share.png','alt'=>'','id'=>'compartilhar'),
        'clonar'  => array('label'=>'Clonar documento','link'=>'#','icon'=>'clone.png','alt'=>'','id'=>'clonar'),
        'concluir'  => array('label'=>'Concluir documento','link'=>'#','icon'=>'cat_editar.png','alt'=>'','id'=>'concluir'),       
        'desativar'  => array('label'=>'Desativar','link'=>'#','icon'=>'usuario_unpublish.png','alt'=>'Desativar','id'=>'novo'),
        'despublicar' => array('label'=>'Despublicar','link'=>'#','icon'=>'cancel_f2.png','alt'=>'despublicar','id'=>'despublicar'),
        'editar'      => array('label'=>'Editar','link'=>'#','icon'=>'edit.png','alt'=>'','id'=>'editar'),
        'excluir'     => array('label'=>'Excluir','link'=>'#','icon'=>'trash.png','alt'=>'','id'=>'excluir'),
        'exportarpdfr'     => array('label'=>'Exportar PDF Retrato','link'=>'#','icon'=>'pdf.png','alt'=>'','id'=>'excluir'),
        'exportarpdfp'     => array('label'=>'Exportar PDF paisagem','link'=>'#','icon'=>'pdf.png','alt'=>'','id'=>'excluir'),
        'imprimir'  => array('label'=>'Imprimir','link'=>'#','icon'=>'print.png','alt'=>'Imprimir','id'=>'imprimir'),
        'novo'        => array('label'=>'Novo','link'=>'#','icon'=>'add.png','alt'=>'','id'=>'novo'),
        'publicar'    => array('label'=>'Publicar','link'=>'#','icon'=>'publicar.png','alt'=>'Publicar','id'=>'publicar'),
        'salvar'      => array('label'=>'Salvar','link'=>'#','icon'=>'save_f2.png','alt'=>'','id'=>'salvar'),
        'solicitarassinatura'      => array('label'=>'Solicitar assinatura','link'=>'#','icon'=>'pen-icon.png','alt'=>'','id'=>'solicitarassinatura'),
        'solicitarevisao'     => array('label'=>'Solicitar revisão','link'=>'#','icon'=>'lupa.png','alt'=>'','id'=>'solicitarevisao'),
        'remover'     => array('label'=>'Excluir','link'=>'#','icon'=>'trash.png','alt'=>'','id'=>'excluir')
    );
    public function __construct($buttons='')
    {
        $buttons = explode(',',$buttons);
        echo '<div class="row">';
        echo "<div class=\"toolbar-container\">";   
        echo "<div id=\"toolbar\">";
       
        foreach($buttons as $button)
        {
            $label = $this->functions[$button]['label'];
            $icon = $this->functions[$button]['icon'];
            $alt = $this->functions[$button]['alt'];
            $link = $this->functions[$button]['link'];
            $id = $this->functions[$button]['id'];
            $this->addbotao($label,$link,$icon,$alt,$id);   
        }
        echo "</div>";
        echo "</div>";
        echo '</div>';
    }
   
    
    public function addbotao($label,$link,$icone,$alt,$id){
        
    echo '<div class="botao">'."\n";
    	echo "<a href=\"$link\" title=\"$alt\" id=\"{$id}\" class=\"tool-link\">\n";
    		echo "<img src=\"".baseUrl()."assets/painel/img/".$icone."\" class=\"iconebotao\" />\n";
    		echo "<br>";
    		echo $label."</a>\n";
    echo "</div>\n";
    }
    
}

class ToolbarEdit extends Toolbar{
    public function __construct(){
        parent::__construct('salvar,cancelar');
    }
}


class ToolbarPadrao extends Toolbar{
    public function __construct($buttons='novo,editar,excluir,publicar,despublicar'){
        echo '<div class="row">';
        echo "<div class=\"toolbar-container\">";   
        echo "<div id=\"toolbar\">";
        parent::__construct($buttons);
		echo "</div></div></div>";
		
		
    }
}

class ToolbarResumo extends Toolbar{
    public function __construct(){
        echo "<div class=\"toolbar-container\">";   
        echo "<div id=\"toolbar\">";
        $toolbar = new toolbar();
        $toolbar-> addbotao("Novo","#","add.png","Adicionar novo","novo");
        $toolbar-> addbotao("Excluir","#","cancel_f2.png","Excluir resumo","excluir");
        //$toolbar-> addbotao("Responder","#","kate.png","Enviar resposta para o autor","responder");
        echo "</div>";        
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "<div class=\"titulo-lista\">";
        //echo "<h2>".$titulo."</h2>";
        echo "</div>"; 
    }
}
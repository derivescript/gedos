<?php

namespace helpers;

use function core\pre;

class TRadioGroup{
	private $nome;
	private $id;
	private $opcoes = array();
	private $value;
	private $checked;
	private $html;
	
	public function __construct($nome){
		$this->nome=$nome;
		$this->id=$nome;		
	}

	/**
	 * Cria os items para serem adicionados ao RadioGroup
	 */
	public function options($opcoes){
		$this->opcoes=$opcoes;
	}
	
	public function set_valor($value){
		$this->value=$value;
		return $this->value;
	}
	
	public function default($opcao){
		$this->checked=$opcao;
		return $this->checked;
	}
	
	
	public function html(){
		foreach($this->opcoes as $valor=>$opcao){
		    if($this->checked == $valor){
				$this->html .="<input type=\"radio\" name=\"{$this->nome}\" id=\"{$this->id}\" value=\"{$valor}\" checked=\"checked\" /> <span class=\"opcao\">{$opcao}</span>  ";
			}else{
				$this->html .="<input type=\"radio\" name=\"{$this->nome}\" id=\"{$this->id}\" value=\"{$valor}\" /> <span class=\"opcao\">{$opcao}</span>  ";
			}
		}
		return $this->html;	
	}
	
}
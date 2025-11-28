<?php

namespace helpers;

use function core\is_html;
use function core\pre;

class Tabela{
	private $colunas = array();
	private $classe;
	private $editavel;
	private $acoes = array();
	private $paginar=false;
	private $html ='';

	public function __construct($classe){
		$this->classe=$classe;
		return $this->classe;

	}
	
	public function set_editavel($valor){
		$this->editavel=$valor;
	}
	
	public function get_editavel(){
		return $this->editavel;
	}
	//Atribui um classe css para a tabela
	public function setClasse($classe){
		$this->classe=$classe;
		return $this->classe;
	}

	//Abre a tabela
	public function abre(){
		$this->html .= "<table class=\"{$this->classe}\">\n";
		return $this->html;
	}

	public function addhead($th){
		$this->html .= "<th>{$th}</th>\n";
		return $this->html;
	}

	public function abrelinha(){
		$this->html .= "<tr>\n";
		return $this->html;
	}

	public function fechalinha(){
		$this->html .= "</tr>\n";
		return $this->html;
	}

	public function setcolunas($colunas){
		$cols = explode(',',$colunas); 
		foreach($cols as $coluna){
			array_push($this->colunas,$coluna);
		}
	}
	
	/**
	 * addcoluna - Para adicionar celulas na tabela	
	 * @param $tdclass = Classe da Coluna
	 * @param $atr_data = para criar atributo do tipo data-* do html5
	 * @param $dado = Conteudo da celular
	 */
	public function addcoluna($classe='',$campo='',$dado=''){
		if(is_html($dado)){
			$this->html .= "<td class=\"{$classe}\" data-nome=\"$campo\">".$dado."</td>\n";
		}else{
			$this->html .= "<td class=\"{$classe}\" data-nome=\"$campo\" data-valor=\"".$dado."\">".$dado."</td>\n";
		}		
	}
		
	//Gera a tabela com os dados e tudo
	public function gerar($dados){
		$this->abre();
		//Gera o cabecalho da tabela
		$this->abrelinha();
		foreach ($this->colunas as $coluna) {
			$this->addhead($coluna);
		}
		$this->fechalinha();
		//Gera as linhas da tabela
		foreach($dados as $linha){			
			$this->abrelinha();
			
			
			foreach($linha as $indice=>$valor){
				$this->addcoluna($indice,"",$valor);
			}
			$this->fechalinha();
		}
		$this->fechar();		
		return $this->html;
	}

	public function fechar(){
		$this->html .= "</table>";
		return $this->html;
	}
}
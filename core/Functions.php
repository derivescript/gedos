<?php

namespace core;

use stdClass;

function pre($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
function basedir(){
	return getcwd();
}

/*
|-----------------------------------------------------------------------------------------------------------------------------------------------------------
| Gera a url basica a partir do host
|-----------------------------------------------------------------------------------------------------------------------------------------------------------
*/
function baseUrl(){
	global $baseUrl;

	if($baseUrl==''){
	if (isset($_SERVER['HTTP_HOST']))
			{
				$baseUrl = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$baseUrl .= '://'. $_SERVER['HTTP_HOST'];
				$baseUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
			}else{
				$baseUrl= "";
			}
	}	
	return $baseUrl;
}
/*
|-----------------------------------------------------------------------------------------------------------------------------------------------------------
| Funcao para retirar caracteres especiais de strings
|-----------------------------------------------------------------------------------------------------------------------------------------------------------
*/ 

/**
 * Renomeia um arquivo retirando espacos e caracteres especias
 */
function renomear($arquivo){
	$acentos = array('á','ã','â','à','é','ê','í','ó','õ','ô','ú','ç','Á','Ã','Â','À','É','Ê','Í','Ó','Õ','Ô','Ú','Ç',"'",":",'"','§',',',' ','º','ª','?');
	$letras = array ('a','a','a','a','e','e','i','o','o','o','u','c','A','A','A','A','A','A','I','O','O','O','U','C','','','','','','-','','',''); 
	$nomefinal = strtolower(str_replace($acentos, $letras, $arquivo));
	return $nomefinal;
}    
/**
 * O mesmo que renomear, mas utilizando strings
 */
function limpar($string){
	$acentos = array(' ','_','ª','º','°','á','ã','â','à','é','ê','í','ó','õ','ô','ú','ç','Á','Ã','Â','À','É','Ê','Í','Ó','Õ','Ô','Ú','Ç');
	$letras = array ('-',' ','' ,'' ,'' ,'a','a','a','a','e','e','i','o','o','o','u','c','A','A','A','A','A','A','I','O','O','O','U','C');
	$nomefinal = strtolower(str_replace($acentos, $letras, $string));
	return $nomefinal;
}

function css_array($array){
     $estilos = '';
     foreach($array as $key=>$value){
         $estilos .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".baseUrl()."assets/{$value}.css\" media=\"all\">\n\t";
     } 
     return $estilos; 
}
 
function js_array($array){
    $scripts = '';
    foreach($array as $key=>$caminho){
        $scripts .= "<script type=\"text/javascript\" src=\"".baseUrl()."assets/{$caminho}.js\"></script>\n\t";
    } 
    return $scripts; 
}
 
function css($caminho){
	return "<link rel=\"stylesheet\" type=\"text/css\" href=\"".baseUrl()."assets/{$caminho}.css\" media=\"all\">\n\t";
}
 
function script($caminho){
	return "<script type=\"text/javascript\" src=\"".baseUrl()."assets/{$caminho}.js\"></script>\n\t";
}

function entidades($string){
	$acentos = array('ã','á','â','à','é','ê','í','õ','ó','ô','ç','ú','Á','Ã','Â','À','É','Ê','Í','Ó','Õ','Ô','Ú','Ç');
	$entidades = array ('&atilde;','&aacute;','&acirc;','&agrave;','&eacute','&ecirc;','&iacute;','&otilde;','&oacute;','&ocirc;','&ccedil;','&uacute;','&Aacute;','&Atilde;','&Acirc;','&Agrave;','&Eacute;','&Ecirc;','&Iacute;','&Oacute;','&Otilde;',
   '&Uacute;','&Ccedil;');
	$nomefinal = str_replace($acentos, $entidades, $string);
	return $nomefinal;
}
 
 
  /*
  * Função para gerar senhas aleatorias
  */
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
	// Caracteres de cada tipo
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	
	// Variáveis internas
	$retorno = '';
	$caracteres = '';
	
	// Agrupamos todos os caracteres que poderao ser utilizados
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	
	// Calculamos o total de caracteres possiveis
	$len = strlen($caracteres);
	
	for ($n = 1; $n <= $tamanho; $n++) {
	// Criamos um nuero aleatorio de 1 ate $len para pegar um dos caracteres
	$rand = mt_rand(1, $len);
	// Concatenamos um dos caracteres na variavel $retorno
	$retorno .= $caracteres[$rand-1];
	}
	
	return $retorno;
}

function gerarAuthCode()
{
	
	// Caracteres de cada tipo
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$num = '1234567890';
	$ano = date('Y');
		if(date('m')<7){
			$semestre = 1;
		}else{
			$semestre = 2;
	}
	$primeiros_5 = $ano.$semestre;

	$lenght = 12;
	$codigo = '';
	$caracteres = $lmin.$num;
	for ($n = 1; $n <= $lenght; $n++) {
	// Criamos um nuero aleatorio de 1 ate $len para pegar um dos caracteres
	$rand = mt_rand(1, $lenght);
	// Concatenamos um dos caracteres na variavel $retorno
	$codigo .= $caracteres[$rand-1];
	}
	$codigo = $primeiros_5.$codigo;
	return $codigo;
}
/**
 * Remove os caracteres do CPF
 */
function limpa_cpf($valor){
    return str_replace('-','',str_replace('.','',$valor));
} 


/**
 * 
 */

function mapToArray($object){
	$vars = get_object_vars($object);
	$arranjo = array();
	foreach($vars as $var=>$valor)
	{
		$arranjo[$var] = $valor;
	}
	return $arranjo;
}

/**
 * Filtrar dados por post 
 */   
function filterpost($campo){
	$campo = stripslashes($campo);
	$valor = filter_input(INPUT_POST, $campo);
	return $valor; 
}

/**
 * Filtrar dados por session
 */   
function filtersession($campo){
	$valor = $_SESSION[$campo];
	return $valor; 
}

function filter_array($arranjo)
{
	//pre($arranjo);
	$valor = filter_input_array(INPUT_POST,$arranjo);
	return $valor;
}

if ( ! function_exists('mime_content_type')){
	function mime_content_type(){

	}
}
/**
 * 
 * 
 */


/**
 * Funcao para criar boxes css
 */

function openbox($titulo='Title',$sub='',$breadcrumb=''){
	$html = <<< PHP
	<!-- Default box -->
	<div class="card">
	PHP;
	if($breadcrumb==true)
	{
		$html .= <<< PHP
		{$breadcrumb}
		PHP;
	}
	$title = $titulo;
	$subtitle = $sub;
	$html.= <<< PHP
	  <!-- Cabecalho-->
	  <div class="card-header">
		<h1 class="card-title">{$title}<small>{$subtitle}</small></h1>	
	  </div>
	  <!-- Fim do cabecalho-->
	  <div class="card-body">
	PHP;
	echo $html;

} 

function closebox(){
	echo '</div>
	<!-- /.box-body -->
	<div class="card-footer" id="resposta-modal">
	 
	</div>
	<!-- /.box-footer-->
  </div>
  <!-- /.box -->';
}

function redirect($uri=''){
	if(isset($uri) && $uri!=''){
		header('Location:'.baseUrl().$uri);
	}else{
		header('Location:'.baseUrl());
	}
	
}

function get_function_list($directory=''){
	if($directory=='/')
	{

	}
	$iterator = new \DirectoryIterator(appdir.'/controllers');
	$lista = array();
	$classes = array();
	foreach($iterator as $arquivo){			
		$name = $arquivo->getFilename();
		if($name!='.' and $name!='..'){
			require_once appdir.'/'.$directory.'/controllers/'.$name;
			$arquivo = substr($name,0,-4);
			$namespace = "\\".appdir."\\controllers";
			$class = $namespace.'\\'.ucfirst(substr($name,0,-4))."Controller";
			$ob = new $class;
			$metodos = get_class_methods($ob);				
			foreach($metodos as $metodo){					
				if($metodo!='__construct' &&  $metodo!='view' &&  $metodo!='model' &&  $metodo!='template' &&  $metodo!='load' &&  $metodo !='html' && $metodo!='editarcampo'){
					array_push($classes,array("arquivo"=>$arquivo,"metodo"=>$metodo));
				}
			}			
			
		}
	}		
	
	foreach($classes as $par){
		$lista[$par['arquivo'].'/'.$par['metodo']] = $par['arquivo'].'/'.$par['metodo'];
	}
		
	return $lista;	
}

/**
 * Funcao para popular selects
 */
function makeoptions($array,$value,$option,$selected='')
{
	$optionlist = '';
	foreach($array as $key=>$object)
	{
		if($selected!='' and $object->id==$selected)
		{
			$optionlist .= '<option value="'.$object->$value.'" selected="selected">'.$object->$option.'</option>';
		}else{
			$optionlist .= '<option value="'.$object->$value.'">'.$object->$option.'</option>';
		}
		
	}
	return $optionlist;
}

/**
 * 
 */
function decode_utf($string)
{
	return mb_convert_encoding(html_entity_decode($string),'iso-8859-1');
}

/**
 * Funcao para testar se string tem tags HTML
 */
function is_html($data){
    if($data!=null && strpos($data,'>')){
        $data = strip_tags($data);
        return [true, $data];
    }
}

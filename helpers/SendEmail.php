<?php

namespace helpers;

use PHPMailer;
use phpmailerException;

use function core\pre;

class SendEmail{
	private $assunto;
	private $nome_destinatario;
	private $nome_remetente;
	private $email_remetente;
	private $email_destinatario;
	private $rtelefone; 
	private $corpo;
	private $anexo;
	/**
	 * 
	 */
	public function __construct($nomefrom,$emailfrom,$nome,$email,$rtelefone,$assunto,$corpo,$anexo=''){
		$this->nome_remetente = $nomefrom;
		$this->email_remetente = $emailfrom;
		$this->assunto = $assunto;
		$this->nome_destinatario = $nome;
		$this->email_destinatario = $email;
		$this->rtelefone=$rtelefone;
        $this->corpo = $corpo;
        $this->anexo = $anexo;        
	}
	
	public function get_email_remetente(){
		return $this->email_remetente;
	}
	
	public function get_email_destinatario(){
		return $this->email_destinatario;
	}
	
	public function get_nome_remetente(){
		return $this->nome_remetente;
	}
	
	public function get_nome_destinatario(){
		return $this->nome_destinatario;
	}
	
	public function get_telefone_remetente(){
		return $this->rtelefone;
	}
	
	public function get_assunto(){
		return $this->assunto;
	}
	
	public function get_corpo(){
		return $this->corpo;	
	}
	
	public function enviar(){
        require appdir."/config/email.php";
		// Inicia a classe PHPMailer
		$mail = new PHPMailer(true);
		$mail->IsSMTP();        // Ativar SMTP
		$mail->SMTPDebug = false;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;     // Autenticação ativada
		$mail->SMTPSecure = 'ssl';  // SSL REQUERIDO pelo GMail
		$mail->Host = $email['host']; // SMTP utilizado
		$mail->Port = $email['porta']; 
		$mail->Username = $email['usuario'];
		$mail->Password = $email['senha'];
		$mail->SetFrom($email['usuario'], $email['nome']);
		$mail->AddReplyTo($email['usuario'], $email['nome']);
		$mail->addAddress($this->get_email_destinatario(),$this->get_nome_destinatario());
		$mail->Subject=$this->get_assunto();
		//Adicionar anexo
        if($this->anexo!=''){
			/**
			 * foreach ($anexo as $anexo)
			 * {
			 * 	$mail->AddAttachment($this->anexo['tmp_name'],renomear($this->anexo['name']));
			 * }
			 */
			// 
			pre($this->anexo);
		}
		$texto = $this->get_corpo();  
		$mail->msgHTML($texto); 
		if($mail->Send())
		{
			return true;
		}else{
			return false;
		}
	}
}

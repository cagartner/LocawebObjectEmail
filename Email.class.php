<?php 
/**
 * Classe para envio de e-mail em servidores da Locaweb.
 *
 * Funciona tanto em Hospedagens Windows e Linux.
 *
 * @author Carlos Augusto Gartner <carlos@we3online.com.br>
 * @link 
 * 
 */
class Email {

	private $Remetente;
	private $Destinatario;
	private $Copia;
	private $CopiaOculta;
	private $Assunto;
	private $Mensagem;

	private $EmailHost = "site@ficbic.com.br";
	private $Charset = 'utf-8';

	private $Headers;
	private $QuebraLinha = "\n";

	public function __contruct() 
	{
		if (PHP_OS == "Linux") {
			$this->QuebraLinha = "\n"; //Se for Linux
		} else if (PHP_OS == "WINNT") {
			$this->QuebraLinha = "\r\n"; // Se for Win
		} 
	}

	public function getRemetente()
	{
	    return $this->Remetente;
	}
	 
	public function setRemetente($Remetente)
	{
	    return $this->Remetente = $Remetente;
	}

	public function getDestinatario()
	{
	    return $this->Destinatario;
	}
	 
	public function setDestinatario($Destinatario)
	{
	    return $this->Destinatario = $Destinatario;
	}

	public function getCopia()
	{
	    return $this->Copia;
	}
	 
	public function setCopia($Copia)
	{
	    return $this->Copia = $Copia;
	}

	public function getCopiaOculta()
	{
	    return $this->CopiaOculta;
	}
	 
	public function setCopiaOculta($CopiaOculta)
	{
	    return $this->CopiaOculta = $CopiaOculta;
	}

	public function getAssunto()
	{
	    return $this->Assunto;
	}
	 
	public function setAssunto($Assunto)
	{
	    return $this->Assunto = $Assunto;
	}

	public function getMensagem()
	{
	    return $this->Mensagem;
	}
	 
	public function setMensagem($Mensagem)
	{
	    return $this->Mensagem = $Mensagem;
	}

	public function getCharset()
	{
	    return $this->Charset;
	}
	 
	public function setCharset($Charset)
	{
	    return $this->Charset = $Charset;
	}

	private function setHeaders() 
	{
		$headers = '';
		$headers = "MIME-Version: 1.0 " . $this->QuebraLinha;
		$headers .= "Content-type: text/html; charset=" . $this->Charset . $this->QuebraLinha;
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ". $this->EmailHost . $this->QuebraLinha;
		$headers .= "Return-Path: " . $this->EmailHost .  $this->QuebraLinha;
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if($this->Copia) { 
			$headers .= "Cc: " . $this->Copia . $this->QuebraLinha;
		}
		if($this->CopiaOculta) {
			$headers .= "Bcc: " . $this->CopiaOculta . $this->QuebraLinha;
		} 
		$headers .= "Reply-To: " . $this->Remetente . $this->QuebraLinha;

		$this->Headers = $headers;
	}

	public function enviaEmail() {
		$this->setHeaders();
		if (mail($this->Destinatario, $this->Assunto, $this->Mensagem, $this->Headers, "-r". $this->EmailHost)) {
			return true;
		} else {
			return false;
		}
	}

}
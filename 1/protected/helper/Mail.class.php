<?php
class Mail{
	private $smtp_user = "service@emop.cn";
	private $smtp_pass = "happy1202";
	private $smtp_host = "smtp.exmail.qq.com";
	private $smtp_port = "465";
	private $smtp_tls = false;
	private $content_type = "TEXT";
	
	public function __construct(){
		$this->mail = new SaeMail();
	}
	
	public function sendMail($subject, $content, $tos){
		$config ['smtp_password'] = $this->smtp_pass;
		$config ['smtp_username'] = $this->smtp_user;
		$config ['smtp_host'] = $this->smtp_host;
		$config ['smtp_port'] = $this->smtp_port;
		$config["subject"] = $subject;
		$config ['charset'] = "utf-8";
		$config ['content_type'] = $this->content_type;
		$config ['to'] = $tos;
		$config["content"] = $content;
		$config["from"]="service@emop.cn";
		
		$this->mail->setOpt($config);
		$ret = $this->mail->send();
		$this->mail->clean();
		if($ret){
			return true;
		}else{
			var_dump($this->mail->errno(), $this->mail->errmsg());
			return false;
		}
		
	}
	
	public function setContentType($content_type){
		$this->content_type = $content_type;
	}
}
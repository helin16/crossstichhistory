<?php

class ContactusControl extends TTemplateControl  
{
	private $reciever;
	private $recieverEmail;
	public $title="";
	public $content="";
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->reciever= Config::get("email","contactUsReciever");
		$this->recieverEmail= Config::get("email","contactUsRecieverEmail");
	}
	
	public function onload()
	{
		if(!$this->Page->IsPostBack)
		{
			$this->result->Visible=false;
			$this->captcha->ImageUrl="/stream?method=getCaptcha&width=60&height=23";
		}
	}
	
	/**
	 * getter title
	 *
	 * @return title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * setter title
	 *
	 * @var title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * getter content
	 *
	 * @return content
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * setter content
	 *
	 * @var content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	
	public function sendEmail($sender, $params)
	{
		$this->spamError->Text="";
		$this->result->Visible=false;
		if(md5(trim($this->spamInput->Text)).'a4xn' != $_COOKIE['tntcon'])
		{
			$this->spamError->Text="Invalid verification code!";
			return;
		}
		
		$now = new HydraDate();
		$todayis = $now->getDateTime()->format("l, F j, Y, g:i a") ;

		$attn = $this->reciever;
		$visitor = $this->name->Text ;
		$subject = $this->title==""? "Email from Web (from $visitor): $todayis" : $this->title;
		
		$visitormail = $this->emailAddr->Text;
		$notes = stripcslashes($this->emailContent->Text);
		
		$message = " $todayis [EST] \n
		Attention: $attn \n
		Message: $notes \n
		From: $visitor ($visitormail)
		";
		
		$from = "From: $visitormail\r\n";
		
		
		mail($this->recieverEmail, $subject, $message,$from);
		$this->result->Visible=true;
	}
	
	public function changeCaptcha($sender, $param)
	{
		$now = mktime();
		$this->captcha->ImageUrl="/stream?method=getCaptcha&width=60&height=23&".$now;
	}
	
}

?>
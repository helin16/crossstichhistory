<?php

class ContactusControl extends TTemplateControl  
{
	private $reciever;
	private $recieverEmail;
	public $title="";
	public $content="";
	public $description="";
	public $groupingText="";
	
	
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
			if(trim($this->description)==".")
				$this->contactusTitle->Text="";
			else
				$this->contactusTitle->Text= trim($this->description)=="" ? Prado::localize("ContactUs.title") : trim($this->description);
			$this->emailContent->Text= trim($this->content);
		}
	}
	
	/**
	 *  Getter for description
	 *
	 * @return PropertyType description
	 */
	public function getDescription() 
	{
	  return $this->description;
	}
	
	/**
	 * Setter for description
	 *
	 * @param PropertyType $Value
	 */
	public function setDescription($Value) 
	{
	  $this->description = $Value;
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
	
	/**
	 *  Getter for groupingText
	 *
	 * @return string groupingText
	 */
	public function getGroupingText() 
	{
	  return $this->groupingText;
	}
	
	/**
	 * Setter for groupingText
	 *
	 * @param string $Value
	 */
	public function setGroupingText($Value) 
	{
	  $this->groupingText = $Value;
	}
	
	
	public function sendEmail($sender, $params)
	{
		if(!$this->captcha->validate(trim($this->spamInput->Text)))
		{
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
	}
	
	public function changeCaptcha($sender,$param)
	{
		$this->captcha->regenerateToken();
		$this->spamInput->Text="";
		$this->spamInput->focus();
	}
}

?>
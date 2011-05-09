<?php

class NewsLetterControl extends TTemplateControl  
{
	public $imageRootPath="/";
	
	public function onLoad($param)
	{
	}

	/**
	 * getter imageRootPath
	 *
	 * @return imageRootPath
	 */
	public function getImageRootPath()
	{
		return $this->imageRootPath;
	}
	
	/**
	 * setter imageRootPath
	 *
	 * @var imageRootPath
	 */
	public function setImageRootPath($imageRootPath)
	{
		$this->imageRootPath = $imageRootPath;
	}
	
	public function subscribe($sender,$param)
	{
		$this->subscripionErrorMsg->Value="";
		$email = trim($this->subscribe_email->Text);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)===false)
		{
			$this->subscripionErrorMsg->Value="Invalid Email Address!";
			return;
		}
		
		try
		{
			$newsLetterService = new NewsLetterService();
			$newsLetterService->subscribe($email);
		}
		catch(Exception $e)
		{
			$this->subscripionErrorMsg->Value=$e->getMessage();
		}
		
		$this->subscripionErrorMsg->Value="You have successfully subscribed our news letter!";
		$this->subscribe_email->Text="";
	}
}

?>
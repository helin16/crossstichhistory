<?php

class LanguageChanger extends TTemplateControl  
{
	public $redirectPath="/";
	
	public function onLoad($param)
	{
	}
	
	public function changeLanguage($sender,$param)
	{
		$lang = $param->CommandParameter;
//		$info = new CultureInfo();
//        if($info->validCulture($lang)) //only valid lang is permitted
        $_SESSION["language"] = $lang;
        $this->Response->redirect($this->redirectPath);
	}
	
	/**
	 * getter redirectPath
	 *
	 * @return redirectPath
	 */
	public function getRedirectPath()
	{
		return $this->redirectPath;
	}
	
	/**
	 * setter redirectPath
	 *
	 * @var redirectPath
	 */
	public function setRedirectPath($redirectPath)
	{
		$this->redirectPath = $redirectPath;
	}
	
}

?>
<?php

class MenuModule extends TTemplateControl  
{
	public function onLoad($param)
	{
	}
	
	public function changeId($name)
	{
		$selectedItemName = "home";
		if(isset($this->Page->menuItemName)&& trim($this->Page->menuItemName)!="")
			$selectedItemName=trim(strtolower(str_replace(" ","",$this->Page->menuItemName)));
		return trim(strtolower(str_replace(" ","",$name)))==$selectedItemName ? " ID='active'" : "";
	}
	
	public function topSearches($keyWord)
	{
		return "&nbsp;&nbsp;<a style='color:white;text-decoration:none;outline:none;' href='/search/$keyWord'>$keyWord</a>";
	}
}

?>
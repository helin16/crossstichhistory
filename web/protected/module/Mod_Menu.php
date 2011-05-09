<?php
class Mod_Menu extends Mod_Module
{
	private $menuItems = array
				(
					"HOME"=>"/",
					"Contact Us"=>"/contactus.html",
					"About Us"=>"/aboutus.html"
				);
	public function renderContent()
	{
		if(!isset($this->params["style"]) || $this->params["style"]=="")
			$style='flatlist';
		else
			$style=trim(strtolower($this->params["style"]));
			
			
		$return="";
		switch($style)
		{
			case 'flatlist':
				{
					$return .="<ul class='$class' id='$id'>";
					foreach($this->menuItems as $name=> $url)
					{
						$return .="<li><a href='$url'>$name</a></li>";
					}
					$return .="</ul>";
					break;
				}
			case 'vertical':
				{
					$return .="<table class='$class' id='$id'>";
					foreach($this->menuItems as $name=> $url)
					{
						$return .="<tr><td><a href='$url'>$name</a></td></tr>";
					}
					$return .="</table>";
					break;
				}
			case 'horizontal':
				{
					$return .="<table class='$class' id='$id'><tr>";
					foreach($this->menuItems as $name=> $url)
					{
						$return .="<td><a href='$url'>$name</a></td>";
					}
					$return .="</tr></table>";
					break;
				}
			default:
				{
					$return .="Wrong Style! It can only be flatlist | vertical | horizontal (case-insensitive)!";
					break;
				}
		}
		
		return $return;
	}
}
?>
<?php
class Mod_Module
{
	protected $params=array();
	
	public function setParams($string)
	{
		$array = explode("\n",$string);
		foreach($array as $token)
		{
			list($key,$value) = explode("=",$token);
			$this->params[$key] = $value;
		}
	}
}
?>
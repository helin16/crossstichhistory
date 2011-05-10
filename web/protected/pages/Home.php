<?php

class Home extends EshopPage
{
	public function onLoad($param)
	{
		if(!$this->isPostBack)
		{
			$this->setTitle("Home");
		}
	}
	
	protected function getBanner()
	{
		$this->getPage()->getMaster()->banner->Visible=false;
		return "";
	}
}

?>
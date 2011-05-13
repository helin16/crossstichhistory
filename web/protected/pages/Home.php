<?php

class Home extends EshopPage
{
	public function onLoad($param)
	{
		if(!$this->isPostBack)
		{
			$this->setTitle("Home");
			$this->getMaster()->cotentSpace->setStyle("margin: 10px 0 7px 7px; text-align:left; ");
			$this->topSellersPanel->loadProducts(2);
			$this->justArrivedPanel->loadProducts(1);
			$this->readyToUsePanel->loadProducts(3);
		}
	}
	
	protected function getBanner()
	{
		$this->getPage()->getMaster()->banner->Visible=false;
		return "";
	}
}

?>
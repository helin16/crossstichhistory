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
			$this->justArrivedPanel->loadProducts(23);
			$this->readyToUsePanel->loadProducts(3);
			$this->kitsPanel->loadProducts(5);
		}
	}
	
	protected function getBanner()
	{
		$this->getPage()->getMaster()->banner->Visible=false;
		return "";
	}
}

?>
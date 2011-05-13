<?php
class ProductLoaderController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$categoryName = $this->Request["categorytitle"];
		$this->preloadTitle=Prado::localize("Menu.prouductDetails");
		$this->menuItemName="prouductDetails";
	}
	
	public function onLoad()
	{
		if(!$this->IsPostBack)
		{
			$service = new BaseService("Product");
			$where = "languageId=".Core::getPageLanguage()->getId()." and title ='".trim($this->Request["title"])."' ";
			$categories =  $service->findByCriteria($where);
			if(count($categories)==0)
				return;
			$this->productId->loadProduct($categories[0]->getId());
		}
	}
}
?>
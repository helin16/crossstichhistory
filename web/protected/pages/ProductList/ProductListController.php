<?php
class ProductListController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$categoryName = $this->Request["categorytitle"];
		$this->preloadTitle=Prado::localize("Menu.$categoryName");
		$this->menuItemName="$categoryName";
	}
	
	public function onLoad()
	{
		if(!$this->IsPostBack)
		{
			$service = new BaseService("ProductCategory");
			$where = "languageId=".Core::getPageLanguage()->getId()." and name ='".trim($this->Request["categorytitle"])."' ";
			$categories =  $service->findByCriteria($where);
			if(count($categories)==0)
				return;
			$this->productId->loadProducts($categories[0]->getId());
		}
	}
}
?>
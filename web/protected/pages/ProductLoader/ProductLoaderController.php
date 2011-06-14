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
        parent::onLoad($param);
		if(!$this->IsPostBack)
		{
			$service = new BaseService("Product");
			$where = "languageId=".Core::getPageLanguage()->getId()." and title ='".trim($this->Request["title"])."' ";
			$products =  $service->findByCriteria($where);
			if(count($products)==0)
				return;
				
			$product =$products[0];
			if(!$product instanceof Product)
				return;
				
			$productName = $product->getTitle();
			$productSKU = $product->getSku();
			$this->contactus->setTitle("For product ({$productName}[$productSKU])");
			$this->contactus->setContent("In regards on the product: {$productName}[$productSKU] website (".$_SERVER['HTTP_HOST'].")");

			$this->productId->setFocusContactUsTBoxId($this->contactus->spamInput->getClientId());
			$this->productId->loadProduct($product->getId());
		}
	}
}
?>
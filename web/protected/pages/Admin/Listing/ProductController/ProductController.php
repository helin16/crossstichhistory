<?php

class ProductController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="products";
		$this->entityName="Product";
	}
	
	/**
	 * onLoad method
	 *
	 * @param $param
	 */
    public function onLoad($param)
    {
     	parent::onLoad($param);
        
       	if(!$this->IsPostBack || $param == "reload")
        {        
			$this->AddPanel->Visible = false;
			$this->DataList->EditItemIndex = -1;
			$this->dataLoad();
        }
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService($this->entityName);
    	$where = "languageId=".$this->pageLanguage->getId()." and (pro.title like '%$searchString%' or pro.description like '%$searchString%')";
    	if($focusObject instanceof ProductCategory)
	    	$where .= " and id in (select distinct x.productId from product_productcategory x where x.productCategoryId = ".$focusObject->getId().")";
    	$result =  $service->findByCriteria($where,false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	$service = new BaseService($this->entityName);
    	$where = "languageId=".$this->pageLanguage->getId();
    	if($focusObject instanceof ProductCategory )
	    	$where .= " and id in (select distinct x.productId from product_productcategory x where x.productCategoryId = ".$focusObject->getId().")";
    	$result =  $service->findByCriteria($where,false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function resetFields()
    {
    	$this->productEditPane->clearFields();
    }
    
	protected function populateEdit($editItem)
    {
    	$product = $editItem->getData();
    	$editItem->productEditPane->loadProduct($product->getId());
    	$editItem->productEditPane->title->focus();
    }
    
	protected function setEntity(&$product,$params,&$focusObject = null)
    {
    	try
    	{
	    	$service = new BaseService("Product");
			$title = trim($params->productEditPane->title->Text);
			$description = trim($params->productEditPane->description->Text);
			$sku = trim($params->productEditPane->sku->Text);
			$visits = trim($params->productEditPane->visits->Text);
			$unitPrice = trim($params->productEditPane->unitPrice->Text);
			
			$width = trim($params->productEditPane->width->Text);
			$length = trim($params->productEditPane->length->Text);
			$height = trim($params->productEditPane->height->Text);
			
			$assetIds = explode(",",trim($params->productEditPane->assetIds->Value));
			$categoryIds = $params->productEditPane->categoryList->getSelectedValues();
			
			$product->setTitle($title);
			$product->setDescription($description);
			$product->setSku($sku);
			$product->setNoOfVisits($visits);
			$product->setUnitPrice($unitPrice);
			$product->setLanguage(Core::getPageLanguage());
			
			$service->save($product);
			
			$product->clearFeature(ProductFeatureCategory::ID_IMAGE);
			foreach($assetIds as $assetId)
			{
				$product->addFeature(ProductFeatureCategory::ID_IMAGE,$assetId);
			}
			
			$product->clearFeature(ProductFeatureCategory::ID_DIMENSION_L);
			$product->addFeature(ProductFeatureCategory::ID_DIMENSION_L,$length);
			
			$product->clearFeature(ProductFeatureCategory::ID_DIMENSION_W);
			$product->addFeature(ProductFeatureCategory::ID_DIMENSION_W,$width);
			
			$product->clearFeature(ProductFeatureCategory::ID_DIMENSION_H);
			$product->addFeature(ProductFeatureCategory::ID_DIMENSION_H,$height);
			
			$product->clearCategory();
			foreach($categoryIds as $categoryId)
			{
				$product->addCategory($categoryId);
			}
			
			$this->setInfoMessage("Proudct saved successfully!");
    	}
    	catch(Exception $ex)
    	{
    		$this->setErrorMessage($ex->getMessage());
    	}
    }
    
    
    public function shortenText($text,$maxLength=150)
    {
    	$text = strip_tags($text);
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
    public function listImages(Product $product)
    {
    	$assetIds = trim($product->getFeature());
    	if($assetIds=="")
    		return;
    	
    	$assetServer = new AssetServer();
    	$imageFolder = Config::get("imageResizer","imageURL");
    	$title = $product->getTitle();
    	$html="";
    	foreach(explode(",",$assetIds) as $assetId)
    	{
    		if(trim($assetId)!="")
    		{
    			$html .="<a href=\"{$imageFolder}h900-w900/".$assetServer->getFilePath($assetId)."\" rel=\"lightbox[".$title."]\" style='padding:2px;margin: 5px;' title=\"pic for $title\">";
    			$html .="<img src='{$imageFolder}h40-w40/".$assetServer->getFilePath($assetId)."' style='border:none;' />";
    			$html .="</a>";
    		}
    	}
    	return $html;
    }
    
    public function getCategories(Product $product)
    {
    	$html="<ul style='margin:0px;padding:0px;'>";
    		foreach($product->getProductCategories() as $category)
    		{
		    	$html .="<li><a href='/admin/list/product/ProductCategory/".$category->getId().".html'>";
			    	$html .=$category->getName();
		    	$html .="</a></li>";
    		}
    	$html .="</ul>";
    	return $html;
    }
    
    public function loadProduct($sender,$param)
    {
    	$productId = trim($param->CommandParameter);
    	$this->productEditPane->loadProduct($productId);
    }
    
    public function cloneProduct($sender,$param)
    {
    	$this->AddPanel->Visible = true;
    	$this->DataList->EditItemIndex = -1;
    	$this->dataLoad();
    	
    	$productId = trim($param->CommandParameter);
    	$service = new BaseService("Product");
    	$product = $service->get($productId);
    	if(!$product instanceof Product)
    	{
    		$this->AddPanel->Visible = false;
    		$this->setErrorMessage("Invalid product to clone from(ID='$productId')!");
    		return;
    	}
    		
    	$title= "Copy of ".trim($product->getTitle());
		$description= trim($product->getDescription());
		$sku= "Copy of ".trim($product->getSku());
		$visits= trim($product->getNoOfVisits());
		$unitPrice= trim($product->getUnitPrice());
		
		//get categories
		$ids = array();
		foreach($product->getProductCategories() as $category)
		{$ids[] = $category->getId();}
		
		//get features
		$length = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_L));
		$width = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_W));
		$height = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_H));
		
    	$this->productEditPane->loadProductDetails("",$title,$description,$sku,$visits,$unitPrice,$ids,$length,$width,$height);
    	$this->productEditPane->title->focus();
    }
}

?>

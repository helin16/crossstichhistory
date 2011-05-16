<?php

class ProductEditControl extends TTemplateControl  
{
	public $productId;
	
	public function onLoad($param)
	{
		$this->getCategories();
	}
	
	public function loadProduct($productId="")
	{
		$this->clearFields();
		$this->product_Id->Value = trim($productId);
		$this->productId = trim($productId);
		$service = new BaseService("Product");
		$product = $service->get($this->productId);
		if(!$product instanceof Product)
			return ;
		$this->title->Text = $product->getTitle();
		$this->description->Text = $product->getDescription();
		$this->sku->Text = $product->getSku();
		$this->visits->Text = $product->getNoOfVisits();
		
		//get categories
		$ids = array();
		foreach($product->getProductCategories() as $category)
		{
			$ids[] = $category->getId();
		}
		if(count($ids)>0)
			 $this->categories->setSelectedValues($ids);
		
		//get features
		$this->length->Text = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_L));
		$this->width->Text = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_W));
		$this->height->Text = trim($product->getFeature(ProductFeatureCategory::ID_DIMENSION_H));
		
		//get images
		$assetIds = trim($product->getFeature(ProductFeatureCategory::ID_IMAGE));
		if($assetIds=="")
			return;
		$this->assetIds->Value = $assetIds;
		$this->loadImages(null,null);
	}
	
	private function clearFields()
	{
		$this->product_Id->Value="";
		$this->title->Text = "";
		$this->description->Text = "";
		$this->sku->Text = "";
		$this->visits->Text = "";
		
		$this->length->Text = "";
		$this->width->Text = "";
		$this->height->Text = "";
		
		$this->errorMsg->Text="";
		$this->imageList->Text = "";
		$this->assetIds->Value = "";
		
		$this->getCategories();
		$this->categories->setSelectedIndex(-1);
	}
	
	private function getCategories(array $selectedIds=array())
	{
		$service =new BaseService("ProductCategory");
		$result =  $service->findByCriteria("languageId=".Core::getPageLanguage()->getId());
		$this->categories->DataSource =$result;
		$this->categories->DataBind();
		
		if(count($selectedIds)!=0)
			$this->categories->setSelectedValues($selectedIds);
	}
	
	public function fileUploaded($sender,$param)
	{
		$this->errorMsg->Text="";
		try
		{
			if($sender->HasFile)
			{
				$imageFile =fopen($sender->LocalName, "r");
				$imageStream = stream_get_contents($imageFile);
				
				$contentServer = new AssetServer();
				$assetId = $contentServer->registerAsset(AssetServer::TYPE_GRAPH, $sender->FileName, $imageStream);
				
				if(trim($this->assetIds->Value)=='')
					$assetIds = array();
				else
					$assetIds = explode(",",trim($this->assetIds->Value));
				$assetIds[] = $assetId;
				
				$this->assetIds->Value = implode(",",$assetIds);
				
				$this->loadImages(null,null);
			}
		}
		catch(Exception $x)
		{
			$this->errorMsg->Text=$x->getMessage();
		}
	}
	
 	public function loadImages($sender,$param)
    {
    	$this->imageList->Text = "";
    	$assetIds =  explode(",",trim($this->assetIds->Value));
    	if(!is_array($assetIds) || count($assetIds)==0)
    		return;
    	$service = new BaseService("Asset");
    	$assets = $service->findByCriteria("assetId in ('".implode("','",$assetIds)."')");
    	if(count($assets)==0)
    		return;
    	
    	$showingAssetId = trim($this->showingAssetId->Value);
    	if($showingAssetId=="")
    	{
    		$this->showingAssetId->Value = $assetIds[0];
    		$showingAssetId = trim($this->showingAssetId->Value);
    	}
    	$html="
    		<a href='javascript:void(0);' OnClick=\"deleteImage_".$this->getId()."();\">Delete This Image</a><br />
    		<img id='previewImage' src='/asset/$showingAssetId/".serialize(array("height"=>200,"width"=>200))."' style='border: 1px #cccccc solid;padding:15px;'/>
    		<br /><hr />";
    	foreach($assetIds as $assetId)
    	{
			$html .="<img onMouseOver=\"this.style.border='1px #ff0000 solid';\"  onMouseOut=\"this.style.border='none';\" OnClick=\"loadPreview_".$this->getId()."('$assetId');\"  src='/asset/$assetId/".serialize(array("height"=>50,"width"=>50))."' style='padding: 5px;' />";
    	}
    	$this->imageList->Text = $html;
    }
	
	public function save($sender,$param)
	{
		$this->errorMsg->Text="";
		try
		{
			$service = new BaseService("Product");
			$title = trim($this->title->Text);
			$description = trim($this->description->Text);
			$categoryIds = $this->categories->getSelectedValues();
			
			$sku = trim($this->sku->Text);
			$visits = trim($this->visits->Text);
			
			$width = trim($this->width->Text);
			$length = trim($this->length->Text);
			$height = trim($this->height->Text);
			
			$assetIds = explode(",",trim($this->assetIds->Value));
			
			$productId = trim($this->product_Id->Value);
			if($productId!="")
				$product = $service->get($productId);
			else
				$product = new Product();
			$product->setTitle($title);
			$product->setDescription($description);
			$product->setSku($sku);
			$product->setNoOfVisits($visits);
			$product->setLanguage(Core::getPageLanguage());
			
			$service->save($product);
			
			$product->clearFeature(ProductFeatureCategory::ID_IMAGE);
			foreach($assetIds as $assetId)
			{
				$product->addFeature(ProductFeatureCategory::ID_IMAGE,$assetId);
			}
			
			$product->clearCategory();
			foreach($categoryIds as $categoryId)
			{
				$product->addCategory($categoryId);
			}
		}
		catch(Exception $x)
		{
			$this->errorMsg->Text=$x->getTraceAsString();
		}
	}
}

?>
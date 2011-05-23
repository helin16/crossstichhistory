<?php

class ProductEditControl extends TTemplateControl  
{
	public $pageFunc_saving="";
	public $pageFunc_cancel="";
	public $validationGroup="ProductEditControlGroup";
	
	public function onLoad($param)
	{
		$this->getCategories();
	}
	
	/**
	 *  Getter for pageFunc_saving
	 *
	 * @return string pageFunc_saving
	 */
	public function getPageFunc_saving() 
	{
	  return $this->pageFunc_saving;
	}
	
	/**
	 * Setter for pageFunc_saving
	 *
	 * @param string $Value
	 */
	public function setPageFunc_saving($Value) 
	{
	  $this->pageFunc_saving = $Value;
	}
	
	/**
	 *  Getter for pageFunc_cancel
	 *
	 * @return string pageFunc_cancel
	 */
	public function getPageFunc_cancel() 
	{
	  return $this->pageFunc_cancel;
	}
	
	/**
	 * Setter for pageFunc_cancel
	 *
	 * @param string $Value
	 */
	public function setPageFunc_cancel($Value) 
	{
	  $this->pageFunc_cancel = $Value;
	}
	
	/**
	 *  Getter for validationGroup
	 *
	 * @return string validationGroup
	 */
	public function getValidationGroup() 
	{
	  return $this->validationGroup;
	}
	
	/**
	 * Setter for validationGroup
	 *
	 * @param string $Value
	 */
	public function setValidationGroup($Value) 
	{
	  $this->validationGroup = $Value;
	}
	
	public function loadProduct($productId="")
	{
		$this->clearFields();
		$this->product_Id->Value = trim($productId);
		$service = new BaseService("Product");
		$product = $service->get( trim($productId));
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
	
	public function clearFields()
	{
		$this->product_Id->Value="";
		$this->title->Text = "";
		$this->description->Text = "";
		$this->sku->Text = "";
		$this->visits->Text = "";
		
		$this->length->Text = "";
		$this->width->Text = "";
		$this->height->Text = "";
		
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
    	
    	$assetServer = new AssetServer();
    	$imageFolder = Config::get("imageResizer","imageURL");
    	$thumb_H = $thumb_W = 150;
    	$padding= 5;
    	$html="";
    	foreach($assetIds as $assetId)
    	{
			$html .="<table id='imageShow_$assetId' border=0 style='margin:4px;border: 1px #cccccc solid;float:left;display:block;width:".($thumb_W+$padding+2)."px;' onMouseOver=\"this.style.border='1px #ff0000 solid';\" onMouseOut=\"this.style.border='1px #cccccc solid';\">";
				$html .="<tr>";
					$html .="<td valign='middle' align='center'>";
						$html .="<img OnClick=\"\"  src='{$imageFolder}/h$thumb_H-w$thumb_W/".$assetServer->getFilePath($assetId)."' />";
					$html .="</td>";
				$html .="</tr>";
				$html .="<tr>";
					$html .="<td style='background:#cccccc;'>";
						$html .="<div><input type='image' src='/image/delete.gif' onclick=\"deleteImage_".$this->getId()."('$assetId');return false;\" style='float:right;' value='delete'/></div>";
					$html .="</td>";
				$html .="</tr>";
			$html .="</table>";
    	}
    	$this->imageList->Text = $html;
    }
    
    public function save($sender,$param)
    {
    	$this->Page->{$this->pageFunc_saving}($sender,$param);
    }
    
    public function cancel($sender,$param)
    {
    	$this->Page->{$this->pageFunc_cancel}($sender,$param);
    }
}

?>
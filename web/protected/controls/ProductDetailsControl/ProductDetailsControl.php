<?php

class ProductDetailsControl extends TTemplateControl  
{
	public $productId;
	
	public function onLoad($param)
	{
	}
	
	public function loadProduct($productId="")
	{
		$this->product_Id->Value = trim($productId);
		$this->productId = trim($productId);
		$service = new BaseService("Product");
		$product = $service->get($this->productId);
		if(!$product instanceof Product)
			return ;
			
		$this->title->Text = $product->getTitle();
		$this->description->Text = $product->getDescription();
		$this->sku->Text = $product->getSku();
		
		//get features
		$this->length->Text = $product->getFeature(ProductFeatureCategory::ID_DIMENSION_L);
		$this->width->Text = $product->getFeature(ProductFeatureCategory::ID_DIMENSION_W);
		$this->height->Text = $product->getFeature(ProductFeatureCategory::ID_DIMENSION_H);
		
		//get images
		$assetIds = trim($product->getFeature(ProductFeatureCategory::ID_IMAGE));
		if($assetIds=="")
			return;
		$assetIds = explode(",",$assetIds);
		$this->assetIds->Value = $assetIds;
		$this->loadImages();
	}
	
 	public function loadImages()
    {
    	$this->imageList->Text = "";
    	$assetIds = unserialize(trim($this->assetIds->Value));
    	if(!is_array($assetIds) || count($assetIds)==0)
    		return;
    	$service = new BaseService("Asset");
    	$assets = $service->findByCriteria("assetId in ('".implode("','",$assetIds)."')");
    	if(count($assets)==0)
    		return;
    	
    	$html="
    		<img id='previewImage' src='/asset/{$assetIds[0]}/".serialize(array("height"=>150,"width"=>150))."' style='border: 1px #cccccc solid;padding:15px;'/>
    		<br /><hr />";
    	foreach($assetIds as $assetId)
    	{
			$html .="<a href='javascript:void(0);' 
						onMouseOver=\"this.style.border='1px #ff0000 solid';\" 
						onMouseOut=\"this.style.border='none';\" OnClick=\"loadPreview('$assetId');\" 
						>
						<img src='/asset/$assetId/".serialize(array("height"=>50,"width"=>50))."' style='margin: 5px;' />
					</a>";
    	}
    	$this->imageList->Text = $html;
    }
}

?>
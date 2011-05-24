<?php

class ProductDetailsControl extends TTemplateControl  
{
	public $productId;
	private $preview_image_w = 390;
	private $preview_image_h = 300;
	
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
		$this->assetIds->Value = $assetIds;
		$this->loadImages();
	}
	
 	public function loadImages()
    {
    	$noImage = "<img id='previewImage_".$this->getId()."' src='/stream?method=getCaptcha&width={$this->preview_image_w}&height={$this->preview_image_h}&noise=3000&displayString=NoImage' style='padding:7px;'/>";
    	$this->imageList->Text = "";
    	$ids =trim($this->assetIds->Value);
    	$assetIds = explode(",",$ids);
    	if($ids=="" || count($assetIds)==0)
    	{
    		$this->imageList->Text = $noImage;
    		return;
    	}
    	
    	$service = new BaseService("Asset");
    	$assets = $service->findByCriteria("assetId in ('".implode("','",$assetIds)."')");
    	if(count($assets)==0)
    	{
    		$this->imageList->Text = $noImage;
    		return;
    	}
    	
    	$assetServer = new AssetServer();
    	$imageFolder = Config::get("imageResizer","imageURL");
    	$html ="<script type='text/javascript' src='/3rdPartyScript/LightBox/lightbox.js'></script>";
    	$html .="<link rel='stylesheet' href='/3rdPartyScript/LightBox/lightbox.css' type='text/css' media='screen' />";
    	$html .= "<img id='previewImage_".$this->getId()."' src='{$imageFolder}h{$this->preview_image_h}-w{$this->preview_image_w}/".$assetServer->getFilePath($assetIds[0])."' style='padding:7px;'/>";
    	$html .="<div>";
    	foreach($assetIds as $assetId)
    	{
	    	$html .="<a href=\"{$imageFolder}h400-w400/".$assetServer->getFilePath($assetId)."\" rel=\"lightbox[details]\" style='padding:2px;margin: 5px;' title=\"pic for viewing product\">";
				$html .="<img src='/asset/$assetId/".serialize(array("height"=>50,"width"=>50))."' style='padding:7px;margin:1px;'
							onMouseOver=\"this.style.border='1px #ff0000 solid';\"
							onMouseOut=\"this.style.border='none';\"
							/>";
    		$html .="</a>";
    	}
    	$html .="</div>";
    	$this->imageList->Text = $html;
    }
    
    public function getPreviewDimensionArray()
    {
    	return serialize(array('height'=>$this->preview_image_h,'width'=>$this->preview_image_w));
    }
}

?>
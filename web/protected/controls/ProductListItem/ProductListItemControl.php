<?php

class ProductListItemControl extends TPanel  
{
	public $productId;
	public $maxIntroLength=450;
	
	/**
	 *  Getter for productId
	 *
	 * @return PropertyType productId
	 */
	public function getProductId() 
	{
	  return $this->productId;
	}
	
	/**
	 * Setter for productId
	 *
	 * @param PropertyType $Value
	 */
	public function setProductId($Value) 
	{
	  $this->productId = $Value;
	}
	
	
	/**
	 * getter maxIntroLength
	 *
	 * @return maxIntroLength
	 */
	public function getMaxIntroLength()
	{
		return $this->maxIntroLength;
	}
	
	/**
	 * setter maxIntroLength
	 *
	 * @var maxIntroLength
	 */
	public function setMaxIntroLength($maxIntroLength)
	{
		$this->maxIntroLength = $maxIntroLength;
	}
	
	
	/**
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getProductListItem($this->productId,$this->maxIntroLength));
		parent::renderEndTag($writer);
	}
	
	public function getProductListItem($productId,$maxIntroLength=PHP_INT_MAX)
	{
		$service = new BaseService("Product");
		$product = $service->get($productId);
		if(!$product instanceof Product)
			return;
			
		$assetServer = new AssetServer();
    	$imageFolder = Config::get("imageResizer","imageURL");
		$maxIntroLength = $this->maxIntroLength;
		$table="<table width='100%'>";
			$table.="<tr>";
				$table.="<td align='left'>";
					$title = $product->getTitle();
					$table .="<a href='/product/".$title.".html' style='font-size:16px;font-weight:bold;text-decoration:none;color:#BF3A17'>$title</a>";
				$table.="</td>";
				$table.="<td align='right' style='font-size:9px;width:15%;'>";
					$table .=$product->getCreated();
				$table.="</td>";
			$table.="</tr>";
			$table.="<tr>";
				$table.="<td colspan='2' style='padding:5px;text-align:justify;'>";
					$text = strip_tags($product->getDescription());
					$table .=(strlen($text)>$maxIntroLength ? substr($text,0,$maxIntroLength)." ... " : $text);
				$table.="</td>";
			$table.="</tr>";
			$table.="<tr>";
				$table.="<td>&nbsp;</td>";
				$table.="<td align='right'>";
					$table .= "<a href='/product/".$title.".html' style='background:#BF3A17;color:#ffffff;font-size:10px;padding:2px;text-decoration:none;'>details</a>";
				$table.="</td>";
			$table.="</tr>";
		$table.="</table>";
		
		$image_H = $image_W =100;
		$html="<table width='100%'>";
			$html.="<tr valign='top'>";
				$html.="<td width='{$image_H}px'>";
					$html .="<a href='/product/".$title.".html'>";
						$assetIds = trim($product->getFeature());
						$imagesIds = explode(",",$assetIds);
						if($assetIds=="" || count($imagesIds)==0)
							$html .="<img src='/stream?method=getCaptcha&width={$image_W}&height={$image_H}&noise=2000&displayString=NoImage' style='border:none;'/>";
						else
							$html .="<img src='{$imageFolder}/h$image_H-w$image_W/".$assetServer->getFilePath($imagesIds[0])."' style='border:none;'/>";
					$html .="</a>";
				$html.="</td>";
				$html.="<td>";
					$html.="$table";
				$html.="</td>";
			$html.="</tr>";
		$html.="</table>";
		return $html;
	}
}

?>
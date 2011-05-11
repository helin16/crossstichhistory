<?php

class ProductListControl extends TTemplateControl  
{
	public $itemsPerRow=4;
	public $noOfRows=4;
	
	public function loadProducts($categoryId)
	{
		if(trim($this->currentPageNo->Value)=="")
			$this->currentPageNo->Value = 1;
		$pageNumber = trim($this->currentPageNo->Value);
		$pageSize = $this->itemsPerRow * $this->noOfRows;
		
		$service = new BaseService("Product");
		$where = "languageId=".Core::getPageLanguage()->getId()." and id in (select distinct x.productId from product_productcategory x where x.productcategoryId = $categoryId)";
		$result =  $service->findByCriteria($where,true,$pageNumber,$pageSize);
		$pages =Dao::getTotalPages();
		if(count($result)==0)
			return;
			
		$colWidth = (100 /  $this->noOfRows)."%";
		$html="<table style='width:100%;padding:0px;' border='0' cellspacing='0' cellpadding='0'>";
			$html.="<tr>";
			$colNo=0;
			foreach($result as $product)
			{
				if($colNo == $this->itemsPerRow)
				{
					$html.="</tr><tr>";	
					$colNo=0;
				}
				
				$html.="<td width='$colWidth'>";	
					$html.=$product->getSnapshot();	
				$html.="</td>";	
				
				$colNo++;
			}
			
			if($colNo < ($this->itemsPerRow))
			{
				for($i =$colNo;$i< $this->itemsPerRow ;$i++)
				{
					$html.="<td width='$colWidth'>&nbsp;</td>";	
				}
			}
			
			$html.="</tr>";
		$html.="</table>";
		if($pageNumber<$pages)
		{
			$html.="<div id='nav_".$this->getId()."'>$pageNumber: $pages";
				for($i=0;$i<$pages;$i++)
				{
					$html.="<a href='#' style='display:block; padding: 3px;'>$i</a>";
				}
			$html.="</div>";
		}
		$this->productListPanel_display->Text = $html;
	}
}

?>
<?php

class ProductListControl extends TTemplateControl  
{
	public $itemsPerRow=4;
	public $noOfRows=4;
	public $maxOfItems=PHP_INT_MAX;
	
	public $showMore=false;
	
	public function onLoad($param)
	{
		if(!$this->getPage()->getIsCallback() && !$this->getPage()->getIsPostBack())
		{
			$this->currentPageNo->Value = 1;
		}
	}
	
	public function loadProducts($categoryId)
	{
		$this->categoryId->Value = $categoryId;
		$this->showProducts(null,null);
	}
	
	public function showProducts($sender,$param)
	{
		$categoryId = trim($this->categoryId->Value);
		
		$pageNumber = trim($this->currentPageNo->Value);
		$pageSize = $this->itemsPerRow * $this->noOfRows;
		
		$service = new BaseService("Product");
		$where = "languageId=".Core::getPageLanguage()->getId()." and id in (select distinct x.productId from product_productcategory x where x.productcategoryId = $categoryId)";
		$result =  $service->findByCriteria($where,true,$pageNumber,$pageSize,array("Product.id"=>"desc"));
		$pages =Dao::getTotalPages();
		if(count($result)==0)
			return;
			
		$cateService = new BaseService("ProductCategory");
		$category = $cateService->get($categoryId);
		if(!$category instanceof ProductCategory)
			return;
			
		$colWidth = (100 /  $this->noOfRows)."%";
		$html="<table style='width:100%;padding:0px;' border='0' cellspacing='0' cellpadding='0'>";
			$html.="<tr>";
				$html.="<td style='font-size: 13px;font-weight:bold; color: #810e11; border-bottom:1px #cccccc solid; padding: 0 0 3px 7px;' colspan='{$this->itemsPerRow}'>";
					$html.=$category;
					if($this->showMore)
						$html.="<a href='/productlist/category/{$category->getName()}.html' style='font-size: 13px;color: #810e11; float:right; text-decoration:none; outline:none; padding: 0 15px 0 0;'>more</a>";
				$html.="</td>";
			$html.="</tr>";
			$html.="<tr>";
			
			$colNo=0;
			$noOfItems = 0;
			foreach($result as $product)
			{
				if($noOfItems==$this->maxOfItems)
					break;
				if($colNo == $this->itemsPerRow)
				{
					$html.="</tr><tr><td height='15px'></td></tr><tr>";	
					$colNo=0;
				}
				
				$html.="<td width='$colWidth'>";	
					$html.=$product->getSnapshot();	
				$html.="</td>";	
				
				$colNo++;
				$noOfItems++;
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
		
		if($pages !=1 && !($this->showMore))
		{
			$html.="<table id='nav_".$this->getId()."' class='nav_item_list'>";
				$html.="<tr>";
					$html.="<td>You can navigate to:</td>";
					for($i=1;$i<=$pages;$i++)
					{
						$html.="<td style='width:10px;' class='nav_item'>";
						if($pageNumber==$i)
							$html.="<b>$i</b>";
						else
							$html.="<a href='javascript:void(0);' onclick='changePage_".$this->getID()."($i); return false;'>$i</a>";
						$html.="</td>";
					}
				$html.="</tr>";
			$html.="</table>";
		}
		$this->productListPanel_display->Text = $html;
	}
	
	/**
	 * getter maxOfItems
	 *
	 * @return maxOfItems
	 */
	public function getMaxOfItems()
	{
		return $this->maxOfItems;
	}
	
	/**
	 * setter maxOfItems
	 *
	 * @var maxOfItems
	 */
	public function setMaxOfItems($maxOfItems)
	{
		$this->maxOfItems = $maxOfItems;
	}
	
	/**
	 * getter noOfRows
	 *
	 * @return noOfRows
	 */
	public function getNoOfRows()
	{
		return $this->noOfRows;
	}
	
	/**
	 * setter noOfRows
	 *
	 * @var noOfRows
	 */
	public function setNoOfRows($noOfRows)
	{
		$this->noOfRows = $noOfRows;
	}
	
	/**
	 * getter itemsPerRow
	 *
	 * @return itemsPerRow
	 */
	public function getItemsPerRow()
	{
		return $this->itemsPerRow;
	}
	
	/**
	 * setter itemsPerRow
	 *
	 * @var itemsPerRow
	 */
	public function setItemsPerRow($itemsPerRow)
	{
		$this->itemsPerRow = $itemsPerRow;
	}
	
	/**
	 *  Getter for showMore
	 *
	 * @return bool showMore
	 */
	public function getShowMore() 
	{
	  return $this->showMore;
	}
	
	/**
	 * Setter for showMore
	 *
	 * @param bool $Value
	 */
	public function setShowMore($Value) 
	{
	  $this->showMore = $Value;
	}
	
}

?>
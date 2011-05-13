<?php

class ProductCategoryListControl extends TTemplateControl  
{
	public $excludingIds ="";
	
	public function onLoad()
	{
		$this->loadList(explode(",",$this->excludingIds));
	}
	
	public function loadList(Array $excludingIds=array())
	{
		$temp = array();
		foreach($excludingIds as $id)
		{
			if(trim($id)!="")
				$temp[] = $id;
		}
		$excludingIds = $temp;
		$service = new BaseService("ProductCategory");
		$where = "languageId=".Core::getPageLanguage()->getId();
		if(count($excludingIds)!=0)
			$where .= " and id not in (".implode(",",$excludingIds).")";
		$result =  $service->findByCriteria($where);
		if(count($result)==0)
			return;

		$html="<h3 style='background:#0084C8; color: white;font-size:14px; margin:0 0 10px 0; padding: 3px 0 3px 0;' >Products</h3>";
		$html .="<table style='width:100%;padding:0px;text-align:left;'  border='0' cellspacing='0' cellpadding='0'>	";
			foreach($result as $catetgory)
			{
				$html .="<tr>";
					$html .="<td>";
						$html .="<a href='/productlist/category/{$catetgory->getName()}.html' style='outline:none; text-decoration:none; font-size:12px; padding: 3px 0 3px 15px; display:block;' >{$catetgory->getName()}</a>";
					$html .="</td>";
				$html .="</tr>";
			}
		$html .="</table>";	
		$this->productListPanel_display->Text = $html;
	}
	
	public function getRoundCornerHead()
	{
		return EshopPage::getRoundCornerHead();
	}
	
	public function getRoundCornerFooter()
	{
		return EshopPage::getRoundCornerFooter();
	}
}

?>
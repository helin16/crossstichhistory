<?php

class ContentListControl extends TPanel  
{
	public $categoryId="";
	public $categoryName="";
	public $noOfItems=4;
	public $subTitle="";
	
	/**
	 * getter noOfItems
	 *
	 * @return noOfItems
	 */
	public function getNoOfItems()
	{
		return $this->noOfItems;
	}
	
	/**
	 * setter noOfItems
	 *
	 * @var noOfItems
	 */
	public function setNoOfItems($noOfItems)
	{
		$this->noOfItems = $noOfItems;
	}
	
	/**
	 * getter categoryId
	 *
	 * @return categoryId
	 */
	public function getCategoryId()
	{
		return $this->categoryId;
	}
	
	/**
	 * setter categoryId
	 *
	 * @var categoryId
	 */
	public function setCategoryId($categoryId)
	{
		$this->categoryId = $categoryId;
	}
	
	/**
	 * getter subTitle
	 *
	 * @return subTitle
	 */
	public function getSubTitle()
	{
		return $this->subTitle;
	}
	
	/**
	 * getter categoryName
	 *
	 * @return categoryName
	 */
	public function getCategoryName()
	{
		return $this->categoryName;
	}
	
	/**
	 * setter categoryName
	 *
	 * @var categoryName
	 */
	public function setCategoryName($categoryName)
	{
		$this->categoryName = $categoryName;
	}
	
	
	/**
	 * setter subTitle
	 *
	 * @var subTitle
	 */
	public function setSubTitle($subTitle)
	{
		$this->subTitle = $subTitle;
	}
	
	public function getNewsList($categoryId,$categoryName="",$noOfItems=4,$subtitle="")
	{
		$service = new BaseService("ContentCategory");
		$category = $service->get($categoryId);
		if(!$category instanceof ContentCategory)
		{
			$result = $service->findByCriteria("name like '".trim($categoryName)."'");
			$category = count($result)>0 ? $result[0] : null;
			if(!$category instanceof ContentCategory)
				return;
		}
		
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='padding: 5px 0 5px 5px; text-align:left;'>";
					$categoryName=$category->getName();
					$html .= "<a href='/contentlist/category/".str_replace(" ","_",trim($categoryName)).".html' style='text-decoration:none;font-weight:bold;color:#000000;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;font-size:14px;'>$categoryName</a>";;
					if($subtitle!="")
						$html .="<br /><i style='color:#AC7755;font-size:16px;font-family:cursive;font-weight:normal;'>$subtitle</i>";
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td style='font-size:13px;text-align: justify;padding: 0 0 10px 0;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;'>";
					$categoryId = $category->getId();
					$qry = "select c.id,c.title from content c
							inner join content_contentcategory x on (x.contentId = c.id and x.contentCategoryId = $categoryId)
							where c.active = 1
							order by c.id desc
							limit $noOfItems";
					$results = Dao::getResultsNative($qry,array(),PDO::FETCH_ASSOC);
					if(count($results)>0)
					{
						$html .= "<ul style='margin:0px;padding:0px 0px 0px 18px;'>";
							foreach($results as $row)
							{
								$html .= "<li>";
									$title = str_replace(" ","_",trim($row["title"]));
									$html .= "<a href='/content/$title.html' style=\"color:#BF3A17;\">{$row["title"]}</a>";
								$html .= "</li>";
							}
						$html .= "</ul>";
					}
				$html .= "</td>";
			$html .= "</tr>";
//			$html .= "<tr>";
//				$html .= "<td>";
//					$categorytitle = str_replace(" ","_",trim($category->getName()));
//					$html .= "<a href='/contentlist/category/$categorytitle.html' style=\"color:#BF3A17;font-size:9px; float:right;\">".Prado::localize("content.readmore")."</a>";
//				$html .= "</td>";
//			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
	
	/**
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getNewsList($this->categoryId,$this->categoryName,$this->noOfItems,$this->subTitle));
		parent::renderEndTag($writer);
	}
}

?>
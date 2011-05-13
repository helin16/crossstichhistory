<?php
 
/**
 * class DefaultLayout
 */
class DefaultLayout extends TTemplateControl
{
	public function onInit($param)
	{
	}
	
	public function onLoad()
	{
	}
	
	public function getCategory($categoryName,&$panel)
	{
		$service = new BaseService("ContentCategory");
		$cate = $service->findByCriteria("name ='$categoryName' and languageId=".Core::getPageLanguage()->getId());
		if(count($cate)==0)
			return;
		
		$cateId = $cate[0]->getId();
		$service1 = new BaseService("Content");
		$content = $service1->findByCriteria("id in (select distinct x.contentId from content_contentcategory x where x.contentcategoryId=$cateId)");
		$content=$content[0];
		
		if($content instanceof Content)
		{
			$panel->setTitle($content->getTitle());
			$panel->setSubTitle($content->getSubTitle());
		}
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
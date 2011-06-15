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
	
	public function getStoreLocation($space=" ")
	{
		return str_replace(" ",$space,"1445 Malvern Road, Glen Iris, Victoria 3146, Australia");
	}
	
	public function getPhone()
	{
		return "+61 3 9883 8888";
	}
	
	public function getFax()
	{
		return "+61 3 9883 8888";
	}
	
	public function getEmail()
	{
		return "<a href='/contactus.html'>Feel Free To Contact Us On Email</a>";
	}
	
	public function getFooterSeparator()
	{
		return str_repeat("&nbsp;",3)."|".str_repeat("&nbsp;",3);
	}
}
?>
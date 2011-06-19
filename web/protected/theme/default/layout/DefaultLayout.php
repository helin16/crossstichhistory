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
		$this->loadContactUsSide();
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
		return "+61 3 9822 8896";
	}
	
	public function getFax()
	{
		return "+61 3 9822 8896";
	}
	
	public function getEmail()
	{
		return "<a href='/contactus.html'>Feel Free To Contact Us On Email</a>";
	}
	
	public function getFooterSeparator()
	{
		return str_repeat("&nbsp;",3)."|".str_repeat("&nbsp;",3);
	}
	
	public function getGoogleMaps()
	{
		return '<iframe width=\"100%\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src="http://maps.google.com.au/maps?hl=en&amp;q='. $this->getStoreLocation('+'). '&amp;ie=UTF8&amp;hq=&amp;hnear='. $this->getStoreLocation('+'). '&amp;z=14&amp;ll=-37.853025,145.042632&amp;output=embed\"></iframe><br /><small><a href=\"http://maps.google.com.au/maps?hl=en&amp;q='. $this->getStoreLocation('+'). '&amp;ie=UTF8&amp;hq=&amp;hnear='. $this->getStoreLocation('+'). '&amp;z=14&amp;ll=-37.853025,145.042632&amp;source=embed\" style=\"color:#0000FF;text-align:left\">View Larger Map</a></small>';
	}
	
	public function getYear()
	{
		$today = new HydraDate();
		return $today->getYear();
	}
	
	public function loadContactUsSide()
	{
		$service = new BaseService("Content");
		$contents = $service->findByCriteria("title='Contact Us Side'");
		if(count($contents)==0)
			return;
		$this->contactUsSide->Text = $contents[0]->getText();
	}
}
?>
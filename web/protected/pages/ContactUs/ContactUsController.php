<?php
class ContactUsController extends EshopPage 
{
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="contactus";
	}
	
	public function onload()
	{
		if(!$this->IsPostBack)
		{
			$this->setTitle("Contact Us");
			$this->getConent();
		}
	}
	
	public function getConent()
	{
		$service = new BaseService("Content");
		$content= $service->findByCriteria("title ='Contact Us'");
		if(count($content)==0)
			return;
			
		$this->aboutus->setStyle("margin-bottom:50px;");
		$this->aboutus->setGroupingText($content[0]->getTitle());
		$this->aboutus->getControls()->add($content[0]->getText());
	}
}
?>
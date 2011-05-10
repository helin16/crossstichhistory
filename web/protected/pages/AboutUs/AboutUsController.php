<?php
class AboutUsController extends ContentLoaderController 
{
	public function __construct()
	{
		parent::__construct();
		$this->preloadTitle=Prado::localize("Menu.aboutus");
		$this->menuItemName="aboutus";
	}
}
?>
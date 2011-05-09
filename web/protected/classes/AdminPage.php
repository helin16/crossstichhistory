<?php
class AdminPage extends TPage 
{
	public $menuItemName;
	protected $blankLayout;
	protected $pageLanguage;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->pageLanguage = Core::getPageLanguage();
	}
	
	public function onPreInit($param)
	{
		parent::onPreInit($param);
		if($this->blankLayout)
			$this->getPage()->setMasterClass("Application.layouts.BlankLayout");
		else
			$this->getPage()->setMasterClass("Application.layouts.Admin.AdminLayout");
	}
	
	public function setInfoMessage($msg)
	{
		$this->getPage()->getMaster()->infoLabel->Text = $msg;
	}
	
	public function setErrorMessage($msg)
	{
		$this->getPage()->getMaster()->errorLabel->Text = $msg;
	}
}
?>
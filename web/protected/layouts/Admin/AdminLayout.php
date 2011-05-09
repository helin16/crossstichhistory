<?php
 
/**
 * class DefaultLayout
 */
class AdminLayout extends TTemplateControl
{
	
	public function onLoad()
	{
		$this->getUsername();
	}
	

	public function getUsername()
	{
		if(!Core::getUser() instanceof UserAccount)
			$this->Response->redirect("/login.html");
		$this->usernameBtn->Text = Core::getUser()->getUserName();
	}
	
	public function logout($sender,$param)
	{
		$auth = $this->Application->Modules['auth'];

		$auth->logout();
		
//		$userAccount = Core::getUser();
//		$userAccount->setIsOnline(0);
//		Dao::save($userAccount);
//		
//		Logging::LogUser(Core::getUser(), AuthAction::LOGOUT, AuthDomain::NORMAL);
		
	   	$this->Response->Redirect("/login.html");
	}
	
	public function getDefaultThemeName()
	{
		return Config::get("theme","name");
	}
	
	public function changeId($name)
	{
		$selectedItemName = "home";
		if(isset($this->Page->menuItemName)&& trim($this->Page->menuItemName)!="")
			$selectedItemName=trim(strtolower(str_replace(" ","",$this->Page->menuItemName)));
		return trim(strtolower(str_replace(" ","",$name)))==$selectedItemName ? " style='background:#BF3A17;'" : "";
	}
}
?>
<?php

Prado::using('System.Security.TAuthManager');

class AuthManager extends TAuthManager
{
	public function onAuthorize($param)
	{
		parent::onAuthorize($param);
		
		$u = Core::getUser();
		if ($u instanceof UserAccount)
		{
			$r = Core::getRole();
			$uaService = new EntityService('UserAccount');
			Core::setUser($uaService->get($u->getId()), $r);
			
			Session::initialize();
		}
	}
}

?>
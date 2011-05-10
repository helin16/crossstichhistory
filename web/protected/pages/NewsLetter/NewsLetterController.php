<?php
class NewsLetterController extends EshopPage 
{
	public $action;
	public $key;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->action = isset($this->Request['action']) ? strtolower(trim($this->Request['action'])) : null;
		$this->key = (isset($this->Request['key'])  && trim($this->Request['key'])!="") ? trim($this->Request['key']) : null;
	}
	
	public function onload()
	{
		if(!$this->IsPostBack)
		{
			$this->setTitle("News Letter");
			
			switch($this->action)
			{
				case "subscribe":
					{
						$this->subscriberPanel->setDefaultButton("subscribeBtn");
						$this->unsubscribeBtn->Visible=false;
						$this->description->Text="Subscribe our free news letters!";
						break;
					}
				case "unsubscribe":
					{
						if($this->key===null)
						{
							$this->subscriberPanel->setDefaultButton("unsubscribeBtn");
							$this->description->Text="Unsubscribe our free news letters!";
							$this->subscribeBtn->Visible=false;
						}
						else
						{
							$this->unsubscribeWithKey($this->key);
						}
						break;
					}
				default:
					{
						$this->subscriberPanel->Visible=false;
						$this->msgPanel->getControls()->add("<h2>Invalid Action!</h2>");
						break;
					}
			}
		}
	}
	
	public function subscribe($sender, $param)
	{
		$msg="";
		try
		{
			$email = trim($this->emailAddr->Text);
			$newsLetterService = new NewsLetterService();
			$newsLetterService->subscribe($email);
		}
		catch(Exception $e)
		{
			$msg=$e->getMessage();
		}
		
		$msg="You've successfully subscribed our free news letters!";
		$this->msgPanel->getControls()->add($msg);
		$this->subscriberPanel->Visible=false;
	}
	
	public function unsubscribe($sender, $param)
	{
		$msg="";
		try
		{
			$email = trim($this->emailAddr->Text);
			$newsLetterService = new NewsLetterService();
			$subscribers = $newsLetterService->findByCriteria("email like '$email'");
			foreach($subscribers as $subscriber)
			{
				$newsLetterService->unsubscribe($subscriber->getKey());
			}
		}
		catch(Exception $e)
		{
			$msg=$e->getMessage();
		}
		
		$msg="You've successfully unsubscribed our news letters!";
		$this->msgPanel->getControls()->add($msg);
		$this->subscriberPanel->Visible=false;
	}
	
	public function unsubscribeWithKey($key)
	{
		$msg="";
		try
		{
			$newsLetterService = new NewsLetterService();
			$newsLetterService->unsubscribe($key);
		}
		catch(Exception $e)
		{
			$msg=$e->getMessage();
		}
		
		$msg="You've successfully unsubscribed our news letters!";
		$this->msgPanel->getControls()->add($msg);
		$this->subscriberPanel->Visible=false;
	}
}
?>
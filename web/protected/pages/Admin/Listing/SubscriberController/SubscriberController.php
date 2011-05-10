<?php

class SubscriberController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="subscribers";
		$this->entityName="Subscriber";
	}
	
	/**
	 * onLoad method
	 *
	 * @param $param
	 */
    public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(!$this->IsPostBack || $param == "reload")
        {
        	$this->AddPanel->Visible = false;
			$this->DataList->EditItemIndex = -1;
			$this->dataLoad();    	
        }
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Subscriber");
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId()." and (email like '%$searchString%')",true,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
    protected function saveEntity(HydraEntity $entity)
    {
    	$msg="";
    	if($entity->getId()==null)
    		$msg="New Subscriber Created Successfully!";
    	else
    		$msg="Selected Subscriber Updated Successfully!";
    		
    	$service = new BaseService("Subscriber");
    	$service->save($entity);
    	
    	$this->setInfoMessage($msg);
    }
    
	protected function setEntity(&$object,$params,&$focusObject = null)
    {
    	$emailAddr = trim($params->emailAddr->Text);
    	$object->setEmail($emailAddr);
    	$object->setLanguage(Core::getPageLanguage());
    	if($object->getKey()=="")
    	{
	    	$now = new HydraDate();
	    	$object->setKey("$emailAddr $now");
    	}
    }
    
	protected function populateAdd()
    {
    	$this->emailAddr->Text="";
    }
    
	protected function populateEdit($editItem)
    {
    	$editItem->emailAddr->Text=$editItem->getData()->getEmail();
    }
}

?>

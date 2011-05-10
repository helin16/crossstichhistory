<?php

class ContactController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="contacts";
		$this->entityName="Person";
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
    
 	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	$service = new BaseService($this->entityName);
    	$result =  $service->findAll(false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Person");
    	$array = array("email","phone","mobile","fax","firstName","lastName","position","title","description");
    	$where = array();
    	foreach($array as $a)
    	{
    		$where [] = "$a like '%$searchString%'";
    	}
    	$result =  $service->findByCriteria(implode(" or ",$where)." or concat(firstName,' ',lastName) like '%$searchString%'",false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
    protected function saveEntity(HydraEntity $entity)
    {
    	$msg="";
    	if($entity->getId()==null)
    		$msg="New Contact Created Successfully!";
    	else
    		$msg="Selected Contact Updated Successfully!";
    		
    	$service = new BaseService("Person");
    	$service->save($entity);
    	
    	$this->setInfoMessage($msg);
    }
    
	protected function setEntity(&$object,$params,&$focusObject = null)
    {
    	$title=trim($params->title->Text);
    	$firstName=trim($params->firstName->Text);
    	$lastName=trim($params->lastName->Text);
    	$position=trim($params->position->Text);
    	$mobile=trim($params->mobile->Text);
    	$phone=trim($params->phone->Text);
    	$fax=trim($params->fax->Text);
    	$emailAddr=trim($params->emailAddr->Text);
    	$description=trim($params->description->Text);
    	$assetId=trim($params->personImage->ToolTip);
    	
    	$object->setTitle($title);
    	$object->setFirstName($firstName);
    	$object->setLastName($lastName);
    	$object->setPosition($position);
    	$object->setMobile($mobile);
    	$object->setPhone($phone);
    	$object->setFax($fax);
    	$object->setEmail($emailAddr);
    	$object->setDescription($description);
    	
    	$contentServer = new AssetServer();
    	$asset = $contentServer->getAsset($assetId);
    	if($asset instanceof Asset)
    		$object->setPersonalImage($asset);
    }
    
	protected function populateAdd()
    {
    	$this->title->Text="";
    	$this->firstName->Text="";
    	$this->lastName->Text="";
    	$this->position->Text="";
    	$this->mobile->Text="";
    	$this->phone->Text="";
    	$this->fax->Text="";
    	$this->emailAddr->Text="";
    	$this->description->Text="";
    	$this->personImage->ImageUrl="";
    	$this->personImage->ToolTip="";
    	
    	$this->title->focus();
    }
    
	protected function populateEdit($editItem)
    {
    	$person = $editItem->getData();
    	$editItem->title->Text=$person->getTitle();
    	$editItem->firstName->Text=$person->getFirstName();
    	$editItem->lastName->Text=$person->getLastName();
    	$editItem->position->Text=$person->getPosition();
    	$editItem->mobile->Text=$person->getMobile();
    	$editItem->phone->Text=$person->getPhone();
    	$editItem->fax->Text=$person->getFax();
    	$editItem->emailAddr->Text=$person->getEmail();
    	$editItem->description->Text=$person->getDescription();
    	
    	$asset = $person->getPersonalImage();
    	if($asset instanceof Asset)
    	{
    		$assetId = $asset->getAssetId();
    		$editItem->personImage->ToolTip=$assetId;
    		$editItem->personImage->ImageUrl = $this->getImageUrl($assetId);
    	}
    	
    	$editItem->title->focus();
    }
    
	public function fileUploaded($sender,$param)
     {
     	if($sender->HasFile)
        {
        	$param = $this;
        	if($this->AddPanel->Visible==false)
        		$param = $this->DataList->getEditItem();
        	
			$imageFile =fopen($sender->LocalName, "r");
			$imageStream = stream_get_contents($imageFile);
			
			$contentServer = new AssetServer();
			$assetId = $contentServer->registerAsset(AssetServer::TYPE_GRAPH, $sender->FileName, $imageStream);
			
			$param->personImage->ToolTip=$assetId;
    		$param->personImage->ImageUrl = $this->getImageUrl($assetId);
        }
     }
     
     public function getImageUrl($assetId,$height=120,$width=100)
     {
     	$dimension = array("height"=>$height,"width"=>$width);
     	return "/asset/$assetId/".serialize($dimension);
     }
     
     public function loadImage(Person $person)
     {
     	$asset = $person->getPersonalImage();
     	if($asset instanceof Asset)
     		return $this->getImageUrl($asset->getAssetId());
     	return;
     }
}

?>

<?php

class BannerController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="banners";
		$this->entityName="Banner";
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
    	$service = new BaseService("Banner");
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId()." and (description like '%$searchString%')",false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	$service = new BaseService($this->entityName);
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId(),false,$pageNumber,$pageSize);
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
    		
    	$service = new BaseService($this->entityName);
    	$service->save($entity);
    	
    	$this->setInfoMessage($msg);
    }
    
	protected function setEntity(&$object,$params,&$focusObject = null)
    {
    	$title = trim($params->title->Text);
    	$description = trim($params->description->Text);
    	$url = trim($params->url->Text);
    	
    	$object->setTitle($title);
    	$object->setDescription($description);
    	$object->setUrl($url);
    	$object->setLanguage(Core::getPageLanguage());
    	
    	$assetId = trim($this->bannerImage_assetId->Value);
    	$contentServer = new AssetServer();
    	$asset = $contentServer->getAsset($assetId);
    	$object->setAsset($asset);
    }
    
	protected function populateAdd()
    {
    	$this->title->Text="";
    	$this->description->Text="";
    	$this->url->Text="";
    	$this->bannerImage_assetId->Value="";
    }
    
	protected function populateEdit($editItem)
    {
    	$editItem->title->Text=$editItem->getData()->getTitle();
    	$this->bannerImage_assetId->Value = $editItem->getData()->getAsset()->getAssetId();
		$this->loadImage($editItem->bannerImage);
    }
    
	public function fileUploaded($sender,$param)
     {
     	if($sender->HasFile)
        {
			$imageFile =fopen($sender->LocalName, "r");
			$imageStream = stream_get_contents($imageFile);
			
			$contentServer = new AssetServer();
			$assetId = $contentServer->registerAsset(AssetServer::TYPE_GRAPH, $sender->FileName, $imageStream);
			
			$this->bannerImage_assetId->Value = $assetId;
			$this->loadImage($this->bannerImage);
        }
     }
     
  	public function loadImage(TImage &$tImage)
  	{
  		$assetId = trim($this->bannerImage_assetId->Value);
  		$tImage->setImageUrl("/asset/$assetId/".serialize(array()));
  	}
  	
  	public function getBannerImageUrl(Banner $banner)
  	{
  		$dimension = array("width"=>"200","height"=>120);
  		return "/asset/".$banner->getAsset()->getAssetId()."/".serialize($dimension);
  	}
}

?>

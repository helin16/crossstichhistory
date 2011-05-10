<?php

class CRUDPage extends AdminPage 
{
	protected $openFirst = false;
	protected $entityName;
	
	public $totalRows;
	
    protected function createNewEntity()
    {
    	return new $this->entityName;
    }

    protected function lookupEntity($id)
    {
    	$service = new BaseService($this->entityName);
    	return $service->get($id);
    }
    
    protected function getFocusEntity($id,$type="")
    {
    	return null;
    }
    
    protected function setEntity(&$object,$params,&$focusObject = null)
    {
    	
    }
    
    protected function saveEntity(&$object)
    {
    	$msg="";
    	if($object->getId()==null)
    		$msg="New ".$this->entityName." Created Successfully!";
    	else
    		$msg="Selected ".$this->entityName." Updated Successfully!";
    		
    	$service = new BaseService($this->entityName);
    	$service->save($object);
    	
    	$this->setInfoMessage($msg);
    }
    
    protected function resetFields($params)
    {
    	
    }
    
    protected function populateAdd()
    {
    	
    }
    
    protected function populateEdit($editItem)
    {
    	
    }
    
    protected function howBigWasThatQuery()
    {
    	return Dao::getTotalRows();
    }
    
    protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	$service = new BaseService($this->entityName);
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId(),$searchActiveOnly,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
    protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	return null;
    }
    
	public function __construct()
	{
		parent::__construct();
	}

	public function onLoad($param)
    {
       	parent::onLoad($param);
       	
        $this->setInfoMessage("");
        $this->setErrorMessage("");        
		$this->PaginationPanel->Visible = false;
		    
		if(isset($this->Request['id']))
		{
			$this->focusObject->Value = $this->Request['id'];
		}
		if(isset($this->Request['searchby']))
		{
			$this->focusObjectArgument->Value = $this->Request['searchby'];
		}
		
		$argument = $this->focusObjectArgument->Value;
		$entity = $this->getFocusEntity($this->focusObject->Value,$argument);
		
		try
		{
			if($this->focusOnSearch)
				$this->SearchText->focus();
		}
		catch (Exception $e)
		{
		
		}
    }
    
    public function add($sender, $param)
    {
    	$this->AddPanel->Visible = true;
    	$this->DataList->EditItemIndex = -1;
    	$this->dataLoad();

       	if($this->AddPanel->Visible == true)
    	{
    		$params = $this;
    	}
    	else
    	{
    		$params = $param->Item;
    	}
    	    	
    	$this->resetFields($params);
    	$this->populateAdd();
    }
    
    public function edit($sender,$param)
    {
	    if($param != null)
			$itemIndex = $param->Item->ItemIndex;
		else
			$itemIndex = 0;

		$this->AddPanel->Visible = false;
		$this->DataList->SelectedItemIndex = -1;
		$this->DataList->EditItemIndex = $itemIndex;
		$this->dataLoad();
				
		$this->populateEdit($this->DataList->getEditItem());
    }
    
    protected function toPerformSearch()
    {
    	return $this->SearchString->Value != "";
    }
    
    public function dataLoad($pageNumber=null,$pageSize=null)
    {
    	if($pageNumber == null)
    		$pageNumber = $this->DataList->CurrentPageIndex + 1;
    	
    	if($pageSize == null)
    		$pageSize = $this->DataList->pageSize;   	
    	
       	$focusObject = $this->focusObject->Value;
       	$focusObjectArgument = $this->focusObjectArgument->Value;
     	if($focusObject == "")
     		$focusObject = null;
     	else
     		$focusObject = $this->getFocusEntity($focusObject,$focusObjectArgument);

     	if(!$this->toPerformSearch())
     		$data = $this->getAllOfEntity($focusObject,$pageNumber,$pageSize);    
     	else
     		$data = $this->searchEntity($this->SearchString->Value,$focusObject,$pageNumber,$pageSize);

     	$size = sizeof($data);
     	$this->DataList->DataSource = $data; 
    	$totalSize = $this->howBigWasThatQuery();
     	$this->DataList->VirtualItemCount = $totalSize;
     	
     	if($this->openFirst && $size == 1)
     	{
			$this->DataList->EditItemIndex = 0;
     	}
     	
     	$this->DataList->dataBind();

        if($this->openFirst && $size == 1)
     	{
			$this->populateEdit($this->DataList->getEditItem());
     	}     	
     	
    	if($this->DataList->getPageCount() > 1)
	    	$this->PaginationPanel->Visible = true;	  	 
     	
     	$this->postDataLoad();
     	return $data;
    }        
    
    protected function postDataLoad()
    {
    	
    }
    
    public function save($sender,$param)
    {
    	if($this->AddPanel->Visible == true)
    	{
    		$entity = $this->createNewEntity();
    		$params = $this;
    	}
    	else
    	{
    		$params = $param->Item;
			$entity = $this->lookupEntity($this->DataList->DataKeys[$params->ItemIndex]);
    	}

    	
       	$focusObject = $this->focusObject->Value;
       	$focusObjectArgument = $this->focusObjectArgument->Value;
     	if($focusObject == "")
     		$focusObject = null;
     	else
     		$focusObject = $this->getFocusEntity($focusObject,$focusObjectArgument);    	

    	$this->setEntity($entity,$params,$focusObject);
    	$this->saveEntity($entity);
    	
    	$this->resetFields($params);
    	
        if($this->AddPanel->Visible == true)
	        $this->AddPanel->Visible = false;
    	else
	        $this->DataList->EditItemIndex = -1;

		$this->dataLoad();
    }    
    
    public function cancel($sender,$param)
    {
		$this->AddPanel->Visible = false;
		$this->DataList->EditItemIndex = -1;
		$this->dataLoad();    	
    }
    
    public function search($sender,$param)
    {
     	$searchQueryString = $this->SearchText->Text;
		$this->SearchString->Value = $searchQueryString;
     	
		$this->DataList->EditItemIndex = -1;
		$this->dataLoad();
    }    

    public function pageChanged($sender, $param)
    {   	
    	$this->AddPanel->Visible = false;
    	$this->DataList->EditItemIndex = -1;
      	$this->DataList->CurrentPageIndex = $param->NewPageIndex;
      	$this->dataLoad();
    }

     
    protected function entitiesToArray(array $entities)
    {
		$selected = array();
		foreach($entities as $entity)
			$selected[] = $entity->getId();

		return $selected;
    }

    // I AM A WINNER !!!!
    protected function saveManyToMany(&$object,$controlIds,$entityArray,$add,$remove,$service,$get)
    {
    	
	    foreach($entityArray as $entity)
		{
			
			$result = array_search($entity->getId(),$controlIds);	
			if($result === false)
			{
				$object->$remove($entity);
			} else {
				unset($controlIds[$result]);
			}
		}
		
		foreach($controlIds as $controlId)
		{
			$temp = $service->$get($controlId);
			$object->$add($temp);
		}
    }
    
    /**
     * Toggle the Active flag in DataList
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	protected function toggleActive($sender,$param)
	{
		$entity = $this->lookupEntity($sender->Parent->Parent->DataKeys[$sender->Parent->ItemIndex]);
    	$entity->setActive($sender->Parent->Active->Checked);
		$this->saveEntity($entity);
		
		$this->dataLoad();
	}
	
	/**
	 * Bind data to a DropDownList
	 *
	 * @param TDropDownList $listToBind
	 * @param array[] HydraEntity $dataSource
	 * @param HydraEntity $selectedItem
	 * @param bool $enable
	 */
	protected function bindDropDownList(&$listToBind, $dataSource, $selectedItem = null, $enable = true)
	{
		$listToBind->DataSource = $dataSource; 
        $listToBind->dataBind(); 
        
        if($selectedItem!=null)
        {
        	$listToBind->setSelectedValue($selectedItem->getId());
        }
        $listToBind->Enabled=$enable;
	}

    public function getStyle($index)
    {
    	if($index % 2 == 0)
    		return 'DataListItem';
    	else
    		return 'DataListAlterItem';
    }
}

?>
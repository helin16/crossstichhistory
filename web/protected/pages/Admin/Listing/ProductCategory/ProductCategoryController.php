<?php

class ProductCategoryController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="productcategory";
		$this->entityName="ProductCategory";
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
    	$service = new BaseService($this->entityName);
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId()." and (name like '%$searchString%')",true,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function setEntity(&$object,$params,&$focusObject = null)
    {
    	$name = trim($params->name->Text);
    	$object->setName($name);
    	$object->setLanguage(Core::getPageLanguage());
    }
    
	protected function populateAdd()
    {
    	$this->name->Text="";
    }
    
	protected function populateEdit($editItem)
    {
    	$editItem->name->Text=$editItem->getData()->getName();
    }
}

?>

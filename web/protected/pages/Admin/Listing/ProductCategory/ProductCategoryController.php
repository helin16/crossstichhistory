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
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	$service = new BaseService($this->entityName);
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId(),$searchActiveOnly,$pageNumber,$pageSize,array("ProductCategory.rootId"=>"asc","ProductCategory.position"=>"asc"));
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
    	$category = $editItem->getData();
    	$service = new BaseService("ProductCategory");
    	$editItem->name->Text=$editItem->getData()->getName();
    	$editItem->parentCategoryList->DataSource = $service->findByCriteria("id not in(select x.id from productcategory x where x.active =1 and x.position like '".$category->getPosition()."%' and x.rootId='".$category->getRoot()->getId()."')",true,null,null,array("ProductCategory.rootId"=>"asc","ProductCategory.position"=>"asc"));
    	$editItem->parentCategoryList->DataBind();
    	
    	$editItem->name->focus();
    }
    
    public function getLevel(ProductCategory $category)
    {
    	return (strlen($category->getPosition())-1) / ProductCategory::POSITION_LEVEL_DIGITS; 
    }
    
    public function moveCategory($sender,$param)
    {
    	$id = trim($param->CommandParameter);
    	$service = new BaseService("ProductCategory");
    	$category = $service->get($id);
    	if(!$category instanceof ProductCategory)
    		return;
    		
    	$parentCategoryId = trim($this->DataList->getEditItem()->parentCategoryList->getSelectedValue());
    	$parentCategory = $service->get($parentCategoryId);
    	if(!$parentCategory instanceof ProductCategory)
    		return;
    		
    	$category->moveToSubCategory($parentCategory);
    	$this->setInfoMessage("Successfully moved to '$parentCategory'");
    	
    	$this->AddPanel->Visible = false;
		$this->DataList->EditItemIndex = -1;
    	$this->dataLoad();
    }
}

?>

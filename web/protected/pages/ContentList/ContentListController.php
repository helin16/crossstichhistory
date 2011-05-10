<?php
class ContentListController extends EshopPage  
{
	public $totalRows;
	public $categoryId;
	
	public function __construct()
	{
		parent::__construct();
		$this->totalRows=0;
		
		$service = new BaseService("ContentCategory");
		$title = isset($this->Request["categorytitle"])? $this->Request["categorytitle"] : "";
		$title = strtoupper(str_replace(" ","_",trim($title)));
		$categories = $service->findByCriteria("ucase(replace(trim(`name`),' ','_')) = '$title'");
		$this->categoryId = count($categories)>0 ? $categories[0]->getId() : 0; 
	}
	
	public function onLoad($param)
    {
        parent::onLoad($param);
        
        if(!$this->IsPostBack || $param == "reload")
        {
        	if($this->categoryId==0)
        	{
        		$this->getMaster()->errorMsg->Text ="Page Not Found ".(isset($this->Request["categorytitle"])? "For '".$this->Request["categorytitle"]."' " : "")."!";
        	}
        	$this->PaginationPanel->Visible = false;
			$this->dataLoad();    	
        }
    }
    
    public function dataLoad($pageNumber=null,$pageSize=null)
    {
    	if($pageNumber == null)
    		$pageNumber = $this->DataList->CurrentPageIndex + 1;
    	
    	if($pageSize == null)
    		$pageSize = $this->DataList->pageSize;   	
    	
     	if(!$this->toPerformSearch())
     		$data = $this->getAllOfEntity($focusObject,$pageNumber,$pageSize);    
     	else
     		$data = $this->searchEntity($this->SearchString->Value,$focusObject,$pageNumber,$pageSize);

     	$this->DataList->DataSource = $data; 
    	$totalSize = $this->totalRows;
     	$this->DataList->VirtualItemCount = $totalSize;
     	
     	$this->DataList->dataBind();

    	if($this->DataList->getPageCount() > 1)
	    	$this->PaginationPanel->Visible = true;	  	
	    	 
     	return $data;
    }  
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Content");
    	$result =  $service->findByCriteria("id in (select x.contentId from content_contentcategory x where x.contentcategoryId=".$this->categoryId.") and languageId=".Core::getPageLanguage()->getId(),true,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function toPerformSearch()
    {
    	return false;
    }
    
    public function getUrl($title)
    {
    	return str_replace(" ","_",strtolower(trim($title)));
    }
}
?>
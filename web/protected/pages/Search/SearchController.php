<?php
class SearchController extends EshopPage
{
	public $totalRows;
	public function onLoad()
	{
        if(!$this->IsPostBack || $param == "reload")
        {
        	$this->SearchString->Value=trim($this->Request["searchcontent"]);
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
	
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null,$searchActiveOnly=true)
    {
    	if(!isset($this->Request["searchcontent"]) || trim($this->Request["searchcontent"])=="")
			return;
			
		$searchContent = trim($this->Request["searchcontent"]);
    	$service = new BaseService("Product");
    	$where = "languageId=".Core::getPageLanguage()->getId();
    		$where .=" and (title like '%$searchContent%' or description like '%$searchContent%' or sku like '%$searchContent%')";
    	$result =  $service->findByCriteria($where,$searchActiveOnly,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function toPerformSearch()
    {
    	return false;
    }
}
?>
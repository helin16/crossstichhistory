<?php

class ContentController extends CRUDPage
{
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="contents";
		$this->entityName="Content";
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
	        $this->dataLoad();
        }
    }
    
 	protected function getFocusEntity($id,$type="")
    {
    	$service = new BaseService("ContentCategory");
    	return $service->get($id);
    }
    
	protected function searchEntity($searchString,&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	$service = new BaseService("Content");
    	$result =  $service->findByCriteria("languageId=".$this->pageLanguage->getId()." and (con.title like '%$searchString%' or con.intro like '%$searchString%' or con.fullText like '%$searchString%')",false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
	protected function getAllOfEntity(&$focusObject = null,$pageNumber=null,$pageSize=null)
    {
    	if(!$focusObject instanceof ContentCategory)
    		return parent::getAllOfEntity($focusObject,$pageNumber,$pageSize,false);
    	
    	$sql = "select distinct con.id
    			from content_contentcategory x
    			inner join content con on (x.contentId=con.id)
    			where x.contentcategoryId = ".$focusObject->getId();
    	$service = new BaseService($this->entityName);
    	$result =  $service->findByCriteria("id in ($sql ) and languageId=".$this->pageLanguage->getId(),false,$pageNumber,$pageSize);
    	$this->totalRows = $service->totalNoOfRows;
    	return $result;
    }
    
    public function shortenText($text,$maxLength=150)
    {
    	$text = strip_tags($text);
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
    public function getCategoryList(Content $content)
    {
    	$sql ="select distinct ca.name
    			from content_contentcategory x
    			inner join contentcategory ca on (x.contentcategoryId=ca.id and ca.active = 1)
    			where x.contentId =".$content->getId();
    	$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
    	if(count($result)==0)
    		return;
    	$html ="<ul style='list-style:disc;margin-left:20px;padding:0px;'>";
    		foreach($result as $row)
    		{
    			$html .="<li>{$row["name"]}</li>";
    		}
    	$html .="</ul>";
    	return $html;
    }
}

?>

<?php

class ContentController extends AdminPage 
{
	public $id;
	
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->blankLayout=true;
		
		$this->id = (isset($this->Request["id"]) && is_numeric(trim($this->Request["id"])) && trim($this->Request["id"])>0) ? trim($this->Request["id"]) : null;
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
        	$this->bindCategoy();
        	if($this->id!==null)
        		$this->loadContent($this->id);
        }
    }
    
    public function loadContent($id)
    {
    	$service = new BaseService("Content");
    	$content = $service->get($id);
    	
    	$this->title->Text = $content->getTitle();
    	$this->description->Text = $content->getText();
    	$this->subTitle->Text = $content->getSubTitle();
    	
    	$sql ="select distinct ca.id
    			from content_contentcategory x
    			inner join contentcategory ca on (x.contentcategoryId=ca.id and ca.active = 1)
    			where x.contentId =".$content->getId();
    	$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
    	$caIds = array();
    	foreach($result as $row)
    	{$caIds[] = $row["id"];}
    	
    	if(count($caIds)>0)
    		$this->categoryList->setSelectedValues($caIds);
    }
    
    public function save($sender,$param)
    {
    	$this->setInfoMessage("");
    	$service = new BaseService("Content");
    	
    	$msg="";
    	//editing an exsiting content
    	if($this->id!==null)
    	{
    		$content = $service->get($this->id);
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setText(trim($this->description->Text));
    		$content->setSubTitle(trim($this->subTitle->Text));
    		$service->save($content);
    		
    		$msg="Content Updated Successfully!";
    	}
    	else
    	{
    		$content = new Content();
    		
    		$content->setTitle(trim($this->title->Text));
    		$content->setText(trim($this->description->Text));
    		$content->setSubTitle(trim($this->subTitle->Text));
    		$content->setLanguage(Core::getPageLanguage());
    		$service->save($content);
    		
    		$msg="Content Created Successfully!";
    	}
    	
    	//deleting all exsiting relationships
    	$sql = "delete from content_contentcategory where contentId=".$content->getId();
    	Dao::execSql($sql);
    	
    	$catIds = $this->categoryList->getSelectedValues();
    	foreach($catIds as $id)
    	{
    		$sql = "insert into content_contentcategory(`contentId`,`contentcategoryId`) values ('".$content->getId()."','$id')";
    		Dao::execSql($sql);
    	}
    	
    	$this->setInfoMessage($msg);
    }
    
    public function bindCategoy()
    {
    	$service = new BaseService("ContentCategory");
    	$result = $service->findByCriteria("languageId=".$this->pageLanguage->getId());
    	$this->categoryList->DataSource = $result;
    	$this->categoryList->DataBind();
    }
}

?>

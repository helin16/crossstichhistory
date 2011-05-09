<?php

class ProjectImagesControl extends TTemplateControl  
{
	public $projectId;
	
	public function onLoad($param)
	{
		if(!$this->Page->IsPostBack)
		{
			$this->loadImages($this->projectId);
		}
	}
	
	/**
	 * getter projectId
	 *
	 * @return projectId
	 */
	public function getProjectId()
	{
		return $this->projectId;
	}
	
	/**
	 * setter projectId
	 *
	 * @var projectId
	 */
	public function setProjectId($projectId)
	{
		$this->projectId = $projectId;
	}
	
	public function loadImages($projectId)
	{
		$service = new BaseService("Project");
		$project = $service->get($projectId);
		if(!$project instanceof Project)
			return;
			
		$sql ="select distinct ass.assetId
				from asset ass
				inner join projectimage pi on (pi.active = 1 and pi.assetId = ass.id and pi.projectId=$projectId)
				where ass.active = 1";
		$results = Dao::getResultsNative($sql);
		if(count($results)==0)
			return;
		
		$newDimension = array(
    						"height"=>80,
    						"width"=>80
    					);
		$html="";
		foreach($results as $row)
		{
			$html .="<a href='/asset/{$row[0]}/".serialize(array())."' rel=\"lightbox\">
						<img src='/asset/{$row[0]}/".serialize($newDimension)."' style='border:1px #cccccc solid;padding:5px;'/>
					</a>";
		}
		$this->projectImages->getControls()->add($html);
	}
}

?>
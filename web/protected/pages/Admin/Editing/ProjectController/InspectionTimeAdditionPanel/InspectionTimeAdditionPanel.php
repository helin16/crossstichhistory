<?php

class InspectionTimeAdditionPanel extends TTemplateControl
{
	public $groupingText;
	public $projectId="";
	
	public function onLoad($param)
	{
		if(!$this->Page->IsPostBack || $param == "reload")
		{
			if(trim($this->projectId)!="")
				$this->loadInspectTimes($this->projectId);
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
	
	
	/**
	 * getter groupingText
	 *
	 * @return groupingText
	 */
	public function getGroupingText()
	{
		return $this->groupingText;
	}
	
	/**
	 * setter groupingText
	 *
	 * @var groupingText
	 */
	public function setGroupingText($groupingText)
	{
		$this->groupingText = $groupingText;
	}
	
	public function addTime($sender, $param)
	{
		$time=trim($this->newTime->Text);
		if($time=="")
			return;
			
		try
		{
			$date = new HydraDate($time);
			
			$item = new TListItem($date->getDateTime()->format('( D ) j/ M/ Y g:i:s a'),$date->getDateTime()->format('Y-m-d H:i:s'));
			$this->inspectTimes->Items->add($item);
			
			$this->newTime->Text="";
		}
		catch (Exception $e)
		{
			return;
		}
		
	}
	
	public function removeTime($sender, $param)
	{
		$item = $this->inspectTimes->getSelectedItem();
		$this->inspectTimes->Items->remove($item);
	}
	
	public function loadInspectTimes($projectId)
	{
		$sql="select distinct time from propertyinspectiontime where active = 1 and projectId=$projectId order by time";
		$array = array();
		foreach(Dao::getResultsNative($sql) as $row)
		{
			try{
				$time = trim($row[0]);
				$date = new HydraDate($time);
				$array[] = array($time,$date->getDateTime()->format('( D ) j/ M/ Y g:i:s a'));
			}
			catch(Exceptoin $ex)
			{continue;}
		}
		$this->inspectTimes->DataSource = $array;
		$this->inspectTimes->DataBind();
	}
}

?>
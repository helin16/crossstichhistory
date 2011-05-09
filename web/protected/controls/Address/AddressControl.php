<?php

class AddressControl extends TTemplateControl  
{
	public $validationGroup;
	public $groupingText;
	
	public function onLoad($param)
	{
		if(!$this->Page->IsPostBack || $param == "reload")
		{
			$service = new BaseService("State");
	        $this->stateList->DataSource = $service->findAll();
	        $this->stateList->DataBind();
	        $this->bindSuburb($this->suburb);
		}
	}
	
	public function bindSuburb(&$list)
	{
		$sql="select distinct ucase(suburb) `suburb` from address where active = 1 order by suburb";
		$list->DataSource =Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
		$list->DataBind();
	}
	
	/**
	 * getter validationGroup
	 *
	 * @return validationGroup
	 */
	public function getValidationGroup()
	{
		return $this->validationGroup;
	}
	
	/**
	 * setter validationGroup
	 *
	 * @var validationGroup
	 */
	public function setValidationGroup($validationGroup)
	{
		$this->validationGroup = $validationGroup;
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
	
}

?>
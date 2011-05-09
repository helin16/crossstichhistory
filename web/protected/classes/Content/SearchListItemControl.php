<?php

class SearchListItemControl extends TPanel  
{
	public $entityId;
	public $entityName;
	public $maxIntroLength=350;
	public $searchText;
	
	/**
	 * getter entityId
	 *
	 * @return entityId
	 */
	public function getEntityId()
	{
		return $this->entityId;
	}
	
	/**
	 * setter entityId
	 *
	 * @var entityId
	 */
	public function setEntityId($entityId)
	{
		$this->entityId = $entityId;
	}
	
	
	/**
	 * getter entityName
	 *
	 * @return entityName
	 */
	public function getEntityName()
	{
		return $this->entityName;
	}
	
	/**
	 * setter entityName
	 *
	 * @var entityName
	 */
	public function setEntityName($entityName)
	{
		$this->entityName = $entityName;
	}
	
	
	/**
	 * getter maxIntroLength
	 *
	 * @return maxIntroLength
	 */
	public function getMaxIntroLength()
	{
		return $this->maxIntroLength;
	}
	
	/**
	 * setter maxIntroLength
	 *
	 * @var maxIntroLength
	 */
	public function setMaxIntroLength($maxIntroLength)
	{
		$this->maxIntroLength = $maxIntroLength;
	}
	
	/**
	 * getter searchText
	 *
	 * @return searchText
	 */
	public function getSearchText()
	{
		return $this->searchText;
	}
	
	/**
	 * setter searchText
	 *
	 * @var searchText
	 */
	public function setSearchText($searchText)
	{
		$this->searchText = $searchText;
	}
	
	
	/**
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getListItem($this->entityId,$this->entityName,$this->searchText,$this->maxIntroLength));
		parent::renderEndTag($writer);
	}
	
	public function getListItem($id,$entityName,$searchText,$maxIntroLength=PHP_INT_MAX)
	{
		$entityName = trim($entityName);
		if(trim($entityName)=="")
			return "";
			
		try
		{$service = new BaseService($entityName);}
		catch(Exception $ex){return "";}
		$entity = $service->get($id);
		if(!$entity instanceof $entityName)
			return "";
			
		$maxIntroLength = $this->maxIntroLength;
		$html="<table width='100%'>";
			$html.="<tr>";
				$html.="<td align='left'>";
					$title = $entity->getTitle();
					$html .="<a href='/".strtolower($entityName)."/".str_replace(" ","_",trim($title)).".html' style='font-size:16px;font-weight:bold;text-decoration:none;color:#BF3A17'>$title</a>";
				$html.="</td>";
				$html.="<td align='right' style='font-size:14px;font-weight:bold;width:15%;'>";
					$html .=$entityName;
				$html.="</td>";
			$html.="</tr>";
			$html.="<tr>";
				$html.="<td colspan='2' style='padding:5px;text-align:justify;'>";
					$text = ($entity instanceof Project)? $entity->getDescription() : $entity->getText();
					$text =(strlen($text)>$maxIntroLength ? substr($text,0,$maxIntroLength)." ... " : $text);
					$html .=str_replace($searchText,"<font style='font-weight:bold;background:#BF3A17;color:white;'>$searchText</font>",$text);
				$html.="</td>";
			$html.="</tr>";
			$html.="<tr>";
				$html.="<td>&nbsp;</td>";
				$html.="<td align='right'>";
					$html .= "<a href='/".strtolower($entityName)."/".str_replace(" ","_",trim($title)).".html' style='background:#BF3A17;color:#ffffff;font-size:10px;padding:2px;text-decoration:none;'>".Prado::localize("content.readmore")."</a>";
				$html.="</td>";
			$html.="</tr>";
		$html.="</table>";
		return $html;
	}
}

?>
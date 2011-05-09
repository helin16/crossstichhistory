<?php

class ProjectListItemControl extends TPanel  
{
	public $projectId;
	public $maxIntroLength=350;
	
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
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getprojectListItem($this->projectId,$this->maxIntroLength));
		parent::renderEndTag($writer);
	}
	
	public function getprojectListItem($projectId,$maxIntroLength=PHP_INT_MAX)
	{
		$service = new BaseService("Project");
		$project = $service->get($projectId);
		if(!$project instanceof Project)
			return;
			
		$maxIntroLength = $this->maxIntroLength;
		
		$title = $project->getTitle();
		$html="<fieldset>";
			$html.="<legend>$title</legend>";
			$html.="<table width=\"100%\">";
				$html .="<tr>";
					$html .="<td style=\"width:310px;\">";
						$html .="<a href=\"/project/".$this->getUrl($title).".html\">";
							$defaultImageUrl = trim($this->getDefaultImage($project));
							$html .= $defaultImageUrl=="" ? "" : "<image class=\"projectListItem_image\" src='$defaultImageUrl' style=\"padding:0;margin:0;border:none;\"/>";
						$html .="</a>";
					$html .="</td>";
					$html .="<td style=\"font-size:11px; font-weight:bold;\" valign=\"top\">";
						$html .="<table width=\"100%\">";
							$html .="<tr>";
								$html .="<td>";
									$html .="<table width=\"100%\">";
										$html .="<tr>";
											$html .="<td>";
												$html .=$project->getAddress();
											$html .="</td>";
											$html .="<td align=\"right\">";
												$html .="<image src=\"/image/project/beds.png\" align=\"baseline\"/> ";
												$html .=$project->getNoOfBeds();
												$html .="&nbsp;&nbsp;&nbsp;&nbsp;";
												
												$html .="<image src=\"/image/project/baths.png\" align=\"baseline\"/> ";
												$html .=$project->getNoOfBaths();
												$html .="&nbsp;&nbsp;&nbsp;&nbsp;";
												
												$html .="<image src=\"/image/project/parking_spaces.png\" align=\"baseline\"/> ";
												$html .=$project->getNoOfCars();
												$html .="&nbsp;&nbsp;&nbsp;&nbsp;";
											$html .="</td>";
										$html .="</tr>";
									$html .="</table>";
								$html .="</td>";
							$html .="</tr>";
							$html .="<tr>";
								$html .="<td style=\"font-weight:normal;padding: 0 15px 0 15px;text-align:justify;\">";
									$html .=trim($this->shortenText($project->getDescription(),$this->maxIntroLength));
								$html .="</td>";
							$html .="</tr>";
							$html .="<tr>";
								$html .="<td align=\"right\" style=\"padding-right:15px;\">";
									$html .="<a style=\"background:transparent url('/image/project/details.png') no-repeat right -90px; display:block; float:right; height:23px;margin:8px 0 0 2px;text-decoration:none !important;width:auto;\" 
										href=\"/project/".$this->getUrl($title).".html\">";
										$html .="<span style=\"background:transparent url('/image/project/details.png') no-repeat left -60px;color:#ffffff;display:block;font-size:12px;font-weight:bold;margin-right:3px;padding:5px 1px 5px 5px;white-space:nowrap;\">";
											$html .="&nbsp;&nbsp;&nbsp;&nbsp;";
												$html .=prado::localize("Project.viewDetailsBtn");
											$html .="&nbsp;&nbsp;&nbsp;&nbsp;";
										$html .="</span>";
									$html .="</a>";
								$html .="</td>";
							$html .="</tr>";
						$html .="</table>";
					$html .="</td>";
				$html .="</tr>";
			$html .="</table>";
		$html.="</fieldset>";
		return $html;
	}
	
	public function getDefaultImage(Project $project)
    {
    	$newDimension = array(
    						"height"=>164,
    						"width"=>295
    					);
    	$image =$project->getDefaultImage();
    	if(!$image instanceof ProjectImage)
    		return "";
    		
    	$showingAsset = $image->getAsset();
    	if(!$showingAsset instanceof Asset)
    		return "";
    	$showingAssetId = $showingAsset->getAssetId();
    	return "/asset/$showingAssetId/".serialize($newDimension);
    }
    
	public function shortenText($text,$maxLength=150)
    {
    	if(strlen($text)>$maxLength)
    		return substr($text,0,$maxLength)." ... ";
    	return $text;
    }
    
 	public function getUrl($title)
    {
    	return str_replace(" ","_",strtolower(trim($title)));
    }
}

?>
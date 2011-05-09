<?php

class StaffProfileControl extends TPanel  
{
	public $personId="";	
	
	/**
	 * getter personId
	 *
	 * @return personId
	 */
	public function getPersonId()
	{
		return $this->personId;
	}
	
	/**
	 * setter personId
	 *
	 * @var personId
	 */
	public function setPersonId($personId)
	{
		$this->personId = $personId;
	}
	
	
	public function getProfileSnapshot($personId)
	{
		$service = new BaseService("Person");
		$person = $service->get($personId);
		if(!$person instanceof Person)
			return;
		
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" style=\"width: 280px; padding: 0px; margin: 10px; height: 110px;color:#ffffff;\">";
			$html .= "<tr>";
				$html .= "<td style=\"width: 6px; background: url('/Theme/default/images/newsletter_left.png') no-repeat scroll right top transparent;\">&nbsp;</td>";
				$html .= "<td style=\"background: url('/Theme/default/images/newsletter_mid.png') repeat-x scroll left top transparent; padding: 5px;width:90px\">";
					$asset = $person->getPersonalImage();
					if($asset instanceof Asset)
						$html .= "<a href='/staffprofiles/$personId.html' style='color:#ffffff;'><img src='/asset/".$asset->getAssetId()."/".serialize(array("height"=>90,"width"=>80))."' style='border:none;outline:none;'/></a>";
					else
						$html .= "&nbsp;";
				$html .= "</td>";
				$html .= "<td valign='top' style=\"padding-top: 8px;background: url('/Theme/default/images/newsletter_mid.png') repeat-x scroll left top transparent;\">";
					$html .= "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
						$html .= "<tr>";
							$html .= "<td style='font-weight:bold;'>";
								$html .= $person->getFullName();
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr style='color:#F8931D;font-weight:bold;'>";
							$html .= "<td>";
								$html .= $person->getPosition()."&nbsp;";
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td   style='color:#ffffff;font-size:11px;'>";
								$html .= "Mobile:".$person->getMobile();
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td  style='color:#ffffff;font-size:11px;'>";
								$html .= "Email: <a href='mailto:".$person->getEmail()."'   style='color:#ffffff;'>".$person->getEmail()."</a>";
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td align='right' style='padding-top:12px;'>";
								$html .= "<a href='/staffprofiles/$personId.html'  style='color:#ffffff;font-size:11px;'>".Prado::localize("content.readmore")."</a>";
							$html .= "</td>";
						$html .= "</tr>";
					$html .= "</table>";
				$html .= "</td>";
				$html .= "<td style=\"width: 6px; background: url('/Theme/default/images/newsletter_right.png') no-repeat scroll right top transparent;\">&nbsp;</td>";
			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
	
	/**
	 * Renders the closing tag for the control
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	public function renderEndTag($writer)
	{
		$writer->write($this->getProfileSnapshot($this->personId));
		parent::renderEndTag($writer);
	}
}

?>
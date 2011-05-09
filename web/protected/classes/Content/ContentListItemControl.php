<?php

class ContentListItemControl extends TPanel  
{
	public $contentId;
	public $maxIntroLength=350;
	
	/**
	 * getter contentId
	 *
	 * @return contentId
	 */
	public function getContentId()
	{
		return $this->contentId;
	}
	
	/**
	 * setter contentId
	 *
	 * @var contentId
	 */
	public function setContentId($contentId)
	{
		$this->contentId = $contentId;
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
		$writer->write($this->getContentListItem($this->contentId,$this->maxIntroLength));
		parent::renderEndTag($writer);
	}
	
	public function getContentListItem($contentId,$maxIntroLength=PHP_INT_MAX)
	{
		$service = new BaseService("Content");
		$content = $service->get($contentId);
		if(!$content instanceof Content)
			return;
			
		$maxIntroLength = $this->maxIntroLength;
		$html="<table width='100%'>";
			$html.="<tr>";
				$html.="<td align='left'>";
					$title = $content->getTitle();
					$html .="<a href='/content/".str_replace(" ","_",trim($title)).".html' style='font-size:16px;font-weight:bold;text-decoration:none;color:#BF3A17'>$title</a>";
				$html.="</td>";
				$html.="<td align='right' style='font-size:9px;width:15%;'>";
					$html .=$content->getCreated();
				$html.="</td>";
			$html.="</tr>";
			$html.="<tr>";
				$html.="<td colspan='2' style='padding:5px;text-align:justify;'>";
					$text = $content->getText();
					$html .=(strlen($text)>$maxIntroLength ? substr($text,0,$maxIntroLength)." ... " : $text);
				$html.="</td>";
			$html.="</tr>";
			$html.="<tr>";
				$html.="<td>&nbsp;</td>";
				$html.="<td align='right'>";
					$html .= "<a href='/content/".str_replace(" ","_",trim($title)).".html' style='background:#BF3A17;color:#ffffff;font-size:10px;padding:2px;text-decoration:none;'>".Prado::localize("content.readmore")."</a>";
				$html.="</td>";
			$html.="</tr>";
		$html.="</table>";
		return $html;
	}
}

?>
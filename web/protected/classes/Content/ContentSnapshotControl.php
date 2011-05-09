<?php

class ContentSnapshotControl extends TPanel  
{
	public $title;
	public $subTitle="";
	public $maxIntroLength=PHP_INT_MAX;
	
	/**
	 * getter title
	 *
	 * @return title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * setter title
	 *
	 * @var title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * getter subTitle
	 *
	 * @return subTitle
	 */
	public function getSubTitle()
	{
		return $this->subTitle;
	}
	
	/**
	 * setter subTitle
	 *
	 * @var subTitle
	 */
	public function setSubTitle($subTitle)
	{
		$this->subTitle = $subTitle;
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
		$writer->write($this->getContentSnapshot($this->title,$this->subTitle,$this->maxIntroLength));
		parent::renderEndTag($writer);
	}
	
	public function getContentSnapshot($title,$subtitle="",$maxIntroLength=PHP_INT_MAX)
	{
		$qry = "select c.id,c.title,c.text 
				from content c
				where c.active = 1
				and c.title like '$title'";
		$results = Dao::getResultsNative($qry,array(),PDO::FETCH_ASSOC);
		if(count($results)==0)
			return;
			
		$content = $results[0];
		$html = "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
			$html .= "<tr>";
				$html .= "<td style='padding: 10px 0 0 0;'>";
					$html .= "<a href='/content/".str_replace(" ","_",trim($title)).".html' style='text-decoration:none;font-weight:bold;color:#000000;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;font-size:24px;'>$title</a>";;
					if($subtitle!="")
						$html .="<br /><i style='color:#AC7755;font-size:16px;font-family:cursive;font-weight:normal;'>$subtitle</i>";
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td style='font-size:13px;text-align: justify;padding: 0 0 0 0;font-family:\"Lucida Sans\",\"Lucida Grande\",\"Lucida Sans Unicode\",Lucida,Verdana,Tahoma,sans-serif;'>";
					if(strstr($content["text"],"{introStop}"))
						$html .=substr($content["text"],0,strpos($content["text"],"{introStop}"))." ... ";
					else
						$html .=$content["text"];
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td>";
					$title = str_replace(" ","_",trim($title));
					$html .= "<a href='/content/$title.html' style=\"padding:5px;color:#BF3A17;font-size:12px;\">".Prado::localize("content.readmore")."</a>";
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";
		return $html;
	}
}

?>
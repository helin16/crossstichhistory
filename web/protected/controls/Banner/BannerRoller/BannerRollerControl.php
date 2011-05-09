<?php

class BannerRollerControl extends TTemplateControl  
{
	public $noOfItems=4;
	public $height=240;
	public $width=685;
	public $timeOutSecs = 5;//the no of secs between each slide
	public $pageLanguageId = 1;	
	
	public function __construct()
	{
		parent::__construct();
		try{
			$this->pageLanguageId = Core::getPageLanguage()->getId();
			$sql = "select count(distinct id) `count` from banner where active=1 and assetId!=0 and languageId=".$this->pageLanguageId;
			$result = Dao::getResultsNative($sql,array(),PDO::FETCH_ASSOC);
			$this->noOfItems = $result[0]['count'];
		}
		catch(Exception $ex)
		{
			$this->noOfItems=0;
		}
	}
	
	/**
	 * getter noOfItems
	 *
	 * @return noOfItems
	 */
	public function getNoOfItems()
	{
		return $this->noOfItems;
	}
	
	/**
	 * setter noOfItems
	 *
	 * @var noOfItems
	 */
	public function setNoOfItems($noOfItems)
	{
		//if there are less banner in the database than wantted
		//then only show the ones in D.B.
		if($this->noOfItems<$noOfItems)
			return;
		$this->noOfItems = $noOfItems;
	}
	
	/**
	 * getter height
	 *
	 * @return height
	 */
	public function getHeight()
	{
		return $this->height;
	}
	
	/**
	 * setter height
	 *
	 * @var height
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}
	
	/**
	 * getter width
	 *
	 * @return width
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * setter width
	 *
	 * @var width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	/**
	 * getter timeOutSecs
	 *
	 * @return timeOutSecs
	 */
	public function getTimeOutSecs()
	{
		return $this->timeOutSecs;
	}
	
	/**
	 * setter timeOutSecs
	 *
	 * @var timeOutSecs
	 */
	public function setTimeOutSecs($timeOutSecs)
	{
		$this->timeOutSecs = $timeOutSecs;
	}
	
	/**
	 * getter pageLanguageId
	 *
	 * @return pageLanguageId
	 */
	public function getPageLanguageId()
	{
		return $this->pageLanguageId;
	}
	
	/**
	 * setter pageLanguageId
	 *
	 * @var pageLanguageId
	 */
	public function setPageLanguageId($pageLanguageId)
	{
		$this->pageLanguageId = $pageLanguageId;
	}
	
	
	public function onLoad($param)
	{
		parent::onLoad($param);
		$this->loadBanners();
	}
	
	public function loadBanners()
	{
		if($this->noOfItems==0) return;
		$service = new BaseService("Banner");
		$banners = $service->findByCriteria("ba.assetId!=0 and ba.languageId=".$this->pageLanguageId,true,1,$this->noOfItems);
		if(count($banners)==0 ) return "";
		
		$listItems = array();
		$showingItems = array();
		
		$i=0;
		foreach($banners as $banner)
		{
			$url =trim($banner->getUrl());
			$url = ($url=="" ? "/" : $url);	
			
			$title=$this->shortenText($banner->getTitle(),20,"");
			$subTitle = $banner->getDescription();
			
			$asset = $banner->getAsset();
			//if there is no images at all, then don't even bother to show it
			if($asset instanceof Asset)
			{
				$thumb_image_params = array("height"=>30,"width"=>50);
				$thumb_image_src = "/asset/".$asset->getAssetId()."/".serialize($thumb_image_params);
				$image_src = "/asset/".$asset->getAssetId()."/".serialize(array());
				
				$showingItems[] = "<div id=\"showingItem_$i\" class=\"".($i==0 ? "showingItem_cur" :"showingItem")."\"  onMouseOver=\"$('pause').value=1;\" onMouseOut=\"$('pause').value=0;\" >
						                <a href='$url' Title='$title'>
							                <div style='border:none;height:{$this->height}px;width:{$this->width}px;background: transparent url($image_src) no-repeat bottom left;'>&nbsp;</div>
							                ".(trim($subTitle)=="" ? "" :"<div class=\"showingItemTitle\">".$this->shortenText($subTitle)."</div>")."
							            </a>
						           </div>
									";
				$listItems[] = "<a id='link_$i' href=\"$url\" onMouseOver=\"showBanner($i);$('pause').value=1;\" onMouseOut=\" $('pause').value=0;\" class='".($i==0 ? "listItem_cur" :"listItem")."'>
									<span class='listItem_img'><img src='$thumb_image_src' Title='$title' style='border:none;'/></span>
									<span class='listItem_title'>$title</span>
									<span class='listItem_subtitle'>".$this->shortenText($subTitle,30,"")."</span>
								</a>";
				$i++;
			}
			
		}
		$this->canvas->getControls()->add(implode("",$showingItems));
		$this->list->getControls()->add(implode("",$listItems));
	}
	
	private function shortenText($text,$maxLength=PHP_INT_MAX,$padding="...")
	{
		if(strlen($text)>$maxLength)
			$text = substr($text,0,$maxLength).$padding;
		return $text;
	}
}

?>
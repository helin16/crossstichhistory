<?php
 
/**
 * class DefaultLayout
 */
class DefaultLayout extends TTemplateControl
{
	public function onInit($param)
	{
	}
	
	public function onLoad()
	{
	}
	
	public function getCategory($categoryName,&$panel)
	{
		$service = new BaseService("ContentCategory");
		$cate = $service->findByCriteria("name ='$categoryName' and languageId=".Core::getPageLanguage()->getId());
		if(count($cate)==0)
			return;
		
		$cateId = $cate[0]->getId();
		$service1 = new BaseService("Content");
		$content = $service1->findByCriteria("id in (select distinct x.contentId from content_contentcategory x where x.contentcategoryId=$cateId)");
		$content=$content[0];
		
		if($content instanceof Content)
		{
			$panel->setTitle($content->getTitle());
			$panel->setSubTitle($content->getSubTitle());
		}
	}
	
	public function getRoundCornerHead()
	{
		return "<table border='0' cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
				<tr style=\"vertical-align:bottom;\">
					<td style=\"width:6px; height:6px; background: #ffffff url('/Theme/default/images/roundCorner_leftTop.png') no-repeat right top;\"></td>
					<td style=\"border-top:1px #0098e6 solid; \">
					</td>
					<td style=\"width:6px;background: #ffffff url('/Theme/default/images/roundCorner_rightTop.png') no-repeat left top;\"></td>
				</tr>
				<tr valign='top'>
					<td style=\"width:6px; border-left:1px #0098e6 solid;\">
					</td>
					<td>";	
	}
	
	public function getRoundCornerFooter()
	{
		return "</td>
				<td style=\"width:6px; border-right:1px #0098e6 solid;\">
				</td>
			</tr>
			<tr style=\"height:6px;\" valign=\"top\">
				<td style=\"width:6px; background: #ffffff url('/Theme/default/images/roundCorner_leftBottom.png') no-repeat right bottom;\"></td>
				<td style=\"border-bottom:1px #0098e6 solid;\"></td>
				<td style=\"width:6px;background: #ffffff url('/Theme/default/images/roundCorner_rightBottom.png') no-repeat left bottom;\"></td>
			</tr>
			</table>";	
	}
}
?>
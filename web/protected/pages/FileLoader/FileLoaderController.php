<?php
class FileLoaderController extends EshopPage
{
	public function onLoad()
	{
		if(!isset($this->Request["assetId"]) || trim($this->Request["assetId"])=="")
		die();
		try
		{
			$param = isset($this->Request["param"]) ? unserialize($this->Request["param"]) : array();
		}
		catch(Exception $e)
		{
			$param=array();
		}
		$this->getAsset($this->Request["assetId"],$param);
	}

	public function getAsset($assetId, $param=array())
	{
		$assetServer = new AssetServer();
		$asset = $assetServer->getAsset($assetId);

		$src = $assetServer->getFilePath($assetId,true);

		if($asset->getAssetType()->getId()==AssetServer::TYPE_GRAPH)
		{
			list($width_orig, $height_orig, $type) = getimagesize($src);
				
			//get the wantted width and height;otherwise, user the original dimension
			$radio = $width_orig/$height_orig;
			$wanttedWidth = isset($param["width"]) ? $param["width"] : $width_orig;
			$wanttedHeight = isset($param["height"]) ? $param["height"] : $height_orig;
			$quality = isset($param["quality"]) ? $param["quality"] : 100;
				
			$newWidth = $wanttedWidth;
			$newHeight = $wanttedHeight;
			if ($newWidth <= $newHeight) 
			{
				$newWidth = $newHeight*$radio;
				$param["newX"]=($newWidth-$wanttedWidth)/2;
				$param["newY"]=0;
			} 
			else 
			{
				$newHeight = $newWidth/$radio;
				$param["newX"]=0;
				$param["newY"]=($newHeight-$wanttedHeight)/2;
			}
			
//			echo "$radio:$newWidth $newHeight";
//			die;
				
			//get the new option
			$newPos_x = isset($param["newX"]) ? $param["newX"] : ($w_src-$newWidth)/2;
			$newPos_y = isset($param["newY"]) ? $param["newY"] : ($h_src-$newHeight)/2;
				
			if(strtolower($asset->getMimeType())=="image/jpg")
			$img_r = imagecreatefromjpeg($src);
			else if(strtolower($asset->getMimeType())=="image/gif")
			$img_r = imagecreatefromgif($src);
			else if(strtolower($asset->getMimeType())=="image/png")
			$img_r = imagecreatefrompng($src);
			$dst_r = ImageCreateTrueColor( round($wanttedWidth), round($wanttedHeight) );

			$background = imagecolorallocate($dst_r,255,0,0);
			imageFilledRectangle($dst_r, 0, 0, $newWidth - 1, $newHeight - 1, $background);		
			imagecopyresampled($dst_r,$img_r,0,0,$newPos_x,$newPos_y,$newWidth,$newHeight,$width_orig,$height_orig);

			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$quality);
						
		}

		die();
	}
}
?>
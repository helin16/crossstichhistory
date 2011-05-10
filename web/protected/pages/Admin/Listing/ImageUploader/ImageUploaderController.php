<?php

class ImageUploaderController extends AdminPage
{
	public $rootDirPath;
	public $rootUrl= "/image/uploaderRoot/";
	
	/**
	 * constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		$this->menuItemName="uploader";
		$uplevel = "/../../../../..";
		$this->rootDirPath = dirname(__FILE__)."$uplevel{$this->rootUrl}";
	}

	/**
	 * onLoad method
	 *
	 * @param $param
	 */
	public function onLoad($param)
	{
		parent::onLoad($param);

		if(!$this->IsPostBack || $param == "reload")
		{
			$this->Path->Text = $this->rootDirPath;
			$this->listFiles();
		}
	}

	public function listFiles()
	{
		$filePanel="";
		if ($handle = opendir($this->rootDirPath)) 
		{
			$this->Path->Text = str_replace($this->rootDirPath,"/",$this->Path->Text);
			
			$fileRowNo=0;
			$filePanel="<table width='100%'>";
				while (false !== ($file = readdir($handle))) 
				{
					if(!in_array($file,array(".","..")))
					{
						$filePanel .="<tr ".($fileRowNo%2==0 ? "" : "style='background: #cccccc;'").">";
							$filePanel .="<td>";
								$filePanel .="<a href='javascript:void(0);' OnClick=\"showDetails('$file','{$this->rootUrl}');return false;\">$file</a>";
							$filePanel .="</td>";
						$filePanel .="</tr>";
						$fileRowNo++;
					}
				}
			$filePanel .="</table>";
		}
		$this->dirPanel->Controls->add($filePanel);
	} 
	
	public function fileUploaded($sender,$param)
	{
        $this->setInfoMessage("");
		if($sender->HasFile)
        {
        	$this->fileUploader->saveAs($this->rootDirPath.$sender->FileName);
        	$this->setInfoMessage("Image {$sender->FileName} uploaded successfully!");
           $this->listFiles();
        }
		
	}
} 
?>

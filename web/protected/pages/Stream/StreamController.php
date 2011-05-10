<?php


//C:\src\hydra-web\main\protected\pages\Ajax\AjaxController.php
//C:\src\hydra-web\main\bootstrap.php

//require_once("../../../../bootstrap.php");


//error_reporting(0);

class StreamController extends TService
{
	// NOTE If anyone copies this controller, then you require this method to profile ajax requests
	public function __construct()
	{
		// Services dont have constructors Apparently
		//parent::__construct();
		//

	}

	public function init($config)
	{

	}

	public function run()
	{
		if(sizeof($_POST) > 0)
		{
			$this->__processPostBack($_POST);
		}

		if(sizeof($_GET) > 0)
		{
			$this->__processPostBack($_GET);
		}
	}

	private function checkForKeys(array $post,array $values)
	{
		foreach($values as $value)
		{
			if(!isset($post[$value]))
			return false;
		}
		return true;
	}

	public function __processPostBack(array $params)
	{
		if(!$this->checkForKeys($params,array('method')))
		return false;
			
		if(method_exists($this,$params['method']))	// BAD FIX
		$this->getResponse()->write($this->$params['method']($params));
			

	}

	public function getCss()
	{
		try
		{
			$theme = Config::get("theme","name");
			if(isset($_REQUEST["cssPath"]) && trim($_REQUEST["cssPath"])=="")
			$cssFilePath = dirname(__FILE__)."/../../theme/$theme/{$_REQUEST["cssPath"]}";
			else
			$cssFilePath = dirname(__FILE__)."/../../theme/$theme/default.css";
			header('Content-Type: content=text');
			readfile($cssFilePath);
			die();
		}
		catch(Exception $ex)
		{
			die($ex->getMessage());
		}
	}

	public function getImage()
	{
		try
		{
			if(!isset($_REQUEST["imagePath"]) || trim($_REQUEST["imagePath"])=="")
			die();
			$path = trim($_REQUEST["imagePath"]);
			$minetype =$this->mime_content_type(end(explode("/",$path)));

			$theme = Config::get("theme","name");
			$imagePath = dirname(__FILE__)."/../../theme/$theme/$path";
			header('Content-Type: ' . $minetype);
			readfile($imagePath);
			die();
		}
		catch(Exception $ex)
		{
			die($ex->getMessage());
		}
	}

	private function mime_content_type($filename) {

		$mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

		// images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

		// archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

		// audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

		// adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

		// ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

		// open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		$ext = strtolower(array_pop(explode('.',$filename)));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}

	public function getCaptcha()
	{
		header('Content-type: image/jpeg');
		
		$width = 50;
		if(isset($_REQUEST["width"]) && trim($_REQUEST["width"])!="")
			$width = $_REQUEST["width"];
			
		$height = 24;
		if(isset($_REQUEST["height"]) && trim($_REQUEST["height"])!="")
			$height = $_REQUEST["height"];
		
		$my_image = imagecreatetruecolor($width, $height);
		imagefill($my_image, 0, 0, 0xFFFFFF);

		// add noise
		for ($c = 0; $c < 100; $c++)
		{
			$x = rand(0,$width-1);
			$y = rand(0,$height-1);
			imagesetpixel($my_image, $x, $y, 0x000000);
		}
		
		$x = rand(1,10);
		$y = rand(1,10);
		
		$rand_string = rand(1000,9999);
		imagestring($my_image, 5, $x, $y, $rand_string, 0x000000);
		
		setcookie('tntcon',(md5($rand_string).'a4xn'));
		
		imagejpeg($my_image);
		imagedestroy($my_image);
		die;
	}
}

?>
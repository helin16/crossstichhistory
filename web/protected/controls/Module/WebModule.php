<?php

class WebModule extends TWebControl  
{
	public $cssClass;
	public $type;
	public $header;
	public $position;
	
	
	public function onLoad($param)
	{
	}
	
	
	public function renderContents($writer)
	{
		$writer->write($this->getContents());
	}
	
	protected function getContents()
	{
		try
		{
			$moduleService = new BaseService("Module");
			$modules = $moduleService->findByCriteria("Position!='' and Position='".$this->position."'");
			
			$return ="";
			foreach($modules as $module)
			{
				try
				{
					$phpclass =trim($module->getPhpClass());
					$phpparams =trim($module->getParams());
					if($phpclass!=="")
					{
						$phpObject = new $phpclass;
						$phpObject->setParams($phpparams);
						if($phpObject instanceof Mod_Module)
							$content = $phpObject->renderContent();
						else
							throw new Exception("'$phpclass' Must be ModuleInterface!"); 
					}
					else 
						$content = $module->getContent();
					
					switch($this->type)
					{
						case 'Table':
							{
								$return .="<table id='".$this->getID()."' class='".($this->cssClass=="" ? "module" : $this->cssClass)."'>
												<tr>
													<td><h3 class='module_header'>".$module->getTitle()."</h3></td>
												</tr>
												<tr>
													<td class='module_body'>$content</td>
												</tr>
											</table>";
								break;
							}
						case 'Div':
							{
								$return .="<div  id='".$this->getID()."'".($this->cssClass=="" ? "" : " class='".$this->cssClass."'").">
												<h3 class='module_header'>".$module->getTitle()."</h3>
												<div class='module_body'>$content</div>
											</div>";
								break;
							}
						default:
							{
								$return .="Unknow type: '".$this->type."'. It should be : Table | Div !";
								break;
							}
					}
				}
				catch(Exception $ex)
				{
					$return .="Error: '".$ex->getMessage().".<br /> ".$ex->getTraceAsString();
				}
			}
				
			return $return;
		}
		catch(Exception $ex)
		{
			return "<b>".$ex->getMessage()."</b><br />".$ex->getTraceAsString();
		}
	}
	
	
	/**
	 * getter type
	 *
	 * @return type
	 */
	public function gettype()
	{
		return $this->type;
	}
	
	/**
	 * setter type
	 *
	 * @var type
	 */
	public function settype($type)
	{
		$this->type = $type;
	}
	
	
	/**
	 * getter cssClass
	 *
	 * @return cssClass
	 */
	public function getcssClass()
	{
		return $this->cssClass;
	}
	
	/**
	 * setter cssClass
	 *
	 * @var cssClass
	 */
	public function setcssClass($cssClass)
	{
		$this->cssClass = $cssClass;
	}
	
	/**
	 * getter position
	 *
	 * @return position
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * setter position
	 *
	 * @var position
	 */
	public function setPosition($position)
	{
		$this->position = $position;
	}
	
}

?>
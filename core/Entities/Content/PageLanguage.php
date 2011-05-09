<?php
class PageLanguage extends HydraEntity 
{
	private $code;
	private $name;
	private $icon;
	
	/**
	 * getter code
	 *
	 * @return code
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	 * setter code
	 *
	 * @var code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}
	
	/**
	 * getter name
	 *
	 * @return name
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * setter name
	 *
	 * @var name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * getter icon
	 *
	 * @return icon
	 */
	public function getIcon()
	{
		return $this->icon;
	}
	
	/**
	 * setter icon
	 *
	 * @var icon
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}
	
	
	
	
	public function __toString()
	{
		return $this->getIcon();
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pl');
		
		DaoMap::setStringType('code','varchar',20);
		DaoMap::setStringType('name','varchar',200);
		DaoMap::setStringType('icon','varchar',255);
		
		DaoMap::commit();
	}
}
?>
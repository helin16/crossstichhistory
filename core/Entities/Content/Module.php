<?php
class Module extends HydraEntity 
{
	private $title;
	private $position;
	private $content;
	private $params;
	private $phpClass;
	private $order;
	
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
	
	/**
	 * getter content
	 *
	 * @return content
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * setter content
	 *
	 * @var content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	/**
	 * getter params
	 *
	 * @return params
	 */
	public function getParams()
	{
		return $this->params;
	}
	
	/**
	 * setter params
	 *
	 * @var params
	 */
	public function setParams($params)
	{
		$this->params = $params;
	}
	
	/**
	 * getter phpClass
	 *
	 * @return phpClass
	 */
	public function getPhpClass()
	{
		return $this->phpClass;
	}
	
	/**
	 * setter phpClass
	 *
	 * @var phpClass
	 */
	public function setPhpClass($phpClass)
	{
		$this->phpClass = $phpClass;
	}
	
	
	public function __toString()
	{
		return "<div class='module'><h3>{$this->gettitle()}</h3>{$this->getcontent()}</div>";
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'mod');
		
		DaoMap::setStringType('title');
		DaoMap::setStringType('content','text');
		DaoMap::setStringType('params','varchar',12000);
		DaoMap::setStringType('position');
		DaoMap::setStringType('phpClass');
		DaoMap::setIntType('order');
		DaoMap::commit();
	}
	
}
?>
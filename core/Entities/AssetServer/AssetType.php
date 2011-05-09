<?php

/**
 * Entity for tracking types of content that can be stored in shared storage
 *
 * @package AssetType
 * @subpackage Entity
 */
class AssetType extends HydraEntity
{
	/**
	 * @var string
	 */
	private $type;
	
	/**
	 * @var string
	 */
	private $path;
	
	/**
	 * getter type
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * setter type
	 *
	 * @var string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * getter path
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}
	
	/**
	 * setter path
	 *
	 * @var string $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'conty');
		
		DaoMap::setStringType('type', 'varchar', 10);
		DaoMap::setStringType('path', 'varchar', 50);
		
		DaoMap::commit();
	}
}

?>
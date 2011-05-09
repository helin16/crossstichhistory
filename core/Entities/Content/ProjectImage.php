<?php
class ProjectImage extends HydraEntity 
{
	private $isDefault;
	
	/**
	 * @var Project
	 */
	protected $project;
	
	/**
	 * @var Asset
	 */
	protected $asset;
	
	/**
	 * getter asset
	 *
	 * @return asset
	 */
	public function getAsset()
	{
		$this->loadOneToOne("asset");
		return $this->asset;
	}
	
	/**
	 * setter asset
	 *
	 * @var asset
	 */
	public function setAsset($asset)
	{
		$this->asset = $asset;
	}	
	/**
	 * getter isDefault
	 *
	 * @return isDefault
	 */
	public function getIsDefault()
	{
		return $this->isDefault;
	}
	
	/**
	 * setter isDefault
	 *
	 * @var isDefault
	 */
	public function setIsDefault($isDefault)
	{
		$this->isDefault = $isDefault;
	}
	
	
	/**
	 * getter project
	 *
	 * @return project
	 */
	public function getProject()
	{
		$this->loadManyToOne("project");
		return $this->project;
	}
	
	/**
	 * setter project
	 *
	 * @var project
	 */
	public function setProject($project)
	{
		$this->project = $project;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pi');
		
		DaoMap::setOneToOne("asset","Asset",true,"ass");
		DaoMap::setBoolType("isDefault");
		DaoMap::setManyToOne("project","Project");
		
		DaoMap::commit();
	}
}
?>
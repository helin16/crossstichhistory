<?php
class PropertyInspectionTime extends HydraEntity 
{
	private $time;
	protected $project;
	
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
	/**
	 * getter time
	 *
	 * @return time
	 */
	public function getTime()
	{
		return $this->time;
	}
	
	/**
	 * setter time
	 *
	 * @var time
	 */
	public function setTime($time)
	{
		$this->time = $time;
	}
	
	public function __toString()
	{
		return $this->time;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'inspTime');
		DaoMap::setDateType('time');
		DaoMap::setManyToOne("project","Project");
		DaoMap::commit();
	}
}
?>
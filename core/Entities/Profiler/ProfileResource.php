<?php

/**
 * Entity used to track memory usage and load times for page requests
 *  - this should only be used by the Profiler
 *
 * @package Core
 * @subpackage Profiler
 */
class ProfileResource extends HydraEntity
{
	private $ref;
	private $startTime;
	private $endTime;
	private $loadTime;
	private $memUsage;
	private $peakMemUsage;
	private $machineId;
	
	/**
	 * Set the reference info identifying the usage data, typically a url
	 *
	 * @param string $ref
	 */
	public function setRef($ref)
	{
		$this->ref = $ref;
	}
	
	/**
	 * Get the reference data identifying the usage data, typically a url
	 *
	 * @return string
	 */
	public function getRef()
	{
		return $this->ref;
	}
	
	/**
	 * Set the start time stat
	 *
	 * @param float $v
	 */
	public function setStartTime($v)
	{
		$this->startTime = $v;
	}
	
	/**
	 * Get the start time stat
	 *
	 * @return float
	 */
	public function getStartTime()
	{
		return $this->startTime;
	}
	
	/**
	 * Set the end time stat
	 *
	 * @param float $v
	 */
	public function setEndTime($v)
	{
		$this->endTime = $v;
	}
	
	/**
	 * Get the end time stat
	 *
	 * @return float
	 */
	public function getEndTime()
	{
		return $this->endTime;
	}
	
	/**
	 * Set the load time stat
	 *
	 * @param float $v
	 */
	public function setLoadTime($v)
	{
		$this->loadTime = $v;
	}
	
	/**
	 * Get the load time stat
	 *
	 * @return float
	 */
	public function getLoadTime()
	{
		return $this->loadTime;
	}
	
	/**
	 * Set the memory usage stat
	 *
	 * @param float $v
	 */
	public function setMemUsage($v)
	{
		$this->memUsage = $v;
	}
	
	/**
	 * Get the memory usage stat
	 *
	 * @return float
	 */
	public function getMemUsage()
	{
		return $this->memUsage;
	}
	
	/**
	 * Set the peak memory usage stat
	 *
	 * @param float $v
	 */
	public function setPeakMemUsage($v)
	{
		$this->peakMemUsage = $v;
	}
	
	/**
	 * Get the peak memory usage stat
	 *
	 * @return float
	 */
	public function getPeakMemUsage()
	{
		return $this->peakMemUsage;
	}
	
	/**
	 * Set the IPv4 address/hostname where the request originated from
	 *
	 * @param string $v
	 */
	public function setMachineId($id)
	{
		$this->machineId = $id;
	}
	
	/**
	 * Get the originating IPv4 address/hostname for the request
	 *
	 * @return string
	 */
	public function getMachineId()
	{
		return $this->machineId;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'prores');

		DaoMap::setStringType('ref', 'varchar', 255);
		DaoMap::setIntType('startTime', 'float', null, false);
		DaoMap::setIntType('endTime', 'float', null, false);
		DaoMap::setIntType('loadTime', 'float', null, false);
		DaoMap::setIntType('memUsage', 'float', null, false);
		DaoMap::setIntType('peakMemUsage', 'float', null, false);
		DaoMap::setStringType('machineId', 'varchar', 20);
		
		DaoMap::commit();
	}
}

?>
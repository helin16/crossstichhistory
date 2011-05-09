<?php

/**
 * Entity used to track SQL statements going through the Dao when the SQL Profiler is activated
 *  - this should only be used by the Dao
 *
 * @package Core
 * @subpackage Profiler
 */
class ProfileSQL extends ProfileResource
{
	private $sql = '';
	private $args = '';
	private $hash = '';
	
	/**
	 * Set the SQL statement to capture
	 *
	 * @param string $sql
	 */
	public function setSql($sql)
	{
		$this->sql = $sql;
	}
	
	/**
	 * Get the captured SQL statement
	 *
	 * @return string
	 */
	public function getSql()
	{
		return $this->sql;
	}
	
	/**
	 * Set the SQL arguments
	 *
	 * @param string $args
	 */
	public function setArgs($args)
	{
		$this->args = $args;
	}
	
	/**
	 * Get the SQL arguments
	 *
	 * @return string
	 */
	public function getArgs()
	{
		return $this->args;
	}
	
	/**
	 * Set the SQL argument hash (MD5)
	 *
	 * @param string $hash
	 */
	public function setHash($hash)
	{
		$this->hash = $hash;
	}
	
	/**
	 * Get the SQL argument hash
	 *
	 * @return string
	 */
	public function getHash()
	{
		return $this->hash;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'prosql');

		DaoMap::setStringType('sql', 'text');
		DaoMap::setStringType('args', 'text');
		DaoMap::setStringType('hash', 'varchar', 32);
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
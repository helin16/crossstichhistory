<?php

/**
 * Entity for tracking location of content assets in shared storage
 *
 * @package ContentServer
 * @subpackage Entity
 */
class Asset extends HydraEntity
{
	/**
	 * @var AssetType
	 */
	protected $assetType;
	
	/**
	 * @var string
	 */
	private $assetId;
	
	/**
	 * @var string
	 */
	private $filename;
	
	/**
	 * @var string
	 */
	private $mimeType;
	
	/**
	 * @var string
	 */
	private $path;
	
	/**
	 * getter AssetType
	 *
	 * @return AssetType
	 */
	public function getAssetType()
	{
		$this->loadManyToOne('assetType');
		return $this->assetType;
	}
	
	/**
	 * setter AssetType
	 *
	 * @var AssetType $contentType
	 */
	public function setAssetType(AssetType $contentType)
	{
		$this->assetType = $contentType;
	}
	
	/**
	 * getter assetId
	 *
	 * @return string
	 */
	public function getAssetId()
	{
		return $this->assetId;
	}
	
	/**
	 * setter assetId
	 *
	 * @var string $assetId
	 */
	public function setAssetId($assetId)
	{
		$this->assetId = $assetId;
	}

	/**
	 * getter filename
	 *
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}
	
	/**
	 * setter filename
	 *
	 * @var string $filename
	 */
	public function setFilename($filename)
	{
		$this->filename = $filename;
	}
	
	/**
	 * getter mimeType
	 *
	 * @return string
	 */
	public function getMimeType()
	{
		return $this->mimeType;
	}
	
	/**
	 * setter mimeType
	 *
	 * @var string $mimeType
	 */
	public function setMimeType($mimeType)
	{
		$this->mimeType = $mimeType;
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
	
	public function __toString()
	{
		// Should this be the asset path instead?
		return $this->filename;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'ass');
		
		DaoMap::setManyToOne('assetType', 'AssetType', 'conty');
		DaoMap::setStringType('assetId', 'varchar', 32);
		DaoMap::setStringType('filename', 'varchar', 100);
		DaoMap::setStringType('mimeType', 'varchar', 50);
		DaoMap::setStringType('path', 'varchar', 255);
		
		DaoMap::createUniqueIndex('assetId');
		
		DaoMap::commit();
	}
}

?>
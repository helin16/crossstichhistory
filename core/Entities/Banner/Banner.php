<?php
class Banner extends HydraEntity 
{
	private $url;
	private $title;
	private $description;
	
	/**
	 * @var Asset
	 */
	protected $asset;
	/**
	 * @var PageLanguage
	 */
	protected $language;
	
	/**
	 * getter url
	 *
	 * @return url
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * setter url
	 *
	 * @var url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}
	
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
	 * getter description
	 *
	 * @return description
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * setter description
	 *
	 * @var description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	/**
	 * getter asset
	 *
	 * @return asset
	 */
	public function getAsset()
	{
		$this->loadOneToOne('asset');
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
	 * getter language
	 *
	 * @return language
	 */
	public function getLanguage()
	{
		$this->loadManyToOne("language");
		return $this->language;
	}
	
	/**
	 * setter language
	 *
	 * @var language
	 */
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'ba');
		
		DaoMap::setStringType("title",'varchar',50);
		DaoMap::setStringType("description",'varchar',100);
		DaoMap::setStringType("url",'varchar',255);
		DaoMap::setOneToOne("asset","Asset",true,"ass");
		DaoMap::setManyToOne("language","PageLanguage");
		
		DaoMap::defaultSortOrder("id",DaoMap::SORT_DESC);
		DaoMap::commit();
	}
}
?>
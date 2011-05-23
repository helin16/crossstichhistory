<?php 
class ProductFeatureCategory extends HydraEntity
{
	const ID_IMAGE = 1;
	const ID_DIMENSION_L = 2;
	const ID_DIMENSION_W = 3;
	const ID_DIMENSION_H = 4;
	const ID_IMAGE_DISPLAY = 5;
	
	private $name;
	/**
	 * @var PageLanguage
	 */
	protected $language;
	
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
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pfc');
		
		DaoMap::setStringType('name','varchar',256);
		DaoMap::setManyToOne("language","PageLanguage","pl");
		DaoMap::defaultSortOrder("name");
		
		DaoMap::commit();
	}
}
?>
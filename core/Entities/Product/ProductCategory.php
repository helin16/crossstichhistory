<?php
class ProductCategory extends HydraEntity 
{
	private $name;
	
	protected $products;
	/**
	 * @var PageLanguage
	 */
	protected $language;
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
	 * getter products
	 *
	 * @return products
	 */
	public function getProducts()
	{
		$this->loadManyToMany("products");
		return $this->products;
	}
	
	/**
	 * setter products
	 *
	 * @var products
	 */
	public function setProducts($products)
	{
		$this->products = $products;
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
	
	public function __toString()
	{
		return $this->name;
	}
	
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'procat');
		
		DaoMap::setStringType('name');
		DaoMap::setManyToMany("products","Product",DaoMap::LEFT_SIDE,"pro");
		DaoMap::setManyToOne("language","PageLanguage","pl");
		DaoMap::commit();
	}
}
?>
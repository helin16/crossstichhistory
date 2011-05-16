<?php
class ProductCategory extends HydraEntity 
{
	private $name;
	protected $parent;
	protected $root;
	private $position;
	const POSITION_LEVEL_DIGITS=3;
	
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
	 *  Getter for parent
	 *
	 * @return ProductCategory parent
	 */
	public function getParent() 
	{
		$this->loadManyToOne("parent");
	  	return $this->parent;
	}
	
	/**
	 * Setter for parent
	 *
	 * @param ProductCategory $Value
	 */
	public function setParent($Value) 
	{
	  	$this->parent = $Value;
	}
	
	/**
	 *  Getter for root
	 *
	 * @return ProductCategory root
	 */
	public function getRoot() 
	{
		$this->loadManyToOne("root");
	  	return $this->root;
	}
	
	/**
	 * Setter for root
	 *
	 * @param ProductCategory $Value
	 */
	public function setRoot($Value) 
	{
	  	$this->root = $Value;
	}
	
	/**
	 *  Getter for position
	 *
	 * @return String position
	 */
	public function getposition() 
	{
	  return $this->position;
	}
	
	/**
	 * Setter for position
	 *
	 * @param String $Value
	 */
	public function setposition($Value) 
	{
	  $this->position = $Value;
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
	
	public function preSave()
	{
		if(trim($this->getId())!="")
			$this->setRoot($this);
	}
	
	public function getChildren($depth=1)
	{
		$service = new BaseService("ProductCategory");
		return $service->findByCriteria("position like '".$this->getposition()."%' and length(position)=(1+$depth)");
	}
	
	public function getParents($depth=1)
	{
		$service = new BaseService("ProductCategory");
		return $service->findByCriteria("position like '".$this->getposition()."%' and length(position)=(1+$depth)");
	}
	
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'procat');
		
		DaoMap::setStringType('name');
		DaoMap::setManyToOne("parent","ProductCategory","pp");
		DaoMap::setManyToOne("root","ProductCategory","pr");
		DaoMap::setStringType("position","varchar",256,false,"1");
		DaoMap::setManyToMany("products","Product",DaoMap::LEFT_SIDE,"pro");
		DaoMap::setManyToOne("language","PageLanguage","pl");
		
		DaoMap::createUniqueIndex('name');
		
		DaoMap::commit();
	}
}
?>
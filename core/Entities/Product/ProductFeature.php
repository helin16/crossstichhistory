<?php
class ProductFeature extends HydraEntity 
{
	/**
	 * @var string
	 */
	private $value;
	/**
	 * @var Product
	 */
	protected $product;
	/**
	 * @var PageLanguage
	 */
	protected $language;
	
	/**
	 * @var ProductFeatureCategory
	 */
	protected $category;
	
	public function __toString()
	{
		return "<div class='Product'><h3>{$this->getTitle()}</h3>{$this->getDescription()}</div>";
	}
	
	/**
	 * getter value
	 *
	 * @return value
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * setter value
	 *
	 * @var value
	 */
	public function setValue($value)
	{
		$this->value = $value;
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
	
	/**
	 * getter product
	 *
	 * @return product
	 */
	public function getProduct()
	{
		$this->loadManyToOne("Product");
		return $this->product;
	}
	
	/**
	 * setter Product
	 *
	 * @var Product
	 */
	public function setProduct($product)
	{
		$this->product = $product;
	}
	
	/**
	 * getter ProductFeatureCategory
	 *
	 * @return ProductFeatureCategory
	 */
	public function getCategory()
	{
		$this->loadManyToOne("category");
		return $this->category;
	}
	
	/**
	 * setter ProductFeatureCategory
	 *
	 * @var ProductFeatureCategory
	 */
	public function setCategory($category)
	{
		$this->category = $category;
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pro');
		
		DaoMap::setStringType('value','varchar',256);
		
		DaoMap::setManyToOne("product","Product","pro");
		DaoMap::setManyToOne("category","ProductFeatureCategory","pfc");
		DaoMap::setManyToOne("language","PageLanguage","pl");
		
		DaoMap::commit();
	}
}
?>
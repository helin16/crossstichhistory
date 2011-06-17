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
		try{$this->loadManyToOne("parent");}catch(Exception $x){}
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
		try{$this->loadManyToOne("root");}catch(Exception $x){}
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
		if(trim($this->getposition())=="")
			$this->setposition("1");
	}
	public function postSave()
	{
		if(!$this->getRoot() instanceof ProductCategory || !$this->getParent() instanceof ProductCategory)
		{
			$sql="update productcategory set parentId='0', rootId='".$this->getId()."' where id=".$this->getId();
			Dao::execSql($sql);
		}
	}
	
	public function getChildren($depth=1)
	{
		$depth = $depth * ProductCategory::POSITION_LEVEL_DIGITS +strlen($this->getposition());
		$service = new BaseService("ProductCategory");
		return $service->findByCriteria("position like '".$this->getposition()."%' and length(position)=$depth and rootId = '".$this->getRoot()->getId()."'");
	}
	
	public function getNextPosInChildren()
	{
		$position = $this->getPosition();
		$children = $this->getChildren();
		if(count($children) == 0)															
			return $position . "000";										//no nodes yet so start from start

		$taken = array();
		foreach ($children as $child)														//put all into array
			$taken[] = (int)trim(($child->getPosition()));

		$range = range((int)($position.str_repeat("0",ProductCategory::POSITION_LEVEL_DIGITS)), (int)($position.str_repeat("9",ProductCategory::POSITION_LEVEL_DIGITS)));		//create array of all valid options
		$avail = array_diff($range, $taken);										//get difference of two arrays, available positions
		
		if (count($avail) == 0)
			throw new Exception(" You have reached the maximum (" . ((int)(str_repeat("9",ProductCategory::POSITION_LEVEL_DIGITS)))+1 . ") number of children under this location, aborted...");
			
		foreach($avail as $id)
		{return $id;}
	}
	
	public function moveToSubCategory(ProductCategory $parent)
	{
		$nextPos = $parent->getNextPosInChildren();
		$currentPos = $this->getposition();
//		Debug::inspect($parent->getRoot()->getId());
//		Debug::inspect($nextPos);
		$sql="update productcategory set rootId='".$parent->getRoot()->getId()."', position=concat('$nextPos',substr(position,(length('$currentPos')+1))) where rootId='".$this->getRoot()->getId()."' and active=1 and position like '".$currentPos."%'";
		Dao::execSql($sql);
		
		$sql="update productcategory set parentId='".$parent->getId()."' where id=".$this->getId();
		Dao::execSql($sql);
		
		//re-populate the object
		$service = new BaseService("ProductCategory");
		return $service->get($this->getId());
	}
	
	public function moveToRoot()
	{
		$nextPos = 1;
		$currentPos = $this->getposition();
		$sql="update productcategory set rootId='".$this->getId()."', position=concat('$nextPos',substr(position,(length('$currentPos')+1))) where rootId='".$this->getRoot()->getId()."' and active=1 and position like '".$currentPos."%'";
		Dao::execSql($sql);
		
		$sql="update productcategory set parentId=null where id=".$this->getId();
		Dao::execSql($sql);
		
		//re-populate the object
		$service = new BaseService("ProductCategory");
		return $service->get($this->getId());
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'procat');
		
		DaoMap::setStringType('name');
		DaoMap::setManyToOne("parent","ProductCategory","pp",true);
		DaoMap::setManyToOne("root","ProductCategory","pr",true);
		DaoMap::setStringType("position","varchar",256,false,"1");
		DaoMap::setManyToMany("products","Product",DaoMap::LEFT_SIDE,"pro");
		DaoMap::setManyToOne("language","PageLanguage","pl");
		
		DaoMap::createUniqueIndex('name');
		
		DaoMap::commit();
	}
}
?>
<?php
class Product extends HydraEntity 
{
	private $title;
	private $description;
	private $noOfVisits;
	private $sku;
	protected $productCategories;
	
	/**
	 * getter productCategories
	 *
	 * @return productCategories
	 */
	public function getProductCategories()
	{
		$this->loadManyToMany("productCategories");
		return $this->productCategories;
	}
	
	/**
	 * setter productCategories
	 *
	 * @var productCategories
	 */
	public function setProductCategories($categories)
	{
		$this->productCategories = $categories;
	}
	
	/**
	 * setter string
	 *
	 * @var string
	 */
	public function addCategory($categoryId)
	{
		$userAccountId = Core::getUser()->getId();
		$sql="insert into product_productcategory(`productcategoryId`,`productid`,`created`,`createdById`)
				value('$categoryId','".$this->getId()."','$value',NOW(),$userAccountId,NOW(),$userAccountId)";
		Dao::execSql($sql);
		return Dao::$lastInsertId;
	}
	
	public function clearCategory()
	{
		$sql="delete from product_productcategory where productId=".$this->getId();
		$result = Dao::getResultsNative($sql);
		Dao::execSql($sql);
	}
	
	/**
	 * getter noOfVisits
	 *
	 * @return noOfVisits
	 */
	public function getNoOfVisits()
	{
		return $this->noOfVisits;
	}
	
	/**
	 * setter noOfVisits
	 *
	 * @var noOfVisits
	 */
	public function setNoOfVisits($noOfVisits)
	{
		$this->noOfVisits = $noOfVisits;
	}
	
	/**
	 * getter sku
	 *
	 * @return sku
	 */
	public function getSku()
	{
		return $this->sku;
	}
	
	/**
	 * setter sku
	 *
	 * @var sku
	 */
	public function setSku($sku)
	{
		$this->sku = $sku;
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
	 * @var PageLanguage
	 */
	protected $language;
	
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
	 * setter string
	 *
	 * @var string
	 */
	public function getFeature($featureCategoryId=1,$separator=",")
	{
		if(trim($this->getId())=="")
			return;
		$sql="select group_concat(pf.value separator ',') from productfeature pf where pf.active = 1 and pf.categoryId=$featureCategoryId and pf.productId=".$this->getId();
		$result = Dao::getResultsNative($sql);
		if(count($result)==0)
			return;
			
		return $result[0][0];
	}
	
	/**
	 * setter string
	 *
	 * @var string
	 */
	public function addFeature($featureCategoryId=1,$value)
	{
		if(trim($this->getId())=="" || trim($value)==="")
			return;
			
		$userAccountId = Core::getUser()->getId();
		$sql="insert into productfeature(`categoryId`,`productId`,`value`,`created`,`createdById`,`updated`,`updatedById`)
				value('$featureCategoryId','".$this->getId()."','$value',NOW(),$userAccountId,NOW(),$userAccountId)";
		Dao::execSql($sql);
		return Dao::$lastInsertId;
	}
	
	public function clearFeature($featureCategoryId)
	{
		$sql="delete from productfeature  where value='".trim($value)."' and categoryId=$featureCategoryId and productId=".$this->getId();
		$result = Dao::getResultsNative($sql);
		Dao::execSql($sql);
	}
	
	
	public function getSnapshot()
	{
		$html="<div class='Product_snaphost'>";
			$html.="<table class='Product_snaphost_table'> ";
				$html.="<tr>"; 
					$html.="<td>"; 
						$html.="<div class='Product_snaphost_Image'> ";
							$assetIds = explode(",",$this->getFeature());
							if(count($assetIds)>0)
								$html.="<img src='/asset/{$assetIds[0]}/".serialize(array("height"=>150,"width"=>150))."' style='margin: 5px;' />";
						$html.="</div> ";
					$html.="</td>"; 
					$html.="<td>"; 
						$html.="<div class='Product_snaphost_title'> ";
							$html.=$this->getTitle();
						$html.="</div>";
					$html.="</td>"; 
				$html.="</tr>"; 
			$html.="</table>";
		$html.="</div >";
		return $html;
	}
	
	public function __toString()
	{
		return "<div class='Product'><h3>{$this->getTitle()}</h3>{$this->getDescription()}</div>";
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'pro');
		
		DaoMap::setStringType('sku', 'varchar', 100);
		DaoMap::setStringType('title','varchar',100);
		DaoMap::setStringType('description','text');
		DaoMap::setIntType('noOfVisits', 'int', 10);
		
		DaoMap::setManyToOne("language","PageLanguage","pl");
		DaoMap::setManyToMany("productCategories","ProductCategory",DaoMap::RIGHT_SIDE,"pc");
		
		DaoMap::createUniqueIndex('sku');
		DaoMap::createIndex('title');
		
		DaoMap::defaultSortOrder("title");
		DaoMap::commit();
	}
}
?>
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
		if(trim($this->getId())=="")
			return;
		
		$userAccountId = Core::getUser()->getId();
		$sql="insert into product_productcategory(`productcategoryId`,`productId`,`created`,`createdById`)
				value('$categoryId','".$this->getId()."',NOW(),$userAccountId)";
		Dao::execSql($sql);
		return Dao::$lastInsertId;
	}
	
	public function clearCategory()
	{
		$sql="delete from product_productcategory where productId=".$this->getId();
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
		$sql="delete from productfeature where categoryId=$featureCategoryId and productId=".$this->getId();
		Dao::execSql($sql);
	}
	
	
	public function getSnapshot($viewUrl="/product/",$image_W=150,$image_H=200)
	{
		$detailsUrl = $viewUrl .$this->getTitle().".html";
			$html="<table class='Product_snaphost_table' > ";
				$html.="<tr>"; 
					$html.="<td class='Product_snaphost_Image' style='padding: 2px;'>"; 
						$images_assetIds =$this->getFeature();
						$assetIds = explode(",",$images_assetIds);
							$html.="<a href='$detailsUrl' style='outline:none;display:block; width: {$image_W}px; height: {$image_H}px;'>";
							if($images_assetIds!="" && count($assetIds)>0)
								$html.="<img src='/asset/{$assetIds[0]}/".serialize(array("height"=>$image_H,"width"=>$image_W))."' style='border:none;' />";
							else
								$html.="<img src='/stream?method=getCaptcha&width=$image_W&height=$image_H&noise=3000&displayString=NoImage' style='border:none;' />";
							$html.="</a>";
					$html.="</td>"; 
				$html.="</tr>"; 
				$html.="<tr>"; 
					$html.="<td class='Product_snaphost_title' style='text-align:justify;text-align:center;'>"; 
						$html.="<a href='$detailsUrl' style='outline:none;text-decoration:none;color:#000000;'>";
							$html.=$this->getTitle();
						$html.="</a>";
					$html.="</td>"; 
				$html.="</tr>"; 
			$html.="</table>";
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
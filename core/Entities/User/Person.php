<?php

class Person extends HydraEntity
{
	private $firstName;
	private $lastName;
	protected $userAccounts;
	private $title;
	private $position;
	private $description;
	protected $personalImage;
	private $phone;
	private $email;
	private $mobile;
	private $fax;
	
	protected $projects;
	
	
	/**
	 * getter fax
	 *
	 * @return fax
	 */
	public function getFax()
	{
		return $this->fax;
	}
	
	/**
	 * setter fax
	 *
	 * @var fax
	 */
	public function setFax($fax)
	{
		$this->fax = $fax;
	}
	
	/**
	 * getter mobile
	 *
	 * @return mobile
	 */
	public function getMobile()
	{
		return $this->mobile;
	}
	
	/**
	 * setter mobile
	 *
	 * @var mobile
	 */
	public function setMobile($mobile)
	{
		$this->mobile = $mobile;
	}
	
	/**
	 * getter email
	 *
	 * @return email
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * setter email
	 *
	 * @var email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * getter phone
	 *
	 * @return phone
	 */
	public function getPhone()
	{
		return $this->phone;
	}
	
	/**
	 * setter phone
	 *
	 * @var phone
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}
	
	/**
	 * getter personalImage
	 *
	 * @return personalImage
	 */
	public function getPersonalImage()
	{
		$this->loadManyToOne("personalImage");
		return $this->personalImage;
	}
	
	/**
	 * setter personalImage
	 *
	 * @var personalImage
	 */
	public function setPersonalImage($personalImage)
	{
		$this->personalImage = $personalImage;
	}
	/**
	 * getter position
	 *
	 * @return position
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * setter position
	 *
	 * @var position
	 */
	public function setPosition($position)
	{
		$this->position = $position;
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
	 * getter UserAccount
	 *
	 * @return UserAccount
	 */
	public function getUserAccount()
	{
		return $this->userAccounts;
	}
	
	/**
	 * Setter UserAccount
	 *
	 * @param UserAccount UserAccount
	 */
	public function setUserAccount($UserAccount)
	{
		$this->userAccounts = $UserAccount;
	}
	
	/**
	 * getter FirstName
	 *
	 * @return String
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	/**
	 * Setter FirstName
	 *
	 * @param String FirstName
	 */
	public function setFirstName($FirstName)
	{
		$this->firstName = $FirstName;
	}
	
	/**
	 * getter LastName
	 *
	 * @return String
	 */
	public function getLastName()
	{
		return $this->lastName;
	}
	
	/**
	 * Setter LastName
	 *
	 * @param String LastName
	 */
	public function setLastName($LastName)
	{
		$this->lastName = $LastName;
	}
	
	public function getFullName()
	{
		return $this->getFirstName()." ".$this->getLastName();
	}
	
	/**
	 * getter projects
	 *
	 * @return projects
	 */
	public function getProjects()
	{
		return $this->projects;
	}
	
	/**
	 * setter projects
	 *
	 * @var projects
	 */
	public function setProjects($projects)
	{
		$this->loadManyToMany("projects");
		$this->projects = $projects;
	}
		
	public function __toString()
	{
		return $this->getFirstName()." ".$this->getLastName();
	}
	
	public function __loadDaoMap()
	{
		DaoMap::begin($this, 'r');
		
		DaoMap::setStringType('firstName');
		DaoMap::setStringType('lastName');
		DaoMap::setOneToMany("userAccounts","UserAccount","ua");
		DaoMap::setStringType('title','varchar',200,true,'');
		DaoMap::setStringType('position','varchar',200,true,'');
		DaoMap::setStringType('description','text',20,true,'');
		DaoMap::setManyToMany("projects","Project",DaoMap::RIGHT_SIDE,"pro",true);
		DaoMap::setManyToOne("personalImage","Asset","asset",true);
		
		DaoMap::setStringType('phone','varchar',100,true,'');
		DaoMap::setStringType('email','varchar',100,true,'');
		DaoMap::setStringType('mobile','varchar',100,true,'');
		DaoMap::setStringType('fax','varchar',100,true,'');
		DaoMap::commit();
	}
}

?>
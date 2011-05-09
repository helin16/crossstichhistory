<?php

class GoogleMapControl extends TTemplateControl  
{
	public $width=500;
	public $height=500;
	
	public $address="Melbourne, Australia";
	public $key="ABQIAAAA1C_jZLWqzT_GaEVaTa3edBTbNGShWnYJQvjFg-GX_9SqdLGn2xRmiKdHlZJpYFFH0SK3vazycbcljg";

	/**
	 * getter key
	 *
	 * @return key
	 */
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	 * setter key
	 *
	 * @var key
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}
	
	
	/**
	 * getter width
	 *
	 * @return width
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * setter width
	 *
	 * @var width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	/**
	 * getter height
	 *
	 * @return height
	 */
	public function getHeight()
	{
		return $this->height;
	}
	
	/**
	 * setter height
	 *
	 * @var height
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}
	
	/**
	 * getter address
	 *
	 * @return address
	 */
	public function getAddress()
	{
		return $this->address;
	}
	
	/**
	 * setter address
	 *
	 * @var address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}
	
}

?>
<?php
namespace App\Models;
use App\Models\Interfaces\IShipping;

// Shipping model
class Shipping extends Model implements IShipping, \JsonSerializable
{
  protected $id;
  protected $address;
  protected $city;
  protected $country;
  protected $post_code;

  function __construct(
    $address,
    $city,
    $country = null,
    $post_code = null
    )
  {
    //calling mutators
    $this->setAddress($address);
    $this->setCity($city);
    $this->setCountry($country);
    $this->setPost_code($post_code);
  }

  public function jsonSerialize()
    {
        return get_object_vars($this);
    }

  public function setId($id){
    if($this->id !== null){
      throw new \RuntimeException("Object ID already exists!");
    }
    if(!is_int($id) || $id < 0){
      throw new \RuntimeException("Provided ID is invalid.");
    }
    $this->id = $id;
    return $this;
  }
  public function getId(){
    return $this->id;
  }

  public function setAddress($address){
    $this->address = $address;
    return $this;
  }
  public function getAddress(){
    return $this->address;
  }

  public function setCity($city){
    $this->city = $city;
    return $this;
  }
  public function getCity(){
    return $this->city;
  }

  public function setCountry($country){
    $this->country = $country;
    return $this;
  }
  public function getCountry(){
    return $this->country;
  }

  public function setPost_code($post_code){
    $this->post_code = $post_code;
    return $this;
  }
  public function getPost_code(){
    return $this->post_code;
  }
}

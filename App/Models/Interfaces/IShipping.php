<?php

namespace App\Models\Interfaces;

interface IShipping{

  public function setId($id);
  public function getId();

  public function setAddress($address);
  public function getAddress();

  public function setCity($city);
  public function getCity();

  public function setCountry($country);
  public function getCountry();

  public function setPost_code($post_code);
  public function getPost_code();

}

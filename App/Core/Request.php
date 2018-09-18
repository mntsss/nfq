<?php

namespace App\Core;

class Request implements \ArrayAccess
{
  private $postParams = array();

  public function __construct($request_body) {
      $this->postParams = json_decode($request_body);
  }

  public function all(){
    return (array)$this->postParams;
  }

  public function offsetSet($offset, $value) {
      if (is_null($offset)) {
          $this->container[] = $value;
      } else {
          $this->container[$offset] = $value;
      }
  }

  public function offsetExists($offset) {
      return isset($this->container[$offset]);
  }

  public function offsetUnset($offset) {
      unset($this->container[$offset]);
  }

  public function offsetGet($offset) {
      return isset($this->container[$offset]) ? $this->container[$offset] : null;
  }
}

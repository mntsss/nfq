<?php

namespace App\Models\Interfaces;

use App\Models\Interfaces\IShipping;

interface IShippingMapper{

  public function findAll(array $array = array());
  public function findById($id);

  public function insert(IShipping $shipping);
  public function delete($id);
}

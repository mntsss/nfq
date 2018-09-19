<?php

namespace App\Models\Interfaces;

use App\Models\Interfaces\IOrder;

interface IOrderMapper{

    public function findById($id);
    public function findAll(array $params = array());

    public function insert(IOrder $order);
    public function delete($id);

    public function paid($id);
    public function shipped($id);
    public function search(array $params = array());
}

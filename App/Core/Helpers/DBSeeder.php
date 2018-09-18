<?php

namespace App\Core\Helpers;

use App\Models\Interfaces\IOrderMapper;
use App\Models\Interfaces\IShippingMapper;
use App\Core\Database\IDatabase;
use App\Models\Order;
use App\Models\Shipping;

class DBSeeder
{
    protected $gateway;
    protected $shippingMapper;
    protected $orderMapper;

    function __construct(IDatabase $gateway, IShippingMapper $shippingMapper, IOrderMapper $orderMapper)
    {
        $this->gateway = $gateway;
        $this->shippingMapper = $shippingMapper;
        $this->orderMapper = $orderMapper;
    }

    public function load(){

    }


}

<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Mappers\OrderMapper;
use App\Models\Mappers\ShippingMapper;
use App\Core\Database\PDOGateway;
use App\Models\Order;
class IndexController extends Controller
{

    public function index(){
        $this->view("main");
    }
    public function orders(){
        $this->view("orders");
    }
}

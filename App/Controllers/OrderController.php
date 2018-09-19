<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Mappers\OrderMapper;
use App\Models\Mappers\ShippingMapper;
use App\Core\Database\PDOGateway;
use App\Models\Order;
use App\Models\Shipping;
use App\Core\Validator;
use App\Core\Request;
use App\Core\Helpers\DBSeeder;
class OrderController extends Controller
{

    function __construct()
    {
        // code...
    }

    public function create(Request $request){

      $filtered_params = Validator::filter($request->all());

      $errors = array();
      $errors = Validator::make("Vardas", $filtered_params['name'])->required()->max(50)->string()->validate();
      $errors = Validator::make("Adresas", $filtered_params['address'])->required()->max(50)->string()->validate();
      $errors = Validator::make("Miestas", $filtered_params['city'])->required()->min(3)->max(50)->string()->validate();
      $errors = Validator::make("Valstybė", $filtered_params['country'])->required()->max(30)->string()->validate();
      $errors = Validator::make("Pašto kodas", $filtered_params['post'])->required()->max(15)->string()->validate();
      $errors = Validator::make("Kiekis", $filtered_params['quantity'])->required()->validate();

      $errors = array_filter($errors);
      if(empty($errors)){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $shipping = $shippingMapper->insert(
            new Shipping(
                $filtered_params['address'],
                $filtered_params['city'],
                $filtered_params['country'],
                $filtered_params['post'])
                );
        if($shipping && is_int($shipping)){
          $order = $orderMapper->insert(
              new Order($filtered_params['name'],
                        $filtered_params['quantity'],
                        $shipping)
                    );
          $this->response(['message' => 'Order successfully created!'], 200);
          }
      }
      else
      {
          $this->response(['errors'=> $errors], 422);
      }
    }

    public function all(Request $request){
        $filtered_params = Validator::filter($request->all());

        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        if($filtered_params['searchQuery'] != null && $filtered_params['searchQuery'] != '')
        {
            $orders = $orderMapper->paginate($filtered_params['page'],$filtered_params['perPage'])->sort($filtered_params['sortBy'], $filtered_params['sortDirection'])->search(['client_name' => $filtered_params['searchQuery']]);
            $ordersCount = $orderMapper->count(['client_name' => $filtered_params['searchQuery']]);
        }
        else
        {
            $orders = $orderMapper->paginate($filtered_params['page'],$filtered_params['perPage'])->sort($filtered_params['sortBy'], $filtered_params['sortDirection'])->findAll();
            $ordersCount = $orderMapper->count();
        }
        $this->response(["orders" => $orders, "count" => $ordersCount], 200);
    }
    public function delete($params = []){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $orderMapper->delete($params[0]);
    }

    public function paid($params = []){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $orderMapper->paid((int)$params[0]);
        $this->response(null, 200);
    }

    public function shipped($params = []){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $orderMapper->shipped((int)$params[0]);
        $this->response(null, 200);
    }

    public function seed(){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $seeder = new DBSeeder($gateway, $shippingMapper, $orderMapper);

        $seeder->load(5);
    }
}

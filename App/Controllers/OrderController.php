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
class OrderController extends Controller
{

    function __construct()
    {
        // code...
    }

    public function create(Request $request){

      $filtered_params = Validator::filter($request->all());

      $errors = array();
      $errors = Validator::make("Name", $filtered_params['name'])->required()->max(50)->string()->validate();
      $errors = Validator::make("Address", $filtered_params['address'])->required()->max(50)->string()->validate();
      $errors = Validator::make("City", $filtered_params['city'])->required()->min(3)->max(50)->string()->validate();
      $errors = Validator::make("country", $filtered_params['country'])->required()->max(30)->string()->validate();
      $errors = Validator::make("Post code", $filtered_params['post'])->required()->max(15)->string()->validate();
      $errors = Validator::make("Quantity", $filtered_params['quantity'])->required()->validate();

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
        $orders = $orderMapper->paginate($filtered_params['page'],$filtered_params['perPage'])->sort($filtered_params['sortBy'], $filtered_params['sortDirection'])->findAll();
        $this->response($orders, 200);
    }
    public function delete($params = []){
        $gateway = new PDOGateway();
        $shippingMapper = new ShippingMapper($gateway);
        $orderMapper = new OrderMapper($gateway, $shippingMapper);
        $orderMapper->delete($params[0]);
    }
}

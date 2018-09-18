<?php

namespace App\Models\Mappers;

use App\Core\Database\IDatabase,
    App\Models\Interfaces\IOrder,
    App\Models\Interfaces\IOrderMapper,
    App\Models\Interfaces\IShippingMapper,
    App\Models\Order,
    App\Models\Shipping;
class OrderMapper extends BaseMapper implements IOrderMapper
{
    protected $dataTable = "orders";

    protected $shippingMapper;

    public function __construct(IDatabase $gateway, IShippingMapper $shippingMapper) {
        $this->shippingMapper = $shippingMapper;
        parent::__construct($gateway);
    }

    public function insert(IOrder $order) {
        $order->id = $this->gateway->insert($this->dataTable,
            array("client_name"   => $order->client_name,
                  "quantity" => $order->quantity,
                  "shipping_details_key" => $order->shipping_details_key,
                  "created_at" => $this->current_time
                  ));
        return $order->id;
    }

    public function delete($id) {
        $order = null;
        if ($id instanceof IOrder) {
            $order = $id;
            $id = $id->id;
        }else{
            $order = $this->findById($id);
        }
        $shipping_id = $order->shipping_details_key;
        $this->shippingMapper->delete($shipping_id);
        return $this->gateway->delete($this->dataTable, "id = $id");
    }
    // php side sorting, not used at the moment because sorting with mysql 

    // public function sortASC($sortBy, $secondaryFieldName = null){
    //   if(!$this->objectStore)
    //     throw new \RuntimeException("Objects store for sorting is empty!");
    //
    //   for($i = 0; $i < count($this->objectStore); $i++){
    //     for($j = $i; $j < count($this->objectStore); $j++){
    //       if($i == $j)
    //         continue;
    //       if($this->objectStore[$i]->{$sortBy} instanceof Shipping && !is_null($secondaryFieldName)){
    //         if($this->objectStore[$i]->{$sortBy}->{$secondaryFieldName} > $this->objectStore[$j]->{$sortBy}->{$secondaryFieldName}){
    //           $temp = $this->objectStore[$i];
    //           $this->objectStore[$i] = $this->objectStore[$j];
    //           $this->objectStore[$j] = $temp;
    //         }
    //       }
    //       else
    //       {
    //         if($this->objectStore[$i]->{$sortBy} >  $this->objectStore[$j]->{$sortBy}){
    //           $temp = $this->objectStore[$i];
    //           $this->objectStore[$i] = $this->objectStore[$j];
    //           $this->objectStore[$j] = $temp;
    //         }
    //       }
    //
    //     }
    //   }
    //   return $this->objectStore;
    // }

    public function paid($id){
      if( $id instanceof IOrder)
      {
        $id = $id->id;
      }
      return $this->gateway->update($this->dataTable, array("payment_received" => true, "payment_received_at" => $this->current_time), "id = $id");
    }

    public function shipped($id){
      if( $id instanceof IOrder)
      {
        $id = $id->id;
      }
      return $this->gateway->update($this->dataTable, array("order_shipped" => true, "shipped_at" => $this->current_time), "id = $id");
    }

    protected function mapObject(array $row) {
        return new Order($row["client_name"],
                         $row["quantity"],
                         $row["shipping_details_key"],
                         $row["payment_received"],
                         $row["order_shipped"],
                         $row["created_at"],
                         $row["shipped_at"],
                         $row["payment_received_at"],
                         $row["id"],
                         $this->shippingMapper->findById($row["shipping_details_key"])
                       );
    }
}

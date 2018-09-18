<?php
// Order model
namespace App\Models;

use App\Models\Interfaces\IOrder;
use App\Models\Interfaces\IShipping;
 class Order extends Model implements IOrder, \JsonSerializable
 {
     protected $id;
     protected $quantity;
     protected $client_name;
     protected $shipping_details_key;
     protected $payment_received;
     protected $order_shipped;
     protected $created_at;
     protected $shipped_at;
     protected $payment_received_at;
     protected $shipping_details;

     public function __construct(
       $client_name = null,
       $quantity = null,
       $shipping_details_key = null,
       $payment_received = null,
       $order_shipped = null,
       $created_at = null,
       $shipped_at = null,
       $payment_received_at = null,
       $id = null,
       $shipping_details = null
     ) {
         $this->setQuantity($quantity);
         $this->setClient_name($client_name);
         $this->setShipping_details_key($shipping_details_key);
         $this->setPayment_received($payment_received);
         $this->setOrder_shipped($order_shipped);
         $this->setCreated_at($created_at);
         $this->setShipped_at($shipped_at);
         $this->setPayment_received_at($payment_received_at);
         if($id) $this->setId($id);
         if($shipping_details) $this->setShipping_details($shipping_details);
     }

     public function jsonSerialize()
    {
        return get_object_vars($this);
    }

     public function setId($id) {
         if ($this->id !== null) {
             throw new \BadMethodCallException(
                 "The ID for this post has been set already to ".$this->id);
         }

         if (!is_int($id) || $id < 1 ) {
             throw new \InvalidArgumentException("The order ID is invalid: ".$this->id);
         }

         $this->id = $id;
         return $this;
     }
     public function getId(){
         return $this->id;
     }

     public function setQuantity($quantity){
         $this->quantity = $quantity;
         return $this;
     }
     public function getQuantity(){
         return $this->quantity;
     }

     public function setClient_name($client_name){
         $this->client_name = $client_name;
         return $this;
     }
     public function getClient_name(){
         return $this->client_name;
     }

     public function setShipping_details_key($shipping_details_key){
         $this->shipping_details_key = $shipping_details_key;
         return $this;
     }
     public function getShipping_details_key(){
         return $this->shipping_details_key;
     }

     public function setPayment_received($payment_received){
       $this->payment_received = $payment_received;
       return $this;
     }
     public function getPayment_received(){
       return $this->payment_received;
     }

     public function setOrder_shipped($order_shipped){
       $this->order_shipped = $order_shipped;
       return $this;
     }
     public function getOrder_shipped(){
       return $this->order_shipped = $order_shipped;
     }

     public function setCreated_at($created_at){
       $this->created_at = $created_at;
       return $this;
     }
     public function getCreated_at(){
       return $this->created_at;
     }

     public function setPayment_received_at($payment_received_at){
       $this->payment_received_at = $payment_received_at;
       return $this;
     }
     public function getPayment_received_at(){
       return $this->payment_received_at;
     }

     public function setShipped_at($shipped_at){
       $this->shipped_at = $shipped_at;
       return $this;
     }
     public function getShipped_at(){
       return $this->shipped_at;
     }
     public function setShipping_details($details){
        if(!$details instanceOf IShipping){
             throw new \InvalidArgumentException("Shipping details are invalid");
        }

        $this->shipping_details = $details;
        return $this;
     }
     public function getShipping_details(){
         return $this->shipping_details;
     }
 }

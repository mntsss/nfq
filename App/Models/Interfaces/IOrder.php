<?php

namespace App\Models\Interfaces;

/**
 *
 */
interface IOrder
{
    public function setId($id);
    public function getId();

    public function setQuantity($quantity);
    public function getQuantity();

    public function setClient_name($client_name);
    public function getClient_name();

    public function setShipping_details_key($shipping_details_key);
    public function getShipping_details_key();

    public function setPayment_received($payment_received);
    public function getPayment_received();

    public function setOrder_shipped($order_shipped);
    public function getOrder_shipped();

    public function setCreated_at($created_at);
    public function getCreated_at();

    public function setPayment_received_at($payment_received_at);
    public function getPayment_received_at();

    public function setShipped_at($shipped_at);
    public function getShipped_at();

    public function setShipping_details($details);
    public function getShipping_details();
}

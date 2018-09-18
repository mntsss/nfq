<?php
namespace App\Models\Mappers;

use App\Core\Database\IDatabase,
    App\Models\Interfaces\IShipping,
    App\Models\Interfaces\IShippingMapper,
    App\Models\Shipping;

class ShippingMapper extends BaseMapper implements IShippingMapper
{
  protected $dataTable = "shipping_details";

  function __construct(IDatabase $gateway)
  {
    parent::__construct($gateway);
  }

  public function insert(IShipping $shipping) {
      $shipping->id = $this->gateway->insert($this->dataTable,
          array("address"   => $shipping->address,
                "city" => $shipping->city,
                "country" => $shipping->country,
                "post_code" => $shipping->post_code
                ));
      return $shipping->id;
  }

  public function delete($id) {
      if ($id instanceof IShipping) {
          $id = $id->id;
      }
      return $this->gateway->delete($this->dataTable, "id = $id");
  }

  protected function mapObject(array $row) {
      return new Shipping($row["address"],
                       $row["city"],
                       $row["country"],
                       $row["post_code"],
                       $row["id"]
                     );
  }
}

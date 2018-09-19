<?php

namespace App\Core\Helpers;

use App\Models\Interfaces\IOrderMapper;
use App\Models\Interfaces\IShippingMapper;
use App\Core\Database\IDatabase;
use App\Models\Order;
use App\Models\Shipping;

class DBSeeder
{

    protected $names = ["Andrius", "Artūras", "Antanas", "Bronius", "Denas", "Donatas",
                        "Feliksas", "Gintaras", "Jonas", "Jaris", "Karolis",
                        "Lukas", "Mantas", "Martynas", "Nedas", "Oskaras", "Petras", "Rokas",
                         "Raimis", "Saulius", "Tautvydas", "Zigmas"];

    protected $surnames = ["Antaninis", "Andriuškevičius", "Brazauskas", "Brazdžionis", "Cyplius",
                            "Daunoravičius", "Darniūnas", "Felafelis", "Graičius", "Jurevičius",
                            "Jonaitis", "Kelmaitis", "Laukinis", "Laskys", "Muliarčikas", "Miškinis",
                            "Mitkus", "Petrauskas", "Saulėnas", "Televičius", "Vėžlys", "Žukauskas"];

    protected $streets = ["Apuolės g.", "Apgulties g.", "Akmenės g.", "Babtų g.", "Balos k.", "Brazausko g.",
                            "Dagių g.", "Dainavos g.", "Debesų g.", "Jonučių g.", "Jotvingių g.", "Kauno g.",
                            "Kangų g.", "Laurų g.", "Mindaugo pr.", "Geležinio vilko pr.", "Šiaulių g.", "Islandijos pl.",
                            "Žemaičių g.", "Pilies g.", "Pakraščio g.", "Tautos pr.", "Vytauto pr.", "Žuikio g."];

    protected $cities = ["Kaunas", "Vilnius", "Marijampolė", "Panevėžys", "Šiauliai", "Klaipėda", "Molėtai", "Vievis"];

    protected $gateway;
    protected $shippingMapper;
    protected $orderMapper;

    function __construct(IDatabase $gateway, IShippingMapper $shippingMapper, IOrderMapper $orderMapper)
    {
        $this->gateway = $gateway;
        $this->shippingMapper = $shippingMapper;
        $this->orderMapper = $orderMapper;
    }

    public function load($amount){
        for($i = 0; $i<$amount; $i++){

            $client = $this->gen_client();
            $address = $this->gen_address();
            $quantity = $this->gen_quantity();
            $city = $this->gen_city();
            $post_code = $this->gen_post_code();

            $shipping = $this->shippingMapper->insert(
                new Shipping($address, $city, "Lietuva", $post_code)
            );
            $this->orderMapper->insert(
                new Order($client, $quantity, $shipping)
            );
        }
    }

    public function gen_client(){
        $nameIndex = rand(0, count($this->names)-1);
        $surnameIndex = rand(0, count($this->surnames)-1);
        return $this->names[$nameIndex]." ".$this->surnames[$surnameIndex];
    }

    public function gen_address(){
        $streetIndex= rand(0, count($this->streets)-1);
        $houseNumber = rand(1, 350);
        return $this->streets[$streetIndex]." ".$houseNumber;
    }

    public function gen_quantity(){
        return rand(1, 100);
    }

    public function gen_city(){
        $cityIndex = rand(0, count($this->cities)-1);
        return $this->cities[$cityIndex];
    }

    public function gen_post_code(){
        return rand(30000, 49999);
    }





}

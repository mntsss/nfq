<?php
namespace App\Controllers;

class Controller
{
    protected function view($name){
        require_once(__DIR__."/../Views/".$name.".php");
    }
    protected function response($data, $status){
        http_response_code($status);
        echo json_encode($data);
    }
}

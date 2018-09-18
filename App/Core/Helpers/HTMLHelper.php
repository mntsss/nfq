<?php
namespace App\Core\Helpers;

class HTMLHelper
{

    function __construct(){}

    public static function input_field($label = "", $id = "", $name = "", $type = "", $placeholder = ""){
        $input =
            "<div class=\"form-group\">
                <label for=\"$id\">$label</label>
                <input type=\"$type\" class=\"form-control\" id=\"$id\" name=\"$name\" placeholder=\"$placeholder\">
            </div>";
        return $input;
    }
}

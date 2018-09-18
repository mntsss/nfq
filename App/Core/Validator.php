<?php
namespace App\Core;

class Validator
{
    public static $errors = array();

    public static $value;
    public static $name;

    private static $instance = null;

    private function __construct(){}

    public static function make($name, $value){
        if(self::$instance === null)
            self::$instance = new self;

        self::$name = ucfirst($name);
        self::$value = $value;
        return self::$instance;
    }

    public static function filter(array $params){
        $escape_characters = array( '\'', '"', '/', ';', '<', '>' );
        $filtered_params = array();
        foreach($params as $key=>$value){
            $value = strip_tags($value);
            $value = str_replace( $escape_characters, '', $value);
            $filtered_params[$key] = $value;
        }
        return $filtered_params;
    }

    public function min($min){
        if(strlen(self::$value) < $min)
            self::$errors[] = self::$name." is too short, minimum length should be ".$min." symbols.";
        return $this;
    }

    public function max($max){
        if(strlen(self::$value) > $max)
            self::$errors[] = self::$name." is too long, maximum length should be ".$max." symbols.";
        return $this;
    }

    public function string(){
        if(!is_string(self::$value))
            self::$errors[] = self::$name." given in incorrent format, expected a string";
        return $this;
    }

    public function required(){
        if(self::$value == null || self::$value == "" || self::$value == "null"){
            self::$errors[] = self::$name." is required.";
        }
        return $this;
    }
    public function validate(){
        return self::$errors;
    }
}

<?php
// Base Model class
namespace App\Models;

abstract class Model
{
    public function __set($name, $value) {
        $field = strtolower($name);

        if (!property_exists($this, $field))
          print_r("Error setting a value for an object field.", 0);

        $mutator = "set" . ucfirst(strtolower($name));
        if (method_exists($this, $mutator) &&
            is_callable(array($this, $mutator))) {
            $this->$mutator($value);
        }
        else {
            $this->$field = $value;
        }

        return $this;
    }

    public function __get($name) {
        $field = strtolower($name);

        if (!property_exists($this, $field))
            print_r("Error getting a value of an object field.", 0);

        $accessor = "get" . ucfirst(strtolower($name));
        return (method_exists($this, $accessor) &&
            is_callable(array($this, $accessor)))
            ? $this->$accessor() : $this->field;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}

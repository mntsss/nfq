<?php

class Autoloader{
    public function register(){
        spl_autoload_register(function($class){
            $file = $class.'.php';

            if(file_exists($file))
            require($file);
        });
    }
}

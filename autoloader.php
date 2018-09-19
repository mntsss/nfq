<?php
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);

class Autoloader{
    public function register(){
        spl_autoload_register(function($class){
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            $file = ROOT_PATH . $path.'.php';

            if(file_exists($file))
                require($file);
        });
    }
}

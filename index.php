<?php

require_once __DIR__."/autoloader.php";

date_default_timezone_set("Europe/Vilnius");

// registering autoloader
$autoloader = new Autoloader();
$autoloader->register();

// loading routes
require_once __DIR__."/App/Routes/web.php";

?>

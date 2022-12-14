<?php
// autoloader
spl_autoload_register(function($className){
    include "classes/" .$className. ".class.php";
});

// database details
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","bankSystem");
<?php

    
    //DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_NAME', 'gnice');
    //app Root
    define('APP_ROOT',dirname(dirname(__FILE__)));
    //URL Root
    define("FOLDER","gnice");
    define('APP_URL', 'http://'.$_SERVER['HTTP_HOST'].'/'.FOLDER);
    
    //site Name 
    define('SITENAME', 'gnice');
    
    //APP version
    define('APP_VERSION', '1.0.0');

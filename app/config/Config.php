<?php

    //DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');//////CHANGE TO YOUR DB NAME
    define('DB_PASS', 'root');//////CHANGE YOUR DB PASS
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
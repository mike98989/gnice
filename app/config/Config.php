<?php
//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); //////CHANGE TO YOUR DB NAME
define('DB_PASS', ''); //////CHANGE YOUR DB PASS
define('DB_NAME', 'gnice');
define('PAYSTACK_SECRETE_KEY', 'sk_test_169769c2c9e54f64f0a4c59a30289aa8281b7247');
define('SENDINBLUE_API_KEY', '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');
//REMOTE DB
// define('DB_USER', 'gnicecom_root');//////CHANGE TO YOUR DB NAME
// define('DB_PASS', 'admin99yu76');//////CHANGE YOUR DB PASS
// define('DB_NAME', 'gnicecom_cart');

//app Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('APP_NAME', 'GNICE Market Place');
define('APP_DESCRIPTION', 'Gnice - Market place for every one. Your #1 online flexible shopping arena');
define('APP_KEYWORD', 'Gnice, Market, Online Store, Shopping App Stor, Nigerian Mall, Shopping Mall, Online payment, Online Market, B2C, Seller Account');
define('UPLOAD_SIZE_PROFILE_IMG', 4);
define('UPLOAD_SIZE_PRODUCT_IMG', 5);
//URL Root
define("FOLDER", "gnice");
//define('APP_URL', 'https://' . $_SERVER['HTTP_HOST']);
define('APP_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . FOLDER);

//site Name 
define('SITENAME', 'gnice');

//APP version
define('APP_VERSION', '1.0.0');
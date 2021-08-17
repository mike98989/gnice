<?php

class Controller
{
    //load model
    function __construct() {
		$url=$_SERVER['REQUEST_URI'];
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->url = $url;
		$this->view = new View();
	}
    
    public function model($model)
    {
        // require model file
        require_once './app/models/' . $model . '.php';
        // Instantiate model
        return new $model();
    }

    // //load view
    // public function view($view, $include_header, $data = [], $type, $js)
    // {
    //     //check for view file
    //     //print_r($_SESSION);exit;
        
    //     if (file_exists('../app/Views/' . $view . '.html')) {
    //         if(!isset($_SESSION)){
    //         if ($include_header == true) {
    //             require('../app/Views/inc/header' . $type . '.php');
    //         }
    //         require_once '../app/Views/' . $view . '.html';
    //         if ($include_header == true) {
    //             if ($type == '_type3') {
    //                 require('../app/Views/inc/footer1.php');
    //             } else {
    //                 require('../app/Views/inc/footer.php');
    //             }
    //         }
    //     }else{
    //         if(($_SESSION['loggedIn']==true)&&($_SESSION['loggedType']=='admin')){
    //             require('../app/Views/Admin/inc/headerref.php');
    //             require('../app/Views/Admin/inc/header.php');
    //             require('../app/Views/Admin/inc/sidenav.php');
    //             require_once '../app/Views/' . $view . '.html';
    //             require('../app/Views/Admin/inc/footerref.php');
    //         }

    //     }
    //     } else {
    //         //view does not exist
    //         include_once "../app/Views/404.html";
    //         // die('view does not exist');
    //     }
    // }
}

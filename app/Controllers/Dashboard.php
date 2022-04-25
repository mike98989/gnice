<?php
class Dashboard extends Controller
{

  function __construct() {
    parent::__construct();
    $query =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    Session::init();
    if (!Session::get('loggedIn')) {
			Session::destroy();
			header('location:'.APP_URL.'/Login?redirectTo='.$_GET['url'].'&'.$query);
			exit;
		}
  }
  
  public function index()
  {
    $data = [];
    //$this->view->js = ['controllers/web/headerController.js','controllers/web/homeController.js','controllers/web/productController.js'];
    $this->view->render('User/Dashboard', false,'');
  }
}

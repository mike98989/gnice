<?php
class Dashboard extends Controller
{
  function __construct() {
    parent::__construct();
    Session::init();
    if (!Session::get('loggedIn')) {
			Session::destroy();
			header('location:'.APP_URL.'/Login');
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

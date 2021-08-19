<?php
class Dashboard extends Controller
{
  function __construct() {
    parent::__construct();
    Session::init();
    if (!Session::get('loggedIn')) {
			Session::destroy();
			header('location:./Login');
			exit;
		}
  }
  
  public function index()
  {
    $data = [];
    $this->view->js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
    $this->view->render('Seller/Dashboard', false,'');
  }
}

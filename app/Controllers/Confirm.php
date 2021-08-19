

<?php

class Confirm extends Controller{

  
  function __construct() {
    parent::__construct();
  Session::init();
  }

     public function index(){
        $data = [];
        $this->view->js = ['controllers/signupController.js', 'controllers/web/homeController.js'];
        $this->view->render('Account/confirm',false,'');
    }
}
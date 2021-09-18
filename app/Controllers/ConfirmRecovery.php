<?php

class ConfirmRecovery extends Controller{

    
    function __construct() {
        parent::__construct();
		Session::init();
	}
    
     public function index(){
        $data = [];
        $this->view->js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view->render('Account/confirmRecovery',false,'');
    }
}
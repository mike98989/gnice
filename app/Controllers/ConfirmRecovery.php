<?php

class ConfirmRecovery extends Controller{

    
    function __construct() {
        parent::__construct();
		Session::init();
	}
    
     public function index(){
        $data = [];
         $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Account/confirmRecovery',$include_header=true,$data,'_type1',$js);
    }
}
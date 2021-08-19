<?php

class Product extends Controller {

    function __construct() {
        parent::__construct();
		Session::init();
	}
    public function index(){
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        $this->view->render('Product/product',false,'');
    }

    public function details($url){ 
        //$url = $this->getUrl();
        print_r($url);exit;
    }
}

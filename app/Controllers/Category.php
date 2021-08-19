<?php

class Category extends Controller
{
    
    function __construct() {
        parent::__construct();
		Session::init();
	}
    
    public function index()
    {
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        $this->view->render('Category/index', true, '');
    }

    public function details($url)
    {
        //$url = $this->getUrl();
        print_r($url);
        exit;
    }
}

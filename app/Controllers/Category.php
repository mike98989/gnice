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
        $this->view->render('Category/index', false, '');
    }

    public function sub_category()
    {
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        $this->view->render('Category/sub_category', false, '');
    }

}

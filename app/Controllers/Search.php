<?php

class Search extends Controller
{
    
    function __construct() {
        parent::__construct();
		Session::init();
	}
    
    public function index()
    {
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        $this->view->render('Home/search', false, '');
    }


}

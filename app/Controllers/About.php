<?php


class About extends Controller{
   

    public function index(){
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        $this->view->render('Home/about',false,'');
    }
}
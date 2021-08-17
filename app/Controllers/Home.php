<?php


class Home extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view->render('Home/index','','');
    }
}
<?php


class Home extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Home/index',$include_header=true,$data,'_type2', $js);
    }
}
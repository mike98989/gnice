<?php


class About extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Home/about',$include_header=true,$data,'_type2', $js);
    }
}
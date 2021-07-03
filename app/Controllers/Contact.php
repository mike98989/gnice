<?php


class Contact extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Home/contact',$include_header=true,$data,'_type2', $js);
    }
}
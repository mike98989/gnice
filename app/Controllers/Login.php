<?php


class Login extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Account/login',$include_header=true,$data,'_type1',$js);
    }
}
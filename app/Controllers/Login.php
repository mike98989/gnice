<?php


class Login extends Controller{
   

    public function index(){
        $data = [];
        $js = [];
        $this->view('Account/login',$include_header=true,$data,'_type1',$js);
    }
}
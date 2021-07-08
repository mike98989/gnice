<?php

class Signup extends Controller{

     public function index(){
        $data = [];
        $js = ['controllers/signupController.js'];
        $this->view('Account/signup',$include_header=true,$data,'_type1',$js);
    }
}
<?php


class Recovery extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/loginController.js'];
        $this->view('Account/recovery',$include_header=true,$data,'_type1',$js);
    }
}
<?php


class Contact extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/web/homeController.js'];
        $this->view('Contact/index',$include_header=true,$data,'_type1', $js);
    }
}
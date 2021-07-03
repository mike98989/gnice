<?php


class AddProduct extends Controller{
   

    public function index(){
        $data = [];
       $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Seller/index',$include_header=true,$data,'_type3', $js);
    }
}
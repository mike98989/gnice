<?php


class Statistics extends Controller{
   

    public function index(){
        $data = [];
     $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Seller/statistics',$include_header=true,$data,'_type4', $js);
    }
}
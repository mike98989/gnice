<?php


class Notification extends Controller{
   

    public function index(){
        $data = [];
      $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Seller/notification',$include_header=true,$data,'_type4', $js);
    }
}
<?php
class Dashboard extends Controller{
    public function index(){
        $data = [];
      $js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view('Seller/Dashboard',$include_header=true,$data,'_type4', $js);
    }
}
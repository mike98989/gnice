<?php



class Admin extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/admindashboard/homeController.js'];
        $this->view('Admin/dashboard',$include_header=true,$data,'_type1', $js);
    }
}
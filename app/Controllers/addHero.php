<?php



class addHero extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/admindashboard/homeController.js'];
        $this->view('Admin/add_hero',$include_header=true,$data,'_type1', $js);
    }
}
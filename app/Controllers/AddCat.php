<?php



class AddCat extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/admindashboard/homeController.js'];
        $this->view('Admin/add_cat',$include_header=true,$data,'_type1', $js);
    }
}
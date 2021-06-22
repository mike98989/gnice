<?php



class SubCat extends Controller{
   

    public function index(){
        $data = [];
        $js = ['controllers/admindashboard/homeController.js'];
        $this->view('Admin/sub_cat',$include_header=true,$data,'_type1', $js);
    }
}
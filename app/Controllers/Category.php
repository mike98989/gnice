<?php

class Category extends Controller {
     public function index(){
        $data = [];
         $js = ['controllers/web/homeController.js'];
        $this->view('Category/category',$include_header=true,$data,'_type1',$js);
    }

    public function details($url){
        //$url = $this->getUrl();
        print_r($url);exit;
    }
}

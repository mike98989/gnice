<?php

class CategoryList extends Controller {
     public function index(){
        $data = [];
        $this->view->js = ['controllers/web/homeController.js'];
        //$this->view('Category/category',$include_header=true,$data,'_type1',$js);
        $this->view->render('Category/category', true, '');
    }

}

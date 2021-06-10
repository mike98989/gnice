<?php


class _404 extends Controller{
   

    public function index(){
        $data = [];
        $js = [];
        $this->view('404',$include_header=false, $data,'', $js);
    }
}
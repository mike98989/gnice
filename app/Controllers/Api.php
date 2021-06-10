<?php

class Api extends Controller{
    private $msg;
    public function __construct() {
        // $header = apache_request_headers(); 
        // if(!isset($header['gnice-Authenticate'])){

        //}
    }
    public function signUpApi(){
        //$this->
        $signup = $this->model('Authenticated')->signup();
    }
    public function create_category(){

    }
    public function fetch_all_category(){
       $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Category')->getAllCategory();
            print_r(json_encode($result));
            var_dump($result);

       }else{
            print_r('not authorised');
            exit;	
        }
    }
}

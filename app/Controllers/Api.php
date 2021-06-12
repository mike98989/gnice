<?php

class Api extends Controller{
    public function signUpApi(){
        //$this->
        $signup = $this->model('Authenticated')->signup();
    }

    public function fetch_all_category(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Category')->getAllCategory();
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;	
        }
    }

    public function create_category(){
        $header = apache_request_headers();
        if(isset($header['gnice-Authenticate'])){
            
        }
    }
}

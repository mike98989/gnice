<?php

class AdminLogin extends Controller{
    // public function __construct(){
    //     $this->auth = $this->model('Authenticate');
    // }
   public function index(){
     $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            
            $result = $this->model('Authenticate')->adminLogin();
            print_r($result);
        }
        $data = [];
        $js = ['controllers/loginController.js'];
        $this->view('Admin/login',$include_header=false,$data,'_type1',$js);
    }

    // public function login(){
    //     $header = apache_request_headers();
    //     if (isset($header['gnice-authenticate'])) {
    //         echo 'invalid request';
    //         $result = $this->model('Authenticate')->adminLogin();
    //         print_r(json_encode($result));
    //     }
    // }
}


?>
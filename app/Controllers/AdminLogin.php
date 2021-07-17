<?php

header('Content-type: application/json');
class AdminLogin extends Controller{
    public function __construct(){
    
        if(isset($_SESSION['isLoggedIn']) || $_SESSION['type'] === 'admin' ){
            redirect('admin/dashboard');
        }
    }
   public function index(){
    //    print_r($_SESSION);
    }
    
    public function login(){
        $result = $this->model('Authenticate')->adminLogin();
        print_r(json_encode($_SESSION));
        // redirect('admin/dashboad');
    }
}


?>
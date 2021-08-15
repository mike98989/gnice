<?php

class Credentials extends Controller{

   public function createUserSession(){

         $user = $_GET;

        $_SESSION['user_id'] = $_GET['id'];
        $_SESSION['user_email'] = $_GET['email'];
        $_SESSION['user_name'] = $_GET['name'];
        var_dump($_GET);
   
}

    // logout user
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['token']);
        session_destroy();
        // redirect('users/login');
    }
 
}

<?php

class Api extends Controller{
    public function signUpApi(){
        //$this->
        $signup = $this->model('Authenticated')->signup();
    }
    /**
     * Product apis
     */
     public function fetch_all_product(){

         $header = apache_request_headers(); 
         if(isset($header['gnice-Authenticate'])){
             $result = $this->model('Product')->getAllProducts();
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }
    public function fetch_single_product(){

         $header = apache_request_headers(); 
         if(isset($header['gnice-Authenticate'])){
             $result = $this->model('Product')->getSingleProducts();
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

    public function add_product(){
        $header = apache_request_headers();
        if(isset($header['gnice-Authenticate'])){
            $this->model('Product')->addProduct();
            
        }else{
            echo 'invalid response';
            exit;
        }

    }

     /**
     * Hero apis
     */
     public function fetch_all_hero(){

         $header = apache_request_headers(); 
         if(isset($header['gnice-Authenticate'])){
             $result = $this->model('Hero')->getAllHero();
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

    /**
     * Banner apis
     */

    public function fetch_all_banners(){

         $header = apache_request_headers(); 
         if(isset($header['gnice-Authenticate'])){
             $result = $this->model('Banner')->getAllBanner();
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

    public function add_banner(){
        $header = apache_request_headers();
       
        if(isset($header['gnice-Authenticate'])){
            
            $this->model('Banner')->addBanner();
            
        }else{
            echo 'invalid response';
            exit;
        }
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

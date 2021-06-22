<?php
header('Access-Control-Allow-Origin: *');

class Api extends Controller{
    public function index(){

    }
    public function signUpApi(){
        //$this->
        $signup = $this->model('Authenticated')->signup();
    }

    public function user_login(){
        $header = apache_request_headers(); 
         if(isset($header['gnice-Authenticate'])){
        $login = $this->model('Authenticate')->login($_POST['username'], $_POST['password']);
        print_r(json_encode($login));
        }else {
        echo "invalid request";
       exit;
        }
    }

    /**
     * Product apis
     */
     public function fetch_all_product(){
         $header = apache_request_headers(); 
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getAllProducts();
            header('Content-Type: application/json');
            print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

    public function fetch_single_product(){
       
$form_data = json_decode(file_get_contents("php://input"));

     
        
         $header = apache_request_headers(); 
          $form_data = json_decode(file_get_contents("php://input"));
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getSingleProduct($form_data);
               header('Content-Type: application/json');
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
         
    }

    public function update_user_account_type(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Authenticate')->updateUserAccountType();
            print_r(json_encode($result));
        }else {
            echo "invalid request";
           exit;
        }
   }
    

    public function add_product(){
        $header = apache_request_headers();
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->addProduct();
             print_r(json_encode($result));
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
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Category')->getAllCategory();
             header('Content-Type: application/json');
            print_r(json_encode($result));
             }else{
            echo "invalid request";
            exit;   
        }
            
            

    }



    public function fetch_all_test_category(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Category')->testCategory();
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

     public function fetch_all_sub_category(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Category')->getAllSubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;	
        }
    }
    public function fetch_most_view_product(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->mostViewedProduct();
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;	
        }
    }
     public function fetch_products_by_rating(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->productRating();
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;	
        }
    }
    public function fetch_all_wishlist(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->wishLists();
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;	
        }

    }

    //add a product to cart
    public function add_product_to_cart(){
         $header = apache_request_headers();
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->addProductToCart();
             print_r(json_encode($result));
        }else{
            echo 'invalid response';
            exit;
        }
    }
    public function fetch_all_product_cart(){
         $header = apache_request_headers();
        if(isset($header['gnice-Authenticate'])){
            $result = $this->model('Product')->getAllProductCart();
             print_r(json_encode($result));
        }else{
            echo 'invalid response';
            exit;
        }
    } 
}

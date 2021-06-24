<?php
header('Access-Control-Allow-Origin: *');

class Api extends Controller
{
    public function index()
    {
    }
    public function user_signup()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $signup = $this->model('Authenticate')->signup();
             header('Content-Type: application/json'); 
            print_r(json_encode($signup));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function user_login()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->login($_POST['username'], $_POST['password']);
            header('Content-Type: application/json'); 
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function confirm_user_signup()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->confirm_user_signup($_POST['email'], $_POST['confirm_code']);
             header('Content-Type: application/json'); 
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }

      public function password_recovery()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->password_recovery();
             header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


  public function confirm_password_recovery_code()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->confirm_password_recovery_code();
            header('Content-Type: application/json');
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;

        }
    }


/*
  

  

    
     //////////////////////////// Product apis
     
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
        public function fetch_related_product(){
           
         $form_data = json_decode(file_get_contents("php://input"));
         $id = $form_data->coid;
          $sub = $form_data->subid;
         $cat = $form_data->cid;
         $header = apache_request_headers(); 
         
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getrelatedProduct($id,$cat,$sub);
               header('Content-Type: application/json');
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         } 
         
    }
    

        public function fetch_selected_product(){
         $form_data = json_decode(file_get_contents("php://input"));
         $header = apache_request_headers(); 
          $form_data = json_decode(file_get_contents("php://input"));
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getSelectedProduct($form_data);
               header('Content-Type: application/json');
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

         public function fetch_feature_product(){
         $form_data = json_decode(file_get_contents("php://input"));
         $sub = $form_data->subid;
         $cat = $form_data->cid;
         $header = apache_request_headers(); 

          $form_data = json_decode(file_get_contents("php://input"));
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getFeatureProduct($cat, $sub);
               header('Content-Type: application/json');
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getSingleProduct($id);

             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
         }
    }

    public function update_user_account_type(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Authenticate')->updateUserAccountType();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function password_recovery()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->password_recovery();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function add_product()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->addProduct();
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }

    
     // Hero apis
     
    public function fetch_all_hero()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Hero')->getAllHero();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    
      //Banner apis
    

    public function fetch_all_banners()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Banner')->getAllBanner();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function add_banner()
    {
        $header = apache_request_headers();

        if (isset($header['gnice-authenticate'])) {

            $this->model('Banner')->addBanner();
        } else {
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
    public function fetch_all_categories_and_sub_categories(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Category')->getAllCategoriesAndSubCategories();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
            
            

    }




    public function fetch_all_product_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllProductOfaCategory($_GET['id']);

            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_all_product_sub_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllProductOfaSubCategory($_GET['id']);
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_product_by_term()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->searchForProduct();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function create_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
        }
    }


   
    public function fetch_all_sub_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllSubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


      public function fetch_selected_sub_category(){
        $form_data = json_decode(file_get_contents("php://input"));
               
        $header = apache_request_headers(); 
        if(isset($header['gnice-authenticate'])){
            $result = $this->model('Category')->getSelectedCategory($form_data);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        }else{
            echo "invalid request";
            exit;   
        }
        
    }

    
  
    public function fetch_most_view_product()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $result = $this->model('Product')->mostViewedProduct();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_products_by_rating()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->productRating();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function fetch_related_products()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllRelatedProducts();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function fetch_all_wishlist()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->wishLists();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    //add a product to cart
    public function add_product_to_cart()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->addProductToCart();
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function fetch_all_product_cart()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllProductCart();
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    */
}

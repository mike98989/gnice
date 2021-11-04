<?php
header('Access-Control-Allow-Origin: *');

class Api extends Controller
{

    public function user_signup()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        $header = array_change_key_case($header,CASE_LOWER);

        if (isset($header['gnice-authenticate'])) {
            $signup = $this->model('Authenticate')->signup();
            print_r(json_encode($signup));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function user_login()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->login($_POST['username'], $_POST['password']);
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function admin_login()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->loginAdmin();
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function confirm_user_signup()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->confirm_user_signup($_POST['email'], $_POST['confirm_code']);
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function find_user_by_email()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $check = $this->model('Authenticate')->findUserByEmail($_GET['email'], 'users');
            print_r(json_encode($check));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function user_login_from_facebook()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->user_login_from_facebook();
            print_r(json_encode($login));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function confirm_password_recovery_code()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $login = $this->model('Authenticate')->confirm_password_recovery_code();
            print_r(json_encode($login));
        } else {
            echo 'invalid request';
            exit;
        }
    }

    public function change_password()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $change = $this->model('Authenticate')->change_password();
            print_r(json_encode($change));
        } else {
            echo 'invalid request';
            exit;
        }
    }

    public function deleteCategory()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->deleteCategory($_GET['id']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }


    public function deleteProduct()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Product')->deleteProduct($_GET['product_id'],$_GET['seller_id']);
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function disableEnableProduct()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Product')->disableEnableProduct($_GET['product_id'],$_GET['seller_id'],$_GET['value']);
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function updateCategory()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->updateCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function add_category()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->addCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }

    public function add_subcategory()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->addSubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }

    public function updatesubCategory()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->updatesubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }


    public function deletesubCategory()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->deletesubCategory($_GET['id']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }







    public function fetch_all_categories_and_sub_categories()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllCategoriesAndSubCategories();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function fetch_all_category()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

     public function fetch_report_reasons()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Misc')->getAllReportReasons();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    
    public function fetch_all_sub_category()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllSubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function fetch_all_sub_category_from_parent()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllSubCategoryFromParent($_GET['parent_id']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }
    

    public function add_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
            $result = $this->model('Product')->addProduct();
            }else{
            $result['status']='0';
            $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit();
        }
    }

    public function report_abuse()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
            $result = $this->model('Product')->reportAbuse();
            }else{
            $result['status']='0';
            $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit();
        }
    }

    /**
     * Product apis
     */
    public function save_product_review()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->saveProductReview();
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit();
        }
    }

    
    public function fetch_latest_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getLatestProducts();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function fetch_trending_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getTrendingProducts();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function get_product_reviews()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getProductReviews();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    
    public function fetch_all_product_of_seller()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            //$token = filter_var($header['gnice-authenticate']);
            //$result = $this->model('Authenticate')->verifyToken($token,'users');
            //if($result){
                $result = $this->model('Product')->getAllProductOfASeller($_GET['seller_id']);
            // }else{
            //     $result['status']='0';
            //     $result['msg']='Invalid token';
            // }
            print_r(json_encode($result));
            
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function fetch_all_user_transactions()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Authenticate')->getAllUserTransactions();
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function fetch_all_user_saved_products()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Product')->getAllUserSavedProducts($result->id);
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function pin_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Product')->pinProduct($result->id);
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    

    public function fetch_single_product(){
         $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER); 
         if(isset($header['gnice-authenticate'])){
             $result = $this->model('Product')->getSingleProduct($_GET['id']);
             print_r(json_encode($result));
         }else {
             echo "invalid request";
            exit;
        }
    }

    public function update_user_account_type()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->updateUserAccountType();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function get_account_packages()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        $result = $this->model('Misc')->getAccountPackages();
        print_r(json_encode($result));
    }


    public function update_user_profile()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->updateUserData();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function generate_paystack_checkout()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->generate_paystack_checkout();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function verify_transaction()
    {
        $result = $this->model('Authenticate')->verify_transaction();
        //print_r(json_encode($result));

    }

    public function fetch_transaction_by_reference()
    {
       $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->fetch_transaction_by_reference();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }

    }

    

    public function password_recovery()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->password_recovery();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function resend_confirmation_code()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->generateConfirmationCode();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }



    // Hero apis

    // public function fetch_all_hero()
    // {
    //     $header = apache_request_headers();
        //$header = array_change_key_case($header,CASE_LOWER);
    //     if (isset($header['gnice-authenticate'])) {
    //         $result = $this->model('Hero')->getAllHero();
    //         print_r(json_encode($result));
    //     } else {
    //         echo "invalid request";
    //         exit;
    //     }
    // }

    //Banner apis
    public function fetch_all_banners()
    {

        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);

        if (isset($header['gnice-authenticate'])) {

            $this->model('Banner')->addBanner();
        } else {
            echo 'invalid response';
            exit;
        }
    }


    public function fetch_required_table()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Category')->getAllRequiredTables();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }


    public function fetch_all_product_category()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->searchForProduct();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    
    public function return_plain(){
        return;
    }

    public function message_product_seller()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->messageProductSeller();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function fetch_all_messages_to_seller()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->getAllMessagesToSeller($_GET['seller_id']);
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_all_messages()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->getAllMessages();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function update_profile()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Authenticate')->updateUserProfile();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function update_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
            $result = $this->model('Product')->updateProduct();
            }else{
            $result['status']='0';
            $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
            } else {
            echo "invalid request";
            exit;
        }
    }
    public function upload_product_image()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Product')->uploadImages();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function delete_image()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // exit('got here');
            $result = $this->model('Profile')->deleteImage($_GET['product_code']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function deleteProductImage()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $result = $this->model('Authenticate')->verifyToken($token,'users');
            if($result){
                $result = $this->model('Product')->deleteProductImage();
            }else{
                $result['status']='0';
                $result['msg']='Invalid token';
            }
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function upload_image(){
         $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Authenticate')->uploadProfileImage();
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }


    public function create_category()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
        }
    }



    public function fetch_most_view_product()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->productRating();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function submit_newsletter()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Misc')->saveNewsletter();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function fetch_related_products()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllRelatedProducts();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }

    public function fetch_top_rated_products()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllTopRatedProducts();
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    

    public function fetch_all_wishlist()
    {
        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);
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
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Product')->getAllProductCart();
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
}

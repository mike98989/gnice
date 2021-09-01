<?php
// header('Access-Control-Allow-Origin: *');

class AdminApi extends Controller
{
    public function index()
    {
        // $data = [];
        // $this->view->js = ['public/assets/js/controllers/admindashboard/homeController.js', 'public/assets/js/controllers/admindashboard/usersController.js'];
        // $this->view->render('Admin/gnice_dashboard', false, '');
    }

    public function get_all_users()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // echo 'mhere';
            $result = $this->model('Admintasks')->getAllUsers();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function get_all_admins()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->getAllAdminAccounts();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function get_all_cat_and_sub_cat()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->getAllCategoriesAndSubCategories();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function get_all_products()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->getAllProducts();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function add_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->addCategory($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function update_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->updateCategory($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function disable_enable_account()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->disableEnableUser($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function disable_enable_ads()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->disableEnableAds($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_all_product_of_seller()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('AdminTasks')->getAllProductOfASeller($_GET['seller_id']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }
    public function updateCategory()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->updateCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    // public function add_category()
    // {
    //     $header = apache_request_headers();
    //     if (isset($header['gnice-authenticate'])) {
    //         $result = $this->model('category')->addCategory();
    //         header('Content-Type: application/json');
    //         print_r(json_encode($result));
    //     } else {
    //         echo 'invalid response';
    //         exit;
    //     }
    // }

    public function add_subcategory()
    {
        $header = apache_request_headers();
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
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('category')->deletesubCategory($_GET['id']);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }
    public function get_account_packages()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $header = apache_request_headers();
            $result = $this->model('AdminTasks')->getAccountPackages();
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }
    public function fetch_all_transactions()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('AdminTasks')->getAllTransactions();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request';
            exit();
        }
    }

    public function delete_user_account_and_ads()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('AdminTasks')->deleteUserAccount();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid request api';
            exit();
        }
    }
}
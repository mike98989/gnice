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

    public function home_statistics()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->homeStatistics();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function fetch_all_banners()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->fetchAllBanner();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function create_new_banner()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // print_r($_FILES);
            // die;
            $result = $this->model('Admintasks')->createNewBanner();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
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
    public function add_sub_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->addSubCategory($_POST);
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
    public function disable_enable_admin_account()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->disableEnableAdmin($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function toggle_package_status()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->togglePackageStatus($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function toggle_package_content_status()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->togglePackageContentStatus($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo "invalid request";
            exit;
        }
    }
    public function disable_enable_sub_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('Admintasks')->disableEnableSubCategory($_POST);
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


    public function update_sub_category()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // print_r($_POST);
            // die();
            $result = $this->model('AdminTasks')->updateSubCategory();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function update_package_content()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('AdminTasks')->updatePackageContents();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function update_admin_privilege()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $result = $this->model('AdminTasks')->updateAdminPrivilege();
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function update_package()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            // print_r(json_encode("got"));
            // die();
            $result = $this->model('AdminTasks')->updatePackage($_POST);
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
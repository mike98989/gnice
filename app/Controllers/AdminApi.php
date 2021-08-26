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
}
<?php

// header('Content-type: application/json');
class AdminAuth extends Controller
{
    // public function __construct()
    // {
    //     if (isset($_SESSION['isLoggedIn']) && $_SESSION['type'] === 'admin') {
    //         redirect('admin/gnice_dashboard', true, 303);
    //     }
    // }
    public function index()
    {
        $data = [];
        $this->view->js = ['controllers/loginController.js'];
        $this->view->render('Admin/gnice_login', true, '');
    }

    public function login_admin()
    {
        $data = [];
        $js = [];
        $result = $this->model('Authenticate')->loginAdmin();
        // print_r(json_encode($_SESSION));
        // redirect('admin/dashboad');
    }

    // public function signup_admin()
    // {
    //     $result = $this->model('Authenticate')->registerAdmin();
    //     print_r(json_encode($_SESSION));
    // }
    public function create_new_admin_admin()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            // print_r($_POST);
            // die();
            $result = $this->model('AdminTasks')->createAdminAccount($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function change_admin_password()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // die;
            $result = $this->model('AdminTasks')->changeAdminPassword($_POST);
            header('Content-Type: application/json');
            print_r(json_encode($result));
        } else {
            echo 'invalid response';
            exit;
        }
    }
    public function send_admin_reset_code()
    {
        $result = $this->model('Authenticate')->generatePasswordResetCode();
        print_r(json_encode($result));
    }
}
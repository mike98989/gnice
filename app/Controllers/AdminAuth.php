<?php

header('Content-type: application/json');
class AdminLogin extends Controller
{
    public function __construct()
    {

        // if (isset($_SESSION['isLoggedIn']) && $_SESSION['type'] === 'admin') {
        //     redirect('admin/dashboard', true, 303);
        // }
    }
    public function index()
    {
        $data = [];
        $js = [];
        $this->view('Admin/login', $include_header = false, $data, '_type4', $js);
    }

    public function login_admin()
    {
        $result = $this->model('Authenticate')->loginAdmin();
        // print_r(json_encode($_SESSION));
        // redirect('admin/dashboad');
    }

    public function signup_admin()
    {
        $result = $this->model('Authenticate')->registerAdmin();
        print_r(json_encode($_SESSION));
    }
    public function change_admin_password()
    {
        $result = $this->model('Authenticate')->changeAdminPassword();
        print_r(json_encode($result));
    }
    public function send_admin_reset_code()
    {
        $result = $this->model('Authenticate')->generatePasswordResetCode();
        print_r(json_encode($result));
    }
}

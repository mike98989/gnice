<?php

class AdminDashboard extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['type'] !== 'admin') {
            session_destroy();
            redirect('admin/login', true, 303);
        }
    }

    public function index()
    {
    }
}

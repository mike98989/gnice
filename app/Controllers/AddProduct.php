<?php


class AddProduct extends Controller
{


    public function index()
    {
        $data = [];
        $this->view->js = ['controllers/loginController.js', 'controllers/web/homeController.js'];
        $this->view->render('Seller/index', false, '');
    }
}

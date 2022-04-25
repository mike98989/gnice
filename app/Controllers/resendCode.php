<?php


class Resendcode extends Controller{
   

    public function index(){
        $data = [];
        $this->view->js = ['controllers/signupController.js','controllers/web/homeController.js'];
        $this->view->render('Account/resendCode',false,'');
    }
}
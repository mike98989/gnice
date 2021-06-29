<?php

class Controller
{
    //load model
    public function model($model)
    {
        // require model file
        require_once '../app/models/' . $model . '.php';
        // Instantiate model
        return new $model();
    }

    //load view
    public function view($view, $include_header, $data = [], $type, $js)
    {
        //check for view file
        if (file_exists('../app/views/' . $view . '.html')) {
            if ($include_header == true) {
                require('../app/views/inc/header' . $type . '.php');
            }
            require_once '../app/views/' . $view . '.html';
            if ($include_header == true) {
                if ($type == '_type3') {
                    require('../app/views/inc/footer1.php');
                } else {
                require('../app/views/inc/footer.php');
            }
            }
        } else {
            //view does not exist
            include_once "../app/views/404.html";
            // die('view does not exist');
        }
    }
}

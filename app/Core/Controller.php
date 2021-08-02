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
        if (file_exists('../app/Views/' . $view . '.html')) {
            if ($include_header == true) {
                require('../app/Views/inc/header' . $type . '.php');
            }
            require_once '../app/Views/' . $view . '.html';
            if ($include_header == true) {
                if ($type == '_type3') {
                    require('../app/Views/inc/footer1.php');
                } elseif ($type == '_type4') {
                    require('../app/Views/inc/footer4.php');
                } else {
                    require('../app/Views/inc/footer.php');
                }
            }
        } else {
            //view does not exist
            include_once "../app/Views/404.html";
            // die('view does not exist');
        }
    }
}

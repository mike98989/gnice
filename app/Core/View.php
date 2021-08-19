<?php
class View {
  public $data = [];

	function __construct() {
    //error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
    Session::init();
    $this->view = new \stdClass();
    $this->view->logged = Session::get('loggedIn');
    $this->view->loggedType = Session::get('loggedType');
  }

	public function render($name, $noInclude, $message)
	{
        
		if ($noInclude == true) {
			$js=null;  
			$external_js = null;   
            if(!empty($this->js)){   
            $js=$this->js;    
            }
            if(!empty($this->external_js)){    
            $external_js = $this->external_js;   
            }
            
			extract($this->data);
            require('./app/views/inc/header_type1.php');
			require "./app/Views/".$name.".html";
            require('./app/views/inc/footer1.php');
            //include_once "./views/index/404.html";
            //require('./views/inc/footerref.php');
		} else {
			extract($this->data);
			$url=explode('/',$_SERVER['REQUEST_URI']);
			
            if($url[1]=='gnice'){
            array_splice($url, 1, 1);    
            }

            ////IF THE USER IS AN ADMIN
            if(($this->view->loggedType == 'admin')&&($url[1]=='admindashboard')){
			 /////ASSIGN JAVASCRIPT  
            $js=null;  
			$external_js = null;   
            if(!empty($this->js)){   
            $js=$this->js;    
            }
            if(!empty($this->external_js)){    
            $external_js = $this->external_js;   
            }
            
            require('./app/Views/Admin/inc/headerref.php');
            require('./app/Views/Admin/inc/header.php');
            require('./app/Views/Admin/inc/sidenav.php');
            require_once './app/Views/' . $name . '.html';
            require('./app/Views/Admin/inc/footerref.php');
			}
            
			////ELSE IF THE USER IS FULLY INTEGRATED
			elseif(($this->view->loggedType == 'user')&&($url[1]=='dashboard')){
             /////ASSIGN JAVASCRIPT   
            $js=null;  
			$external_js = null;   
            if(!empty($this->js)){   
            $js=$this->js;    
            }
            if(!empty($this->external_js)){    
            $external_js = $this->external_js;   
            }
          
            require('./app/views/inc/header_type5.php');    
			//require './app/views/inc/nav.php';
			require './app/views/' . $name . '.html';
			require './app/views/inc/footer5.php'; 
            
			}

            
            ////ELSE IT IS A VISITOR PAGE
            else{
             /////ASSIGN JAVASCRIPT 
            $js=null;  
			$external_js = null;   
            if(!empty($this->js)){   
            $js=$this->js;    
            }
            if(!empty($this->external_js)){    
            $external_js = $this->external_js;   
            }
			require('./app/views/inc/header_type1.php');
            //require('./app/views/inc/header.php');
            require('./app/views/inc/navbar.php');
            require "./app/Views/".$name.".html";
            require('./app/views/inc/footer1.php');
   
            }


		}
	}
    
    



}

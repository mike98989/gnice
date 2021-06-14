<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

// function redirect($page, $code){
// 	header('location: ' . URL_ROOT . '/'. $page, $code);
// }

//code to generate product code
function random($length, $chars = '')
{
	if (!$chars) {
		$chars = implode(range('a','z'));
		$chars .= implode(range('0','9'));
        $chars .= implode(range('A', 'Z'));
	}
	$shuffled = str_shuffle($chars);
	return substr($shuffled, 0, $length);
}
function generateCode()
{
	return random(8).random(8);
}



function to_json($data){
    $data = json_encode($data);
}


function sanitizeData($data){
	$data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
}

 function flash($name = '', $message = '', $class = 'alert alert-success'){
     if(!empty($name)){
         if(!empty($message) && empty($_SESSION[$name])){
             if(!empty($_SESSION[$name])){
                 unset($_SESSION[$name]);
             }
             if(!empty($_SESSION[$name . '_class'])){
                 unset($_SESSION[$name . '_class']);
             }

             $_SESSION[$name] = $message;
             $_SESSION[$name. '_class'] = $class;

         }elseif (empty($message) && !empty($_SESSION[$name])) {
             $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
             echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
             unset($_SESSION[$name]);
             unset($_SESSION[$name . '_class']);
         }
     }
 }
